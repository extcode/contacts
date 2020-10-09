<?php

namespace Extcode\Contacts\Domain\Repository;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\Demand;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CategoryRepository extends \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
{

    /**
     * findAllAsRecursiveTreeArray
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $selectedCategory
     * @return array $categories
     */
    public function findAllAsRecursiveTreeArray($selectedCategory = null)
    {
        $categoriesArray = $this->findAllAsArray($selectedCategory);
        $categoriesTree = $this->buildSubcategories($categoriesArray, null);
        return $categoriesTree;
    }

    /**
     * findAllAsArray
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $selectedCategory
     * @return array $categories
     */
    public function findAllAsArray($selectedCategory = null)
    {
        $localCategories = $this->findAll();
        $categories = [];
        // Transform categories to array
        foreach ($localCategories as $localCategory) {
            $newCategory = [
                'uid' => $localCategory->getUid(),
                'title' => $localCategory->getTitle(),
                'parent' =>
                    ($localCategory->getParent() ? $localCategory->getParent()->getUid() : null),
                'subcategories' => null,
                'isSelected' => ($selectedCategory == $localCategory ? true : false)
            ];
            $categories[] = $newCategory;
        }
        return $categories;
    }

    /**
     * findSubcategoriesRecursiveAsArray
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $parentCategory
     * @return array $categories
     */
    public function findSubcategoriesRecursiveAsArray($parentCategory)
    {
        $categories = [];
        $localCategories = $this->findAllAsArray();
        foreach ($localCategories as $category) {
            if (($parentCategory && $category['uid'] == $parentCategory->getUid())
                || !$parentCategory
            ) {
                $this->getSubcategoriesIds(
                    $localCategories,
                    $category,
                    $categories
                );
            }
        }
        return $categories;
    }

    /**
     * getSubcategoriesIds
     *
     * @param array $categoriesArray
     * @param array $parentCategory
     * @param array $subcategoriesArray
     */
    protected function getSubcategoriesIds(
        $categoriesArray,
        $parentCategory,
        &$subcategoriesArray
    ) {
        $subcategoriesArray[] = $parentCategory['uid'];
        foreach ($categoriesArray as $category) {
            if ($category['parent'] == $parentCategory['uid']) {
                $this->getSubcategoriesIds(
                    $categoriesArray,
                    $category,
                    $subcategoriesArray
                );
            }
        }
    }

    /**
     * buildSubcategories
     *
     * @param array $categoriesArray
     * @param array $parentCategory
     * @return array $categories
     */
    protected function buildSubcategories($categoriesArray, $parentCategory)
    {
        $categories = null;
        foreach ($categoriesArray as $category) {
            if ($category['parent'] == $parentCategory['uid']) {
                $newCategory = $category;
                $newCategory['subcategories'] =
                    $this->buildSubcategories($categoriesArray, $category);
                $categories[] = $newCategory;
            }
        }
        return $categories;
    }

    /**
     * @param Demand $demand
     * @return array $categories
     */
    public function findFromDemand(Demand $demand)
    {
        $categories = [];

        if (empty($demand->getAvailableCategories())) {
            return $categories;
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_category');
        $queryBuilder
            ->select('*')
            ->from('sys_category')
            ->where(
                $queryBuilder->expr()->in('uid', $demand->getAvailableCategories())
            );

        return $queryBuilder->execute()->fetchAll();
    }
}
