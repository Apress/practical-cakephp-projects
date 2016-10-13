<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <!-- page title -->
    <title><?php echo $title_for_layout; ?></title>
    
    <!-- page css -->
    <?php echo $html->css( 'global' ); ?>
    <?php echo $html->css( 'site' ); ?>	
</head>
<body>
    <div id="center_content">
        <div class="header_wrapper">
            <h1>Sounds U Like</h1>
            <h2><i>Music to your ears!</i></h2>
			<h6><?php $session->flash();?></h6>
        </div>
        
        <div class="nav_1">
        
            <div class="nav_links">      
                <?php
                    echo $html->link(   'Home',
                                        '/' );
                ?>
                
                &nbsp;|&nbsp;
                
                <?php
                    echo $html->link(   'Checkout',
                                        '/carts/checkout' );
                ?>
                
                &nbsp;|&nbsp;
                
                <?php
                    echo $html->link(   'Shopping Cart',
                                        '/carts/show' );
                ?>             

            </div>                                                        
                                        
        </div>

        <div id="main_content_container">
            <div id="leftnav"><?php echo $this->element('menu');?></div>
        	<div id="main_body_container"><?php echo $content_for_layout ?></div>
            <div id="right_nav_container"><?php echo $this->element('minicart');?></div>
        </div>
    </div>
    

</body>
</html>