<?php

namespace Extcode\Contacts\Domain\Model;

/**
 * Class Company
 * @package Extcode\Contacts\Domain\Model
 */
class Company extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * @param $name
	 */
	public function __construct($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @throws \InvalidArgumentException
	 */
	public function setName($name) {
		if (strlen($name) == 0) {
			throw new \InvalidArgumentException(
				'The name can not be blank.',
				1373527548
			);
		}

		$this->name = $name;
	}
}