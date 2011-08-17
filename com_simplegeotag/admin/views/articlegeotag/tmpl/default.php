<?php

/**
 * @Component "Articles Geotag"
 * @version 0.1.2
 * @author Stefan Agner
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
 
defined('_JEXEC') or die('Restricted access');

$lang = & JFactory::getLanguage();
 ?>
 
	   <form action="<?php echo JRoute::_( 'index.php?option=com_simplegeotag&task=save' ); ?>" method="post">
	   <table border="0">
	     <tr>
		   <td>
			<?php echo JText::_('Article') ?>:
			</td><td>
			<select name="content_id" id="content_id" onChange="set_title();"> 
				<option value="" SELECTED> </option>
					<?php	
					foreach ($this->ArticleList as $row) {
						echo '<option value="'.$row->id.'">'.$row->title.'</option>';
					}
					?>
			</select>
			</td>
		  </tr>
 <!--
          <tr>
		   <td>			
			<?php echo JText::_('InfoWindow title') ?>:
			</td><td>
			<input type="text" value="..." name="text" id="text" size="60" />
			</td>
		  </tr>			
          <tr>
-->          
		   <td>	
			<?php echo JText::_('Latitude') ?>:
			</td><td>
			<input type="text" value="0" name="lat" id="lat" />
			</td>
		  </tr>			
          <tr>
		   <td>			
			<?php echo JText::_('Longitude') ?>:
			</td><td>
			<input type="text" value="0" name="long" id="long" />
			</td>
		  </tr>			
          <tr>
		   <td>	
			<input type="submit" value="<?php echo JText::_('Save') ?>" />
			<button type="button" onclick="window.parent.SqueezeBox.close();"><?php echo JText::_('JCANCEL') ?></button>
			</td>
		  </tr>	
		 </table>
	   </form>
	   <BR />
   
	<?php 
	echo JText::_('Drag the marker on the map below to locate the article');
	$langcode = $lang->getTag();
	?>
	<div id="map_canvas" style="width: 500px; height: 300px" ></div> 
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=<?php echo $langcode ?>"></script>
    
	<script type="text/javascript" >

	function set_title() {
		var indice = document.getElementById("content_id").selectedIndex;
		var titolo = document.getElementById("content_id").options[indice].text;
		document.getElementById("text").value = titolo;
	}  

	var myOptions = {     
		zoom: 1,     
		center: new google.maps.LatLng(0,0),     
		mapTypeId: google.maps.MapTypeId.HYBRID,
		mapTypeControl: false,
		streetViewControl: false,
		scrollwheel: false
	}   

	var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions); 

	/* var marker = new  google.maps.marker(center, {draggable: true}); */
	var myLatLng = new google.maps.LatLng(42.80, 12.30);
	var marker = new google.maps.Marker({
						  position: myLatLng,
						  draggable: true,
						  map: map,
						  title: 'Trascina per impostare la posizione',
						  zIndex: 1
						}); 

	google.maps.event.addListener(marker, "dragstart", function() {
	});

	google.maps.event.addListener(marker, "dragend", function() {
		var newpos=marker.getPosition();
		document.getElementById('lat').value=newpos.lat();
		document.getElementById('long').value=newpos.lng();
	});

	</script>
 