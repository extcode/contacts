<?php

namespace Extcode\Contacts\Tests\Functional\Repository;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Repository\AddressRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Functional test for the \GeorgRinger\News\Domain\Repository\NewsRepository
 */
class NewsRepositoryTest extends FunctionalTestCase
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
            16,
            $addresses->count()
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithoutCoordinates(): void
    {
        $addresses = $this->addressRepository->findByDistance(0.0, 0.0, 10, 0, '');

        $this->assertSame(
            16,
            count($addresses)
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithoutRadius(): void
    {
        // Berlin Alexanderplatz
        $lat = 52.5225068;
        $lon = 13.4206053;

        $addresses = $this->addressRepository->findByDistance($lat, $lon, 0, 0, '');

        $this->assertSame(
            16,
            count($addresses)
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithinRadius(): void
    {
        // Berlin Alexanderplatz
        $lat = 52.5225068;
        $lon = 13.4206053;

        $addresses = $this->addressRepository->findByDistance($lat, $lon, 1, 0, '');
        $this->assertCount(
            0,
            $addresses
        );

        // $addresses should contains Berlin
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 10, 0, '');
        $this->assertCount(
            1,
            $addresses
        );

        // $addresses should contains Berlin
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 20, 0, '');
        $this->assertCount(
            1,
            $addresses
        );

        // $addresses should contains Berlin, Brandenburg
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 50, 0, '');
        $this->assertCount(
            2,
            $addresses
        );

        // $addresses should contains Berlin, Brandenburg, Sachsen-Anhalt
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 150, 0, '');
        $this->assertCount(
            3,
            $addresses
        );

        // $addresses should contains Berlin, Brandenburg, Sachsen-Anhalt, Sachsen, Mecklenburg-Vorpommern, Thüringen
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 200, 0, '');
        $this->assertCount(
            5,
            $addresses
        );
    }

    /**
     * @test
     */
    public function findByDistanceWithSearchWord(): void
    {
        // Berlin Alexanderplatz
        $lat = 52.5225068;
        $lon = 13.4206053;

        // Bürgerschaft der Freien und Hansestadt Hamburg
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 1, 0, 'Bürgerschaft');
        $this->assertCount(
            0,
            $addresses
        );

        // Hamburg Hauptbahnhof
        $lat = 53.5530746;
        $lon = 10.0043535;

        // Bürgerschaft der Freien und Hansestadt Hamburg
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 1, 0, 'Bürgerschaft');
        $this->assertCount(
            1,
            $addresses
        );

        // Bürgerschaft der Freien und Hansestadt Hamburg, Bremische Bürgerschaft
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 100, 0, 'Bürgerschaft');
        $this->assertCount(
            2,
            $addresses
        );

        // Schleswig-Holsteinischer Landtag, Landtag Mecklenburg-Vorpommern, Niedersächsischer Landtag
        $addresses = $this->addressRepository->findByDistance($lat, $lon, 150, 0, 'Landtag');
        $this->assertCount(
            3,
            $addresses
        );
    }
}
