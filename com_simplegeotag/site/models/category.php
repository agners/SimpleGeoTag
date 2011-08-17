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

	public function getData() {
		JLoader::import( 'articles', JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'models' );
		$model = JModel::getInstance('Articles', 'ContentModel');
		$model->setState('params', JFactory::getApplication()->getParams());
		//var_dump($model->getState());
		
		
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
			
			if($longitude != null && $latitude != null)
			{
				// Add geotag to our array...
				$geotag = array();
				$geotag['longitude'] = $longitude;
				$geotag['latitude'] = $latitude;
				$geotag['title'] = $row->title;
				$geotag['introtext'] = $row->introtext;
				$geotag['id'] = $row->id;
				$geotags[] = $geotag;
			}
		}
		foreach($geotags as $geotag)
		{
			var_dump($geotag);
		}
		return $geotags;
    }
}
?>