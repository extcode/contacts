<?php

namespace Extcode\Contacts\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class ZipRepository
{
    /**
     * @var array
     */
    protected $zipMap = [];

    /**
     * @param string $zipMapFile
     */
    protected function includeZipMap(string $zipMapFile)
    {
        $zipMapFile = GeneralUtility::getFileAbsFileName($zipMapFile);

        if (file_exists(GeneralUtility::getFileAbsFileName($zipMapFile))) {
            $this->zipMap = include $zipMapFile;
            if (!is_array($zipMapFile)) {
                $zipMapFile = [];
            }
        }
    }

    /**
     * @param string $country
     * @param string $zip
     * @return array
     */
    public function findByCountryAndZip(string $country, string $zip, string $zipMapFile): array
    {
        $this->includeZipMap($zipMapFile);

        if (is_array($this->zipMap) && is_array($this->zipMap[$country]) && is_array($this->zipMap[$country][$zip])) {
            return $this->zipMap[$country][$zip];
        }
        return [];
    }
}