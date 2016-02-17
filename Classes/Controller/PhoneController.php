<?php

namespace Extcode\Contacts\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Phone Controller
 *
 * @package contacts
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class PhoneController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Phone Repository
     *
     * @var \Extcode\Contacts\Domain\Repository\PhoneRepository
     * @inject
     */
    protected $phoneRepository;
}
