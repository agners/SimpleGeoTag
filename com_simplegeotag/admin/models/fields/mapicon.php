<?php
/**
 * @component   SimpleGeoTag
 *
 * @copyright   Copyright (C) 2011 Stefan Agner, Inc. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldMapIcon extends JFormFieldList
{
	//The field class must know its own type through the variable $type.
	protected $type = 'MapIcon';
	private $imgid = 'img';
	

	/**
	 * Method to get the field input markup with an image tag.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// This Form is used outside of our component, therefor fix the path
		JLoader::import( 'mapicons', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_simplegeotag' . DS . 'models' );
		$model = JModel::getInstance('MapIcons', 'SimpleGeoTagModel');
		$this->items = $model->getItems();
		//var_dump($this->items);
		// Add Google Map's js
		$doc =& JFactory::getDocument();
		/*
		$lang = & JFactory::getLanguage();
		$langcode = $lang->getTag();
		$doc->addScript('http://maps.google.com/maps/api/js?sensor=false&language='.$langcode );
		*/
		
		// Add data to javascript array (for image preview)
		$js = array();
		$js[] = "var mapicons = ";
		$js[] = json_encode($this->items);
		$js[] = ";\n";
		$js[] = "function setMapIcon (val) {\n";
		$js[] = "	var mapicon = mapicons.filter(function(item, index, arr) { if(item[\"id\"] == val) return true;  },val)[0];\n";
		$js[] = "	var imgtag = $('jform_metadata_mapicon_img')\n";
		$js[] = "	imgtag.src = mapicon['image'];\n";
		$js[] = "	imgtag.width = mapicon['size_width'];\n";
		$js[] = "	imgtag.height = mapicon['size_height'];\n";
		$js[] = "}\n";
		
		$doc->addScriptDeclaration(implode($js));
		
		$this->element['onchange'] = "setMapIcon(this.value)";
		$html = parent::getInput();
		
		$this->imgid = $this->id.'_'.$this->imgid;
		$html = $html.'<img id="'.$this->imgid.'" src="" />';
		
		return $html;
	}
	
	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions()
	{
		// Initialize variables.
		$options2 = array();

		foreach($this->items as $item)
		{
			$tmp = JHtml::_('select.option', $item->id, $item->name);//, array('attr' => array('onmouseover' => "alert('test')")));
			
			// Add the option object to the result set.
			$options2[] = $tmp;
		}
		
		reset($options2);

		return $options2;
	}
}