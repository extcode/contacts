<?php

namespace Extcode\Contacts\Controller\Backend;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Contact;
use Extcode\Contacts\Domain\Model\Dto\Demand;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

class ContactController extends ActionController
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * @var int
     */
    protected $pageId;

    public function injectContactRepository(ContactRepository $contactRepository): void
    {
        $this->contactRepository = $contactRepository;
    }

    protected function initializeAction(): void
    {
        $this->pageId = (int)GeneralUtility::_GP('id');

        $frameworkConfiguration = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $persistenceConfiguration = [
            'persistence' => [
                'storagePid' => $this->pageId,
            ],
        ];
        $this->configurationManager->setConfiguration(array_merge($frameworkConfiguration, $persistenceConfiguration));
    }

    public function listAction(int $currentPage = 1): void
    {
        $demand = $this->createDemandObject();

        $contacts = $this->contactRepository->findDemanded($demand);

        $itemsPerPage = $this->settings['itemsPerPage'] ?? 25;
        $arrayPaginator = new QueryResultPaginator(
            $contacts,
            $currentPage,
            $itemsPerPage
        );
        $pagination = new SimplePagination($arrayPaginator);
        $this->view->assignMultiple(
            [
                'demand' => $demand,
                'contacts' => $contacts,
                'paginator' => $arrayPaginator,
                'pagination' => $pagination,
                'pages' => range(1, $pagination->getLastPageNumber()),
            ]
        );
    }

    /**
     * @param Contact $contact
     *
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("contact")
     */
    public function showAction(Contact $contact): void
    {
        $this->view->assign('contact', $contact);
    }

    protected function createDemandObject(): Demand
    {
        $demand = GeneralUtility::makeInstance(Demand::class);

        if ($this->request->hasArgument('filter')) {
            $filter = $this->request->getArgument('filter');
            if (!empty($filter['searchString'])) {
                $demand->setSearchString($filter['searchString']);
            }
        }

        return $demand;
    }
}
