<?php

namespace Extcode\Contacts\ViewHelpers;

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
        $configurationManager = $this->objectManager->get(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManager::class
        );
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
