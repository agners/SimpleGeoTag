<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * SimpleGeoTagList Model
 */
class SimpleGeoTagModelMapIcons extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Use the query object to get map icons (google names them "markers") from table.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,name,image,size_width,size_height,anchor_x,anchor_y');
		$query->from('#__simplegeotag_markers');
		return $query;
	}
}