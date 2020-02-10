<?php
declare(strict_types=1);
namespace Extcode\Contacts\Hooks;

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
