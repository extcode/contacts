<?php

namespace Extcode\Contacts\Domain\Model\Dto;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class Demand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var string
     */
    protected $searchString = '';

    /**
     * @var array
     */
    protected $availableCategories = [];

    /**
     * @var int
     */
    protected $selectedCategory = 0;

    /**
     * @var string
     */
    protected $action = '';

    /**
     * @var string
     */
    protected $class = '';

    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->searchString;
    }

    /**
     * @param string $searchString
     */
    public function setSearchString(string $searchString)
    {
        $this->searchString = $searchString;
    }

    /**
     * @return array
     */
    public function getAvailableCategories(): array
    {
        return $this->availableCategories;
    }

    /**
     * @param array $availableCategories
     */
    public function setAvailableCategories(array $availableCategories): void
    {
        $this->availableCategories = $availableCategories;
    }

    /**
     * @return int
     */
    public function getSelectedCategory(): int
    {
        return $this->selectedCategory;
    }

    /**
     * @param int $selectedCategory
     */
    public function setSelectedCategory(int $selectedCategory): void
    {
        $this->selectedCategory = $selectedCategory;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @param string $action
     * @param string $class
     */
    public function setActionAndClass($action, $class)
    {
        $this->action = $action;
        $this->class = $class;
    }
}
