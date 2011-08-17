<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');
/**
 * Default HTML View class for the SimpleGeoTag Component
 */
class SimpleGeoTagViewDefault extends JView
{
	function display($tpl=null)
	{
		global $mainframe;

		JToolBarHelper::title( JText::_( 'Article Geotag' ), 'icon-48-generic.png' );
		JToolBarHelper::preferences( 'com_simplegeotag', '270' );

		parent::display($tpl);
	}
}