<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    
    <!-- page title -->
    <title><?php echo $title_for_layout; ?></title>
    
    <!-- page css -->
    <?php echo $html->css( 'site' ); ?>
    
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAvuSem0UK36JqBuWfUVP5AxQy7tYztf9n-vraiafQ1l-2mmbsIhRpiFGJrpQRqpkeWqKQe0nrrSEm2Q" type="text/javascript"></script>
    
    <?php 
        // To use the Ajax helper and any prototype functions, we must
        // include the prototype and script.aculo.us js files manually
        echo $javascript->link( 'scriptaculous-js-1.8.1/lib/prototype' );
        echo $javascript->link( 'scriptaculous-js-1.8.1/src/scriptaculous.js?load=effects' ); 
        
        // include site.js
        echo $javascript->link( 'site' );
    ?>

</head>

<body>

    <div id="center_content">
        
        <div class="header_wrapper">
            <h1>Travel Mappr</h1>
            <h4><i>Because life is a journey :)</i></h4>
        </div>
        
        <div class="nav_1">
            <?php echo $html->link( 'Home', '/' ); ?>
            &nbsp;|&nbsp;
            
            <?php echo $html->link( 'Retrieve Journey',
                                    '/journeys/retrieve_form' ); ?>
            &nbsp;|&nbsp;
            
            <?php echo $html->link( 'Display Journey',
                                    '/journeys/display_journey' ); ?>
        </div>
            
        <div id="main_content_container">
            <?php echo $content_for_layout ?>
        </div>
        
    </div>
    
    
</body>
</html>