<?php
declare(strict_types=1);

namespace Extcode\Contacts\Hooks;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

interface AddressSearchAddressesLoadedHookInterface
{
    /**
     * @param array $addresses
     * @param array $addressSearchArgs
     *
     * @return array
     */
    public function enrichAddresses(array $addresses, array $addressSearchArgs): array;
}
