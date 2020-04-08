<?php

namespace Extcode\Contacts\Hooks;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DataHandler
{

    /**
     * Flushes the cache if a news record was edited.
     * This happens on two levels: by UID and by PID.
     *
     * @param array $params
     */
    public function clearCachePostProc(array $params)
    {
        if (($params['table'] !== 'tx_contacts_domain_model_contact') &&
            ($params['table'] !== 'tx_contacts_domain_model_company')
        ) {
            return;
        }

        $cacheTagsToFlush = $this->getCacheTagsToFlush($params);

        $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
        foreach ($cacheTagsToFlush as $cacheTag) {
            $cacheManager->flushCachesInGroupByTag('pages', $cacheTag);
        }
    }

    /**
     * @param array $params
     * @return array
     */
    protected function getCacheTagsToFlush(array $params): array
    {
        $cachePrefix = 'tx_contacts_';

        if ($params['table'] === 'tx_contacts_domain_model_contact') {
            $cachePrefix .= 'contact_';
        } elseif ($params['table'] === 'tx_contacts_domain_model_company') {
            $cachePrefix .= 'company_';
        }

        $cacheTagsToFlush = [];
        if (isset($params['uid'])) {
            $cacheTagsToFlush[] = $cachePrefix . $params['uid'];
        }
        if (isset($params['uid_page'])) {
            $cacheTagsToFlush[] = $cachePrefix . $params['uid_page'];
        }

        return $cacheTagsToFlush;
    }
}
