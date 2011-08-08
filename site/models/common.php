<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
class SimpleGeoTagModelCommon extends JModel
{

	function store() {

		JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
		
		$row =& $this->getTable('simplegeotag', 'Table');
		
		$data = JRequest::get('post');
		
		if (!$row->bind($data)) {
			$this->setError($row->getError());
			return false;
		}
		if (!$row->store()) {
			$this->setError($row->getError());
			return false;
		}
		return true;
	}

	function remove() {

		JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
		
		$row =& $this->getTable('simplegeotag', 'Table');
		
		$id = JRequest::getVar('id','','post');
		
		if (!$row->delete($id)) {
			$this->setError($row->getError());
			return false;
		}
		return true;
	}
}

?>