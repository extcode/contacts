<?php

namespace Extcode\Contacts\Domain\Model\Dto;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class Demand
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
     * @var string
     */
    protected $orderBy = '';

    public function getSearchString(): string
    {
        return $this->searchString;
    }

    public function setSearchString(string $searchString): void
    {
        $this->searchString = $searchString;
    }

    public function getAvailableCategories(): array
    {
        return $this->availableCategories;
    }

    public function setAvailableCategories(array $availableCategories): void
    {
        $this->availableCategories = $availableCategories;
    }

    public function getSelectedCategory(): int
    {
        return $this->selectedCategory;
    }

    public function setSelectedCategory(int $selectedCategory): void
    {
        $this->selectedCategory = $selectedCategory;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class):void
    {
        $this->class = $class;
    }

    public function setActionAndClass(string $action, string $class): void
    {
        $this->action = $action;
        $this->class = $class;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }
}
