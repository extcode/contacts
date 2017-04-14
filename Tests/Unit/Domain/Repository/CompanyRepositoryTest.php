<?php

namespace Extcode\Contacts\Tests\Domain\Model;

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
 * Company Model Test
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class CompanyRepositoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Domain\Repository\CompanyRepository
     */
    protected $subject;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectManager = null;

    protected function setUp()
    {
        $this->objectManager = $this->getMock(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface::class);
        $this->subject = new \Extcode\Contacts\Domain\Repository\CompanyRepository($this->objectManager);
    }

    /**
     * @test
     */
    public function canBeInstantiated()
    {
        self::assertNotNull(
            $this->subject
        );
    }
}
