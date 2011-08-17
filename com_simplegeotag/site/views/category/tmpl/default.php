<?php

/**
 * @Component "SimpleGeoTag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero/Stefan Agner
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die('Restricted access'); 
 
$doc =& JFactory::getDocument();
$lang = & JFactory::getLanguage();
$doc->addStyleSheet('components/com_simplegeotag/css/simplegeotag.css' );
?>
   <div id="simplegeotag_map">
<?php if ( ($this->show_title) == 'y' ) : ?>
	<div class="componentheading"><h2><?php echo $this->p_title; ?></h2></div>
<?php endif; 

   $langcode = $lang->getTag();

?>
   <div id="map_canvas" style="width: <?php echo $this->map_width ?>; height: <?php echo $this->map_height ?>;"></div>
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=<?php echo $langcode ?>"></script>
   <script type="text/javascript" >

    var articles = [   
    <?php	
	
	// Create a Javascript array out of our GeoTag-PHP-Array
        foreach ($this->GeoTagList as $geotag) {
		$art_text = $geotag['introtext'];
        $art_text = strip_tags($art_text); 
        $art_text = substr($art_text,0,400);
        $art_text = str_replace ("\n", "", $art_text);
        $art_text = str_replace ("\r", "", $art_text);        
		$art_text = str_replace ("'", "&#8217", $art_text);
		$art_text = preg_replace('/\s+/', ' ', $art_text);
        $art_link = JRoute::_( 'index.php?option=com_content&view=article&id='.$geotag['id'] );
		echo "\n";
        echo "['".str_replace ("'", "&#8217",$geotag['title'])."',".$geotag['latitude'].",".$geotag['longitude'].",".$geotag['id'].",'".$art_link."','".$art_text."'],\n";
        }
    ?>
    ]; 
   
    var myOptions = {     
        zoom: <?php echo $this->zoom_level ?>,     
        center: new google.maps.LatLng(<?php echo $this->center_lat ?>,<?php echo $this->center_lon ?>),     
        mapTypeId: google.maps.MapTypeId.<?php echo $this->map_type ?>,
		mapTypeControl: false,
		streetViewControl: false,
		scrollwheel: false
        }   
    var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);    

    for (var i = 0; i < articles.length; i++) {
      var mark = articles[i];
	  console.log(mark);
      var myLatLng = new google.maps.LatLng(mark[1], mark[2]);
	  var image = new google.maps.MarkerImage('<?php echo $this->img_url ?>',
									new google.maps.Size(<?php echo $this->img_width ?>, <?php echo $this->img_height ?>),
									new google.maps.Point(0, 0),
									new google.maps.Point(<?php echo $this->img_center ?>) );	
      var marker = new google.maps.Marker({
                                  position: myLatLng,
                                  map: map,
                                  title: mark[0],
                                  zIndex: mark[3],
								  icon: image
                                }); 
      var contentString = '<div class="gm_info_window"><p>';
	  contentString += mark[5]+' &nbsp;<a href="'+mark[4]+'">[';
      contentString += '<?php echo JText::_('Go to the article') ?>'; 
	  contentString += '...]</a></p><div>';
	  console.log("Content: " + contentString);
	  console.log("Marker: ");
	  console.log(marker);
	  attach_infowindow(map, marker, contentString);
  
    }

function attach_infowindow(mappa,marker, message) {
  var infowindow = new google.maps.InfoWindow(
      { content: message
      });
  google.maps.event.addListener(marker, 'click', function() {
    var mappa = marker.getMap();
    mappa.panTo( marker.getPosition() );
    mappa.setZoom(8);
    infowindow.open(mappa,marker);
  });

  google.maps.event.addListener(infowindow, 'closeclick', function() {
    infowindow.close();
    var mappa = marker.getMap();
    mappa.setZoom(<?php echo $this->zoom_level ?>);
    var zero = new google.maps.LatLng(<?php echo $this->center_lat ?>,<?php echo $this->center_lon ?>);
    mappa.panTo(zero);
  });

}

    </script>
	<br />
    </div>