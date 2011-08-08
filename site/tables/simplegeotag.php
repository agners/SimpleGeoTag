<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die('Restricted access');

class TableSimplegeoTag extends JTable {
	var $id = null;
	var $content_id = null;
	var $text = null;
	var $lat = null;
	var $long = null;
	var $note = null;

	function TableSimplegeoTag(& $db) {
		parent::__construct( '#__articlesgeotag', 'id', $db);
	}
}

?>
