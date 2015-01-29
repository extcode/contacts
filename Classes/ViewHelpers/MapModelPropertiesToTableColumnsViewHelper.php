<?php
namespace Extcode\Contacts\ViewHelpers;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Daniel Lorenz <wtcartproduct@extco.de>, extco.de UG (haftungsbeschränkt)
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class MapModelPropertiesToTableColumnsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * render
	 *
	 * @param string $class
	 * @param string $table
	 * @param object $data
	 * @return array
	 */
	public function render($class = '', $table = '', $data) {
		$configurationManager = $this->objectManager->get('\\TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		$conf = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

		if (
			isset($conf['persistence']['classes'][$class]['mapping']) &&
			$conf['persistence']['classes'][$class]['mapping']['tableName'] == $table
		) {
			$mapping = array();
			foreach ($conf['persistence']['classes'][$class]['mapping']['columns'] as $tableColumn => $modelPropertyData) {
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

			return $data;
		} else {
			return $data;
		}
	}

}
