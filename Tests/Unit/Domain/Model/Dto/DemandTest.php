<?php

namespace Extcode\Contacts\Tests\Unit\Domain\Model\Dto;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\Demand;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class DemandTest extends UnitTestCase
{
    /**
     * @var Demand
     */
    protected $fixture;

    public function setUp(): void
    {
        $this->fixture = new Demand();
    }

    public function tearDown(): void
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getSearchStringInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getSearchString()
        );
    }

    /**
     * @test
     */
    public function setSearchStringSetsSearchString(): void
    {
        $searchString = 'Search String';

        $this->fixture->setSearchString($searchString);

        $this->assertSame(
            $searchString,
            $this->fixture->getSearchString()
        );
    }

    /**
     * @test
     */
    public function getAvailableCategoriesInitiallyReturnsEmptyArray(): void
    {
        $this->assertEmpty(
            $this->fixture->getAvailableCategories()
        );
    }

    /**
     * @test
     */
    public function setAvailableCategoriesSetsAvailableCategories(): void
    {
        $availableCategories = [2, 4];

        $this->fixture->setAvailableCategories($availableCategories);

        $this->assertSame(
            $availableCategories,
            $this->fixture->getAvailableCategories()
        );
    }

    /**
     * @test
     */
    public function getSelectedCategoryInitiallyReturnsZero(): void
    {
        $this->assertSame(
            0,
            $this->fixture->getSelectedCategory()
        );
    }

    /**
     * @test
     */
    public function setSelectedCategorySetsSelectedCategory(): void
    {
        $selectedCategory = 2;

        $this->fixture->setSelectedCategory($selectedCategory);

        $this->assertSame(
            $selectedCategory,
            $this->fixture->getSelectedCategory()
        );
    }
    /**
     * @test
     */
    public function getActionInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getAction()
        );
    }

    /**
     * @test
     */
    public function setActionSetsAction(): void
    {
        $action = 'Action Name';

        $this->fixture->setAction($action);

        $this->assertSame(
            $action,
            $this->fixture->getAction()
        );
    }

    /**
     * @test
     */
    public function getClassInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getClass()
        );
    }

    /**
     * @test
     */
    public function setClassSetsClass(): void
    {
        $class = 'Class Name';

        $this->fixture->setClass($class);

        $this->assertSame(
            $class,
            $this->fixture->getClass()
        );
    }

    /**
     * @test
     */
    public function getOrderByInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getOrderBy()
        );
    }

    /**
     * @test
     */
    public function setOrderBySetsOrderBy(): void
    {
        $orderBy = 'distance';

        $this->fixture->setOrderBy($orderBy);

        $this->assertSame(
            $orderBy,
            $this->fixture->getOrderBy()
        );
    }
}
