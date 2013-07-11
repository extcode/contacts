<?php

namespace Extcode\Contacts\Domain\Model;

/**
 * Class Phone
 * @package Extcode\Contacts\Domain\Model
 */
class Phone extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Type
	 *
	 * @var string
	 */
	protected $type = 'VOICE';

	/**
	 * Number
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $number = '';

	/**
	 * @param string $type
	 * @throws \InvalidArgumentException
	 */
	public function setType($type) {
		$types = array('PREF', 'WORK', 'HOME', 'VOICE', 'FAX', 'MSG', 'CELL', 'PAGER', 'BBS', 'MODEM', 'CAR', 'ISDN', 'VIDEO');

		if (!in_array($type, $types)) {
			throw new \InvalidArgumentException(
				'The type have to be a set of (PREF, WORK, HOME, VOICE, FAX, MSG, CELL, PAGER, BBS, MODEM, CAR, ISDN, VIDEO).',
				1373531068
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
	 * @param string $number
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * @return string
	 */
	public function getNumber() {
		return $this->number;
	}

}