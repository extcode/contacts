<?php

namespace Extcode\Contacts\Tests\Functional\Repository;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\AddressSearch;
use Extcode\Contacts\Domain\Repository\AddressRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class AddressRepositoryTest extends FunctionalTestCase
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    protected $testExtensionsToLoad = [
        'typo3conf/ext/contacts'
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->addressRepository = $this->objectManager->get(AddressRepository::class);

        $this->importDataSet(__DIR__ . '/../Fixtures/pages.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/tx_contacts_domain_model_country.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/tx_contacts_domain_model_company.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/tx_contacts_domain_model_address.xml');
    }

    public function tearDown(): void
    {
        unset($this->addressRepository);
        unset($this->objectManager);
    }

    /**
     * @test
     */
    public function findRecordsByUid(): void
    {
        $address = $this->addressRepository->findByUid(1);
        $this->assertSame(
            'Landtag von Baden-Württemberg',
            $address->getTitle()
        );
    }

    /**
     * @test
     */
    public function findAllRecords(): void
    {
        $addresses = $this->addressRepository->findAll();
        $this->assertSame(
            0,
            $addresses->count()
        );

        $querySettings = $this->addressRepository->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->addressRepository->setDefaultQuerySettings($querySettings);
        $addresses = $this->addressRepository->findAll();
        $this->assertSame(
            19,
            $addresses->count()
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithoutCoordinates(): void
    {
        $addressSearch = new AddressSearch();
        $addressSearch->setRadius(10);
        $addressSearch->setPids('2');

        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            16,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithoutRadius(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLat(13.4206053);
        $addressSearch->setPids('');

        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            19,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithStoragePidWithoutRadius(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLat(13.4206053);

        $addressSearch->setPids('2');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            16,
            $addresses
        );

        $addressSearch->setPids('3');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            3,
            $addresses
        );

        $addressSearch->setPids('2, 3');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            19,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithinRadius(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLon(13.4206053);
        $addressSearch->setPids('2');

        $addressSearch->setRadius(1);
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            0,
            $addresses
        );

        // $addresses should contains Berlin
        $addressSearch->setRadius(10);
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            1,
            $addresses
        );

        // $addresses should contains Berlin
        $addressSearch->setRadius(20);
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            1,
            $addresses
        );

        // $addresses should contains Berlin, Brandenburg
        $addressSearch->setRadius(50);
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            2,
            $addresses
        );

        // $addresses should contains Berlin, Brandenburg, Sachsen-Anhalt
        $addressSearch->setRadius(150);
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            3,
            $addresses
        );

        // $addresses should contains Berlin, Brandenburg, Sachsen-Anhalt, Sachsen, Mecklenburg-Vorpommern, Thüringen
        $addressSearch->setRadius(200);
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            5,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithStoragePidWithinRadius(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLon(13.4206053);
        $addressSearch->setRadius(10);

        $addressSearch->setPids('2');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            1,
            $addresses
        );

        $addressSearch->setPids('3');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            3,
            $addresses
        );

        $addressSearch->setPids('2, 3');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            4,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithSearchWord(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLon(13.4206053);
        $addressSearch->setRadius(1);
        $addressSearch->setPids('2');
        $addressSearch->setSearchString('Bürgerschaft');

        // Bürgerschaft der Freien und Hansestadt Hamburg
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            0,
            $addresses
        );

        // Hamburg Hauptbahnhof
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(53.5530746);
        $addressSearch->setLon(10.0043535);
        $addressSearch->setPids('2');

        // Bürgerschaft der Freien und Hansestadt Hamburg
        $addressSearch->setRadius(1);
        $addressSearch->setSearchString('Bürgerschaft');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            1,
            $addresses
        );

        // Bürgerschaft der Freien und Hansestadt Hamburg, Bremische Bürgerschaft
        $addressSearch->setRadius(100);
        $addressSearch->setSearchString('Bürgerschaft');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            2,
            $addresses
        );

        // Schleswig-Holsteinischer Landtag, Landtag Mecklenburg-Vorpommern, Niedersächsischer Landtag
        $addressSearch->setRadius(150);
        $addressSearch->setSearchString('Landtag');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertCount(
            3,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithoutRadiusAndSortingByTitle(): void
    {
        $addressSearch = new AddressSearch();
        $addressSearch->setPids('2');
        $addressSearch->setOrderBy('title');

        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $addresses[0]['title']
        );
        $this->assertSame(
            'Bayerischer Landtag',
            $addresses[1]['title']
        );
        $this->assertSame(
            'Bremische Bürgerschaft',
            $addresses[2]['title']
        );
        $this->assertSame(
            'Landtag von Baden-Württemberg',
            $addresses[10]['title']
        );
        $this->assertSame(
            'Thüringer Landtag',
            $addresses[15]['title']
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithoutRadiusAndSortingByDistance(): void
    {
        $addressSearch = new AddressSearch();
        $addressSearch->setPids('2');
        $addressSearch->setOrderBy('distance');

        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertSame(
            'Landtag von Baden-Württemberg',
            $addresses[0]['title']
        );
        $this->assertSame(
            'Bayerischer Landtag',
            $addresses[1]['title']
        );
        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $addresses[2]['title']
        );
        $this->assertSame(
            'Landtag Rheinland-Pfalz',
            $addresses[10]['title']
        );
        $this->assertSame(
            'Thüringer Landtag',
            $addresses[15]['title']
        );

        $addressSearch->setFallbackOrderBy('title');
        $addresses = $this->addressRepository->findByDistance($addressSearch);
        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $addresses[0]['title']
        );
        $this->assertSame(
            'Bayerischer Landtag',
            $addresses[1]['title']
        );
        $this->assertSame(
            'Bremische Bürgerschaft',
            $addresses[2]['title']
        );
        $this->assertSame(
            'Landtag von Baden-Württemberg',
            $addresses[10]['title']
        );
        $this->assertSame(
            'Thüringer Landtag',
            $addresses[15]['title']
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithRadiusAndSortingByDistance(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLon(13.4206053);
        $addressSearch->setRadius(200);
        $addressSearch->setPids('2');
        $addressSearch->setOrderBy('distance');

        $addresses = $this->addressRepository->findByDistance($addressSearch);

        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $addresses['3.2643554966074']['title']
        );
        $this->assertSame(
            'Landtag Brandenburg',
            $addresses['28.651891958674']['title']
        );
        $this->assertSame(
            'Landtag Mecklenburg-Vorpommern',
            $addresses['181.56386274957']['title']
        );
        $this->assertSame(
            'Sächsischer Landtag',
            $addresses['164.39912286221']['title']
        );
        $this->assertSame(
            'Landtag von Sachsen-Anhalt',
            $addresses['129.23779803243']['title']
        );

        $addressSearch->setOrderBy('distance');
        $addressSearch->setFallbackOrderBy('title');

        $addresses = $this->addressRepository->findByDistance($addressSearch);

        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $addresses['3.2643554966074']['title']
        );
        $this->assertSame(
            'Landtag Brandenburg',
            $addresses['28.651891958674']['title']
        );
        $this->assertSame(
            'Landtag Mecklenburg-Vorpommern',
            $addresses['181.56386274957']['title']
        );
        $this->assertSame(
            'Sächsischer Landtag',
            $addresses['164.39912286221']['title']
        );
        $this->assertSame(
            'Landtag von Sachsen-Anhalt',
            $addresses['129.23779803243']['title']
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithRadiusAndSortingByTitle(): void
    {
        // Berlin Alexanderplatz
        $addressSearch = new AddressSearch();
        $addressSearch->setLat(52.5225068);
        $addressSearch->setLon(13.4206053);
        $addressSearch->setRadius(200);
        $addressSearch->setPids('2');
        $addressSearch->setOrderBy('title');

        $addresses = $this->addressRepository->findByDistance($addressSearch);

        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $addresses[0]['title']
        );
        $this->assertSame(
            'Landtag Brandenburg',
            $addresses[1]['title']
        );
        $this->assertSame(
            'Landtag Mecklenburg-Vorpommern',
            $addresses[2]['title']
        );
        $this->assertSame(
            'Landtag von Sachsen-Anhalt',
            $addresses[3]['title']
        );
        $this->assertSame(
            'Sächsischer Landtag',
            $addresses[4]['title']
        );
    }
}
