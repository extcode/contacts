<?php

namespace Extcode\Contacts\Domain\Model\Dto;

class ContactDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var string
     */
    protected $searchString = '';

    /**
     * @var array
     */
    protected $categories;

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
    public function getSearchString(): string
    {
        return $this->searchString;
    }

    /**
     * @param string $searchString
     */
    public function setSearchString(string $searchString): void
    {
        $this->searchString = $searchString;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class):void
    {
        $this->class = $class;
    }

    /**
     * @param string $action
     * @param string $class
     */
    public function setActionAndClass($action, $class): void
    {
        $this->action = $action;
        $this->class = $class;
    }
}
