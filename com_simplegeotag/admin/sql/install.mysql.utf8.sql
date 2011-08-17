/*
 * @Component "Articles SimpleGeoTag"
 * @version 1.0
 * @author Stefan Agner
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

CREATE TABLE IF NOT EXISTS `#__simplegeotag_markers`( 
`id` int(10) unsigned NOT NULL auto_increment,
`name` varchar(30) NOT NULL,
`image` varchar(255) NOT NULL,
`size_width` int NOT NULL,
`size_height` int NOT NULL,
`anchor_x` int NULL,
`anchor_y` int NULL,
PRIMARY KEY  (`id`),
UNIQUE (`name`)
)  TYPE=MyISAM;

INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Home Garden Business', 'http://maps.google.com/mapfiles/kml/shapes/homegardenbusiness.png', 32, 32, 16, 32 );
INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Ranger Station', 'http://maps.google.com/mapfiles/kml/shapes/ranger_station.png', 32, 32, 16, 32 );
INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Yellow Pushpin', 'http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png', 32, 32, 16, 32 );
INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Blue Pushpin', 'http://maps.google.com/mapfiles/kml/pushpin/blue-pushpin.png', 32, 32, 16, 32 );
INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Green Pushpin', 'http://maps.google.com/mapfiles/kml/pushpin/grn-pushpin.png', 32, 32, 16, 32 );
INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Lightblue Pushpin', 'http://maps.google.com/mapfiles/kml/pushpin/ltblu-pushpin.png', 32, 32, 16, 32 );
INSERT INTO `#__simplegeotag_markers` ( `name`, `image`, `size_width`, `size_height`, `anchor_x`, `anchor_y`) VALUES( 'Pink Pushpin', 'http://maps.google.com/mapfiles/kml/pushpin/pink-pushpin.png', 32, 32, 16, 32 );



