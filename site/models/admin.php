<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
class SimpleGeoTagModelAdmin extends JModel
{

function &getGeotagList() {
	$query = "SELECT g.id as gid,g.*,c.* FROM #__articlesgeotag g LEFT JOIN #__content c ON g.content_id=c.id";
	$this->_db->setQuery($query);
	$rows = $this->_db->loadObjectList();
    return $rows;
    }
}
?>