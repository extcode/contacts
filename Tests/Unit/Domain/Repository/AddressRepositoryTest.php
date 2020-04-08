<?php

namespace Extcode\Contacts\Tests\Domain\Model;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Nimut\TestingFramework\TestCase\UnitTestCase;

class AddressRepositoryTest extends UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Domain\Repository\AddressRepository
     */
    protected $subject;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectManager = null;

    protected function setUp()
    {
        $this->objectManager = $this->getMockBuilder(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface::class)
            ->getMock();
        $this->subject = new \Extcode\Contacts\Domain\Repository\AddressRepository($this->objectManager);
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
