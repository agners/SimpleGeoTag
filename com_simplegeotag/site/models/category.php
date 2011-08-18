<?php

/**
 * @Component "SimpleGeoTag"
 * @version 1.0
 * @author Stefan Agner
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
class SimpleGeoTagModelCategory extends JModel
{

	/*
	 * Gets geotag data for a category
	 */
	public function getData() {
		JLoader::import( 'articles', JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'models' );
		$model = JModel::getInstance('Articles', 'ContentModel');
		
		JLoader::import( 'mapicons', JPATH_COMPONENT_ADMINISTRATOR . DS . 'models' );
		$mapiconmodel = JModel::getInstance('MapIcons', 'SimpleGeoTagModel');
		$mapicons = $mapiconmodel->getItems();
		/*
		var_dump($mapiconmodel);
		var_dump($mapicons);
		*/
		
		
		$rows = $model->getItems();
		$geotags = array();
		
		foreach($rows as $row)
		{
			// Create an array for Metadata...
			$registry = new JRegistry;
			$registry->loadString($row->metadata);
			$row->metadata = $registry;
			
			// Read our aditional metadata from the article...
			$longitude = $row->metadata->getValue('longitude');
			$latitude = $row->metadata->getValue('latitude');
			$mapiconid = $row->metadata->getValue('mapicon');
			
			// If article contains latitude/longitude information...
			if($longitude != null && $latitude != null && $longitude != "" && $latitude != "")
			{
				// Add its geotag to our array...
				$geotag = array();
				$geotag['longitude'] = $longitude;
				$geotag['latitude'] = $latitude;
				$geotag['title'] = $row->title;
				$geotag['id'] = $row->id;
				
				// Generate an intro text 
				$content = array();
				$content[] = '<div class="simplegeotag_info_window">';
				// Generate title with link...
				$link = JRoute::_( 'index.php?option=com_content&view=article&id='.$row->id );
				$content[] = '<a href="'.$link.'">'.$row->title.'</a>';
				
				// Format introtext accordingly...
				/* TODO: more configurable... we can use $row->introtext as well
				$introtext = strip_tags($row->introtext);
				$introtext = str_replace ("\n", "", $introtext);
				$introtext = str_replace ("\r", "", $introtext);      
				$introtext = str_replace ("'", "&#8217", $introtext);
				$introtext = preg_replace('/\s+/', ' ', $introtext);
				$content[] = '<p>'.$introtext.'</p>';
				*/
				
				$content[] = '</div>';
				
				// Content
				$geotag['content'] = implode($content);
				
				// Search map icon for this article...
				foreach($mapicons as $mapicon)
				{
					if($mapicon->id == $mapiconid)
					{
						// Copy mapicon information into the geotag array
						$geotag['image'] = $mapicon->image;
						$geotag['size_width'] = $mapicon->size_width;
						$geotag['size_height'] = $mapicon->size_height;
						$geotag['anchor_x'] = $mapicon->anchor_x;
						$geotag['anchor_y'] = $mapicon->anchor_y;
						break;
					}
				}
				$geotags[] = $geotag;
			}
		}
		return $geotags;
    }
}
?>