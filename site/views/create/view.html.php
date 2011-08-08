<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');



class SimpleGeoTagViewCreate extends JView
{
	function display($tpl = null)	
    {
        /*  $model =& $this->getModel('artgeotag'); */
        $rows = $this->get('ArticleList');
        $this->assignRef( 'ArticleList', $rows);

        parent::display($tpl);
     
	}
}
?>