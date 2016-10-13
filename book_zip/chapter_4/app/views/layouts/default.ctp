<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    
    <!-- page title -->
    <title><?php echo $title_for_layout; ?></title>
    
    <?php
        echo $javascript->link( 'scriptaculous-js-1.8.1/lib/prototype' );
        echo $javascript->link( 'scriptaculous-js-1.8.1/src/scriptaculous.js?load=effects' );
        
        echo $javascript->link( 'accordion/accordion.js' );         
    ?>          
    
    <!-- page css -->
    <!-- link rel="stylesheet" type="text/css" href="http://cakephpprojects.com/global/css/global.css" / -->
    <?php echo $html->css( 'global' ); ?>
    <?php echo $html->css( 'site' ); ?>
    
</head>
<body>
    <div id="center_content">
        
        <div class="header_wrapper">
            <h1>Say Anything Forums</h1>
            <h2><i>...Apart from Spam, but ham is ok!</i></h2>
        </div>
        
        <div class="nav_1">
        
            <div class="nav_links">      
                <?php
                    echo $html->link(   'Home',
                                        '/' );
                ?>
                                                        
                &nbsp;|&nbsp;
                
                <?php
                    echo $html->link(   'Message',
                                        '/MfMessageForm/index' ); ?>
                                        
                &nbsp;|&nbsp;
                
                <?php
                    echo $html->link(   'Threads',
                                        '/MfFetchThreads/index' ); ?>
                                        
                &nbsp;|&nbsp;
                
                <?php
                    echo $this->renderElement( 'search_form' );
                ?>                                        
            </div>                                                        
                                        
        </div>
        
        <div id="loading" style="display: none;">
            <?php echo $html->image('ajax-loader.gif'); ?>
        </div>
            
        <div id="main_content_container">
            <?php echo $content_for_layout ?>
        </div>
        
    </div>
    

</body>
</html>