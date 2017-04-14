<?php

namespace Extcode\Contacts\ViewHelpers;

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
 * Map Model Properties To Table Columns ViewHelper
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class MapModelPropertiesToTableColumnsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * render
     *
     * @param string $class
     * @param string $table
     * @param object $data
     * @return array
     */
    public function render($data, $class = '', $table = '')
    {
        $configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $conf = $configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );

        if (isset($conf['persistence']['classes'][$class]['mapping'])
            && $conf['persistence']['classes'][$class]['mapping']['tableName'] == $table
        ) {
            $mapping = [];
            $tableColumns = $conf['persistence']['classes'][$class]['mapping']['columns'];
            foreach ($tableColumns as $tableColumn => $modelPropertyData) {
                $modelProperty = $modelPropertyData['mapOnProperty'];
                $mapping[$modelProperty] = $tableColumn;
            }

            $data = \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getGettableProperties($data);

            foreach ($data as $key => $value) {
                if (isset($mapping[$key])) {
                    unset($data[$key]);
                    $data[$mapping[$key]] = $value;
                }
            }
        }

        return $data;
    }
}
