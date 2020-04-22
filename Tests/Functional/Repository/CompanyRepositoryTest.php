<?php

namespace Extcode\Contacts\Tests\Functional\Repository;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\Demand;
use Extcode\Contacts\Domain\Repository\CompanyRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class CompanyRepositoryTest extends FunctionalTestCase
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    protected $testExtensionsToLoad = [
        'typo3conf/ext/contacts'
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->companyRepository = $this->objectManager->get(CompanyRepository::class);

        $this->importDataSet(__DIR__ . '/../Fixtures/pages.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/tx_contacts_domain_model_company.xml');
    }

    public function tearDown(): void
    {
        unset($this->companyRepository);
        unset($this->objectManager);
    }

    /**
     * @test
     */
    public function findDemandedAndOrderByName(): void
    {
        $demand = new Demand();
        $demand->setOrderBy('name');

        $querySettings = $this->companyRepository->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->companyRepository->setDefaultQuerySettings($querySettings);
        $companies = $this->companyRepository->findDemanded($demand)->toArray();

        $this->assertSame(
            'Abgeordnetenhaus von Berlin',
            $companies[0]->getName()
        );
        $this->assertSame(
            'Bayerischer Landtag',
            $companies[1]->getName()
        );
        $this->assertSame(
            'Bremische Bürgerschaft',
            $companies[2]->getName()
        );
        $this->assertSame(
            'Landtag von Baden-Württemberg',
            $companies[10]->getName()
        );
        $this->assertSame(
            'Thüringer Landtag',
            $companies[15]->getName()
        );
    }
}
