<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
class SimpleGeoTagModelCreate extends JModel
{

function &getArticleList() {
    $query = "SELECT * FROM #__content ORDER BY introtext"; 
    $this->_db->setQuery($query);
    $rows = $this->_db->loadObjectList();
    return $rows;
    }
}
?>