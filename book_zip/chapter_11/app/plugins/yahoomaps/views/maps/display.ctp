<?= $javascript->link( 'http://api.maps.yahoo.com/ajaxymap?v=3.8&appid=VnHHKsfV34GwKz3bQdmSv7DRzLPAGvI3MSQkJzRL_mKE4XUgImfhYifM3Ljl25BUSg--' ) ?>

<style type="text/css">  
#map{   
  height: 75%;   
  width: 100%;   
}   
</style>
  
<?php  
    $uuid = String::uuid();
    echo '<div id="'.$uuid.'"></div>';
?>

<script type="text/javascript">  

    // Create a map object   
    var map = new YMap(document.getElementById('<?php echo $uuid; ?>'));   

    // Zoom Control
    map.addZoomLong();
  
    // Add map type control   
    map.addTypeControl();   
  
    // Set map type to either of: YAHOO_MAP_SAT, YAHOO_MAP_HYB, YAHOO_MAP_REG   
    map.setMapType(YAHOO_MAP_REG);   
  
    // Display the map centered on a geocoded location   
    <?php
        if ( $location ) {
            echo "map.drawZoomAndCenter( '".$location."', 3 );";
        }
        else {
            echo "map.drawZoomAndCenter( new YGeoPoint( ".$latitude.", ".$longitude." ), 3 );";
            //echo "map.drawZoomAndCenter( new YGeoPoint( 16.773480, -97.747175 ), 3 );";
        }     
    ?>               

</script>
