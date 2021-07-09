<?php

namespace Extcode\Contacts\Controller;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\Demand;
use Extcode\Contacts\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \TYPO3\CMS\Core\Domain\Repository\PageRepository
     */
    protected $pageRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param \TYPO3\CMS\Core\Domain\Repository\PageRepository $pageRepository
     */
    public function injectPageRepository(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
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
        $demand = new Demand();
        $this->addCategoriesToDemandObjectFromSettings($demand);
        if ($this->settings['orderBy']) {
            $demand->setOrderBy($this->settings['orderBy']);
        }

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
            $selectedCategories = GeneralUtility::intExplode(
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
     * @return array
     */
    protected function getSelectedCategories(Demand $demand): array
    {
        $translatedCategories = [];

        $categories = $this->categoryRepository->findFromDemand($demand);

        foreach ($categories as $category) {
            $category = $this->pageRepository->getLanguageOverlay('sys_category', $category);

            // In case of "strict" language mode
            if (empty($category)) {
                continue;
            }

            $translatedCategories[] = [
                'uid' => $category['uid'],
                'title' => $category['title']
            ];
        }

        return $translatedCategories;
    }
}
