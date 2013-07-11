<?php

namespace Extcode\Contacts\Domain\Model;

/**
 * Class Address
 * @package Extcode\Contacts\Domain\Model
 */
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Type
	 *
	 * @var string
	 */
	protected $type = 'INTL,POSTAL,PARCEL,WORK';

	/**
	 * Street
	 *
	 * @var string
	 */
	protected $street = '';

	/**
	 * Street Number
	 *
	 * @var string
	 */
	protected $streetNumber = '';

	/**
	 * ZIP
	 *
	 * @var string
	 */
	protected $zip = '';

	/**
	 * City
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * Country
	 *
	 * @var string
	 */
	protected $country = '';

	/**
	 * Post Box
	 *
	 * @var string
	 */
	protected $postBox = '';

	/**
	 * @param string $type
	 * @throws \InvalidArgumentException
	 */
	public function setType($type) {
		$types = array('DOM', 'INTL', 'POSTAL', 'PARCEL', 'HOME', 'WORK');

		if (!in_array($type, $types)) {
			throw new \InvalidArgumentException(
				'The type have to be a set of (DOM, INTL, POSTAL, PARCEL, HOME, WORK).',
				1373530255
			);
		}

		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $street
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * @return string
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * @param string $streetNumber
	 */
	public function setStreetNumber($streetNumber) {
		$this->streetNumber = $streetNumber;
	}

	/**
	 * @return string
	 */
	public function getStreetNumber() {
		return $this->streetNumber;
	}

	/**
	 * @param string $zip
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * @return string
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * @param string $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param string $country
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param string $postBox
	 */
	public function setPostBox($postBox) {
		$this->postBox = $postBox;
	}

	/**
	 * @return string
	 */
	public function getPostBox() {
		return $this->postBox;
	}


}