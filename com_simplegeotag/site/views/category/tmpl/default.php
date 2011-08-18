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

    var geotags = 
    <?php	
		echo json_encode($this->GeoTagList);
    ?>
    ; 
   
    var myOptions = {     
        zoom: <?php echo $this->zoom_level ?>,     
        center: new google.maps.LatLng(<?php echo $this->center_lat ?>,<?php echo $this->center_lon ?>),     
        mapTypeId: google.maps.MapTypeId.<?php echo $this->map_type ?>,
		mapTypeControl: false,
		streetViewControl: false,
		scrollwheel: false
        }   
    var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);    

    for (var i = 0; i < geotags.length; i++) {
      var geotag = geotags[i];
	  console.log(geotag);
      var myLatLng = new google.maps.LatLng(geotag['latitude'], geotag['longitude']);
	  var image = new google.maps.MarkerImage(geotag['image'],
									new google.maps.Size(geotag['size_width'], geotag['size_height']),
									new google.maps.Point(0, 0),
									new google.maps.Point(geotag['anchor_x'], geotag['anchor_y']),
									new google.maps.Size(geotag['size_width'], geotag['size_height']) );	
      var marker = new google.maps.Marker({
                                  position: myLatLng,
                                  map: map,
                                  title: geotag['title'],
                                  zIndex: 0,
								  icon: image
                                }); 
								/*
      var contentString = '<div class="gm_info_window">';
	  contentString += 'geotag['title']+' &nbsp;<a href="'+geotag['link']+'">[';
	  contentString += '<p>' + geotag['introtext'] + ';
	  contentString += '<a href="'+geotag['link']+'">[''...]</a>';
	  contentString += '<div>';
	  */
	  console.log("Marker: ");
	  console.log(myLatLng);
	  console.log("image: ");
	  console.log(image);
	  attach_infowindow(map, marker, geotag['content']);
    }

function attach_infowindow(mappa, marker, message) {
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