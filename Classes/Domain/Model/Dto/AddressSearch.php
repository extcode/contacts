<?php
declare(strict_types=1);

namespace Extcode\Contacts\Domain\Model\Dto;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class AddressSearch
{
    /**
     * @var float
     */
    protected $lat = 0.0;

    /**
     * @var float
     */
    protected $lon = 0.0;

    /**
     * @var int
     */
    protected $radius = 0;

    /**
     * @var string
     */
    protected $pids = '';

    /**
     * @var string
     */
    protected $searchString = '';

    /**
     * @var string
     */
    protected $orderBy = '';

    /**
     * @var string
     */
    protected $fallbackOrderBy = '';

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function setLon(float $lon): void
    {
        $this->lon = $lon;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    public function setRadius(int $radius): void
    {
        $this->radius = $radius;
    }

    public function getPids(): string
    {
        return $this->pids;
    }

    public function setPids(string $pids): void
    {
        $this->pids = $pids;
    }

    public function getSearchString(): string
    {
        return $this->searchString;
    }

    public function setSearchString(string $searchString): void
    {
        $this->searchString = $searchString;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    public function getFallbackOrderBy(): string
    {
        return $this->fallbackOrderBy;
    }

    public function setFallbackOrderBy(string $fallbackOrderBy): void
    {
        $this->fallbackOrderBy = $fallbackOrderBy;
    }
}
