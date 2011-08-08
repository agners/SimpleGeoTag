<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


class SimpleGeoTagViewAdmin extends JView
{
	function display($tpl = null)
	{
        $rows = $this->get('GeotagList');
        $this->assignRef( 'GeotagList',        $rows );

		parent::display($tpl);
	}
}