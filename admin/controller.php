<?php


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class SimpleGeoTagController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false) {
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'default'));
		
		// call parent behavior
		parent::display($cachable);
	}
}