<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class SimpleGeoTagViewCategory extends JView
{
	function display($tpl = null)
	{
		$app = JFactory::getApplication('site');
       
        $rows = $this->get('Data');
        $this->assignRef( 'GeoTagList', $rows );

		$params = $app->getParams( 'com_simplegeotag' );

		$map_type = $params->get( 'map_type' );
		$this->assignRef( 'map_type', $map_type  );
		
		$img_url = $params->get( 'img_url' );
		$this->assignRef( 'img_url', $img_url );
		
		$img_width = $params->get( 'img_width' );
		$this->assignRef( 'img_width', $img_width );
		
		$img_height = $params->get( 'img_height' );
		$this->assignRef( 'img_height', $img_height );
		
		$img_center = $params->get( 'img_center' );
		$this->assignRef( 'img_center', $img_center );
		
		$zoom_level = $params->get( 'zoom_level' );
		$this->assignRef( 'zoom_level', $zoom_level  );
		
		$center_lat = $params->get( 'center_lat' );
		$this->assignRef( 'center_lat', $center_lat  );
		
		$center_lon = $params->get( 'center_lon' );
		$this->assignRef( 'center_lon', $center_lon  );
		
		$map_width = $params->get( 'map_width' );
		$this->assignRef( 'map_width', $map_width );
		
		$map_height = $params->get( 'map_height' );
		$this->assignRef( 'map_height', $map_height );
		
        $show_title = $params->get( 'show_title' );
		$this->assignRef( 'show_title', $show_title );
        
        $p_title = $params->get( 'p_title' );
		$this->assignRef( 'p_title', $p_title );
        
        parent::display($tpl);
        
	}
}
?>