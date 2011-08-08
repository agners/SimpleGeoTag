/*
 * @Component "Articles SimpleGeoTag"
 * @version 1.0
 * @author Stefan Agner
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

CREATE TABLE IF NOT EXISTS `#__simplegeotag`( 
`id` int(10) unsigned NOT NULL auto_increment,
`content_id` int(10) unsigned NOT NULL,
`text` text,  
`lat` float NOT NULL,
`long` float NOT NULL,
`note` text,  
PRIMARY KEY  (`id`)
)  TYPE=MyISAM;

INSERT INTO `#__simplegeotag` ( `content_id`, `text`, `lat`, `long`, `note`) VALUES( 1, 'Example 1', -37.16031654673676, 19.6875, NULL);
INSERT INTO `#__simplegeotag` ( `content_id`, `text`, `lat`, `long`, `note`) VALUES( 2, 'Example 2', 34.05265942137599, -118.2568359375, NULL);
