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

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLon(): float
    {
        return $this->lon;
    }

    /**
     * @param float $lon
     */
    public function setLon(float $lon)
    {
        $this->lon = $lon;
    }

    /**
     * @return int
     */
    public function getRadius(): int
    {
        return $this->radius;
    }

    /**
     * @param int $radius
     */
    public function setRadius(int $radius)
    {
        $this->radius = $radius;
    }

    /**
     * @return string
     */
    public function getPids(): string
    {
        return $this->pids;
    }

    /**
     * @param string $pids
     */
    public function setPids(string $pids)
    {
        $this->pids = $pids;
    }

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
    public function setSearchString(string $searchString)
    {
        $this->searchString = $searchString;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return string
     */
    public function getFallbackOrderBy(): string
    {
        return $this->fallbackOrderBy;
    }

    /**
     * @param string $fallbackOrderBy
     */
    public function setFallbackOrderBy(string $fallbackOrderBy)
    {
        $this->fallbackOrderBy = $fallbackOrderBy;
    }
}
