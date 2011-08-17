<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

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
		JRequest::setVar('view', JRequest::getCmd('view', 'Default'));
		
		parent::display($cachable);
	}
    
	function save()
	{
		$model = $this->getModel('common');
		
		if ($model->store()) {
			$msg = JText::_('Geotag Saved');
		} else {
			$msg = JText::_('Error').': '.$model->getError();
		}
        
		$this->setredirect(JRoute::_('index.php'), $msg);
	}


    
    function delete()
	{
		$model = $this->getModel('common');
		
		if ($model->remove()) {
			$msg = JText::_('Geotag Deleted');
		} else {
			$msg = JText::_('Error').': '.$model->getError();
		}
        
		$this->setredirect(JRoute::_('index.php'), $msg);
	} 
}
?>