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
}
