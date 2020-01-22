<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Model\Dto\Demand;
use Extcode\Contacts\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create the demand object which define which records will get shown
     *
     * @param array $settings
     *
     * @return Demand
     */
    protected function createDemandObjectFromSettings(array $settings) : Demand
    {
        $demand = $this->objectManager->get(
            Demand::class
        );
        $this->addCategoriesToDemandObjectFromSettings($demand);

        $arguments = $this->request->getArguments();

        if ($arguments['filter']) {
            if ($arguments['filter']['searchString']) {
                $demand->setSearchString($arguments['filter']['searchString']);
            }

            if ($arguments['filter']['category'] === '0') {
                $demand->setSelectedCategory(0);
            } elseif ((int)$arguments['filter']['category']) {
                $selectedCategory = (int)$arguments['filter']['category'];
                if (in_array($selectedCategory, $demand->getAvailableCategories())) {
                    $demand->setSelectedCategory($selectedCategory);
                }
            }
        }

        return $demand;
    }

    /**
     * @param Demand $demand
     */
    protected function addCategoriesToDemandObjectFromSettings(&$demand)
    {
        if ($this->settings['categoriesList']) {
            $selectedCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(
                ',',
                $this->settings['categoriesList'],
                true
            );

            $categories = [];

            if ($this->settings['listSubcategories']) {
                foreach ($selectedCategories as $selectedCategory) {
                    $category = $this->categoryRepository->findByUid($selectedCategory);
                    $categories = array_merge(
                        $categories,
                        $this->categoryRepository->findSubcategoriesRecursiveAsArray($category)
                    );
                }
            } else {
                $categories = $selectedCategories;
            }

            $demand->setAvailableCategories($categories);
        }
    }

    /**
     * @param Demand $demand
     *
     * @return mixed[]
     */
    protected function getSelectedCategories(Demand $demand)
    {
        if (empty($demand->getAvailableCategories())) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_category');
        $queryBuilder
            ->select('uid', 'title')
            ->from('sys_category')
            ->where(
                $queryBuilder->expr()->in('uid', $demand->getAvailableCategories())
            );

        return $queryBuilder->execute()->fetchAll();
    }
}
