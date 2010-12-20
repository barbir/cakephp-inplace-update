<?php
/*
 * ----------------------------------------------------------------------------
 * Package:     CakePHP InplaceUpdater Plugin
 * Version:     0.2.9
 * Date:        2010-12-10
 * Description: CakePHP plugin for Inplace update functionality of any 
 *				form element.
 * Author:      Miljenko Barbir
 * Author URL:  http://miljenkobarbir.com/
 * Repository:  http://github.com/barbir/cakephp-inplace-update
 * ----------------------------------------------------------------------------
 * Copyright (c) 2010 Miljenko Barbir
 * Dual licensed under the MIT and GPL licenses.
 * ----------------------------------------------------------------------------
 */

class InplaceUpdaterHelper extends AppHelper
{
	/*
	 * Returns a script which contains a html element (type defined in a parameter) with the field contents. 
	 * And includes a script required for the inplace update ajax request logic.
	 */
	function input($modelName, $fieldName, $id, $settings = null)
	{
		$value			= $this->__extractSetting($settings, 'value',			'');
		$actionName		= $this->__extractSetting($settings, 'actionName',		'inPlaceUpdate');
		$type			= $this->__extractSetting($settings, 'type',			'textarea');
		$cancelText		= $this->__extractSetting($settings, 'cancelText',		'Cancel');
		$submitText		= $this->__extractSetting($settings, 'submitText',		'Save');
		$toolTip		= $this->__extractSetting($settings, 'toolTip',			'Click to edit.');
		$containerType	= $this->__extractSetting($settings, 'containerType',	'div');

		$script = "
			<$containerType id=\"inplace_$fieldName\">$value</$containerType>
			<script type=\"text/javascript\">
				$(
					function()
					{
						$('#inplace_$fieldName').editable
						(
							'../$actionName/$id',
							{
								name      : 'data[$modelName][$fieldName]',
								type      : '$type',
								cancel    : '$cancelText',
								submit    : '$submitText',
								tooltip   : '$toolTip'
							}
						);
					}
				);
			</script>
		";

		return $script;
	}

	/*
	 * Extracts a setting under the provided key if possible, otherwise, returns a provided default value.
	 */
	function __extractSetting($settings, $key, $defaultValue = '')
	{
		if(!$settings && empty($settings))
			return $defaultValue;

		if(isset($settings[$key]))
			return $settings[$key];
		else
			return $defaultValue;
	}

}
