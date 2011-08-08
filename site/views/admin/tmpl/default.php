<?php

/**
 * @Component "Articles Geotag"
 * @version 1.0
 * @author Alessandro "ArthurDent" Argentiero
 * GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
 defined('_JEXEC') or die('Restricted access'); 
 ?>
 
 <script type="text/javascript" >

    function edit(id) {
        document.getElementById("geotag_id").value=id;
        document.forms["form_amministra"].submit();
    } 
    </script>
   <div id="amministra_geotag">
   <form action="<?php echo JRoute::_( 'index.php?option=com_simplegeotag&task=delete' ); ?>" method="post" name="form_amministra">
    <input type="hidden" name="id" id="geotag_id" value="" />
    <input type="hidden" name="action" value="delete" />
   </form>
    <table border=1 cellspacing="0"  cellpadding="5"> 
     <tr>
        <td>id</td>
        <td><?php echo JText::_('Latitude'); ?></td>
        <td><?php echo JText::_('Longitude'); ?></td>
        <td><?php echo JText::_('Article'); ?> id</td>
        <td><?php echo JText::_('Article'); ?> </td>    
        <td></td>
     </tr>
  
    <?php	
        foreach ($this->GeoTagList as $row) {
        echo "<tr>";
        echo "<td>";
        echo $row->gid;
		echo "</td><td>";
        echo $row->lat;
		echo "</td><td>";
        echo $row->long;
		echo "</td><td>";
        echo $row->content_id;
		echo "</td><td>";
        echo $row->title;
		echo "</td><td>";
        echo '<input type="button" value="'.JText::_('Delete').'" onClick="edit('.$row->gid.');" />';
        echo "</td>";
        echo "</tr>";
        }
    ?>
    </table>
  
	<br />
    </div>