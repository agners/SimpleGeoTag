<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Stefan Agner/Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die('Restricted access');

class TableSimpleGeoTag extends JTable {
	var $id = null;
	var $content_id = null;
	var $text = null;
	var $lat = null;
	var $long = null;
	var $note = null;

	function TableSimpleGeoTag(& $db) {
		parent::__construct( '#__simplegeotag', 'id', $db);
	}
}

?>
