<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');
/**
 * Default HTML View class for the SimpleGeoTag Component
 */
class SimpleGeoTagViewArticleGeoTag extends JView
{
	function display($tpl=null)
	{
		/* Get Mootools Core */
		JHtml::_('behavior.framework');
		
		
		parent::display($tpl);
	}
}