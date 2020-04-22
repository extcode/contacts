<?php

namespace Extcode\Contacts\Tests\Functional\Repository;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\Demand;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class ContactRepositoryTest extends FunctionalTestCase
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    protected $testExtensionsToLoad = [
        'typo3conf/ext/contacts'
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->contactRepository = $this->objectManager->get(ContactRepository::class);

        $this->importDataSet(__DIR__ . '/../Fixtures/pages.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/tx_contacts_domain_model_contact.xml');
    }

    public function tearDown(): void
    {
        unset($this->contactRepository);
        unset($this->objectManager);
    }

    /**
     * @test
     */
    public function findDemandedAndOrderByLastName(): void
    {
        $demand = new Demand();
        $demand->setOrderBy('last_name');

        $querySettings = $this->contactRepository->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->contactRepository->setDefaultQuerySettings($querySettings);
        $companies = $this->contactRepository->findDemanded($demand)->toArray();

        $this->assertSame(
            'Doe',
            $companies[0]->getLastName()
        );
        $this->assertSame(
            'Doe',
            $companies[1]->getLastName()
        );
        $this->assertSame(
            'Dupont',
            $companies[2]->getLastName()
        );
        $this->assertSame(
            'Janssen',
            $companies[3]->getLastName()
        );
        $this->assertSame(
            'Rossi',
            $companies[7]->getLastName()
        );
    }
}
