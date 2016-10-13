<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    
    <!-- page title -->
    <title><?php echo $title_for_layout; ?></title>
    
    <!-- page css -->
    <!-- link rel="stylesheet" type="text/css" href="http://cakephpprojects.com/global/css/global.css" / -->
    <?php echo $html->css( 'global' ); ?>
    <?php echo $html->css( 'site' ); ?>
    
</head>
<body>
    <div id="center_content">
        
        <div class="header_wrapper">
            <h1>The Cake Control Panel</h1>
        </div>
        
        <div class="nav_1">
        
            <div class="nav_links">      
                <?php echo $html->link( __( 'Home', true ), '/Pages/welcome' ); ?>
                &nbsp;|&nbsp;
                <?php echo $html->link( __( 'Control Panel', true ), '/Pages/index' ); ?>
                &nbsp;|&nbsp;
                <?php
                    if ( $session->read( 'Auth.User' ) ) {
                        echo $html->link( __( 'Logout', true ), '/Users/logout' );
                    }
                    else {
                        echo $html->link( __( 'Login', true ), '/Users/login' );
                    }
                ?>                        
            </div>                                                        
                                        
        </div>
        
        <?php
            if ( $session->read( 'Auth.User' ) ) {
                echo '<div class="nav_1">';
                    echo '<div class="nav_links">';     
                    
                        echo $html->link( __( 'Users', true ), '/Users' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Groups', true ), '/Groups' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Actions', true ), '/Actions' );
                     
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Widgets', true ), '/Widgets/someAction' );
                       
                     
                        // echo '&nbsp;|&nbsp;';
                        // echo $html->link( __( 'Dash Board', true ), '/Pages/dashBoard' );

                        /*                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Security', true ), '/Pages/Security' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Controllers', true ), '/Pages/listControllers' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Components', true ), '/Pages/listComponents' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Plugins', true ), '/Pages/listPlugins' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Helpers', true ), '/Pages/listHelpers' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Elements', true ), '/Pages/listElements' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Configure', true ), '/Pages/Configure' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Routes', true ), '/Pages/Routes' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'onlyAdmin', true ), '/Users/onlyAdmin' );
                        */
                        
                    echo '</div>';
                echo '</div>';
            }
        ?>
        
        <?php
            if ($session->check('Message.auth')) {
                $session->flash('auth');
            }
        ?>
            
        <div id="main_content_container">
            <?php echo $content_for_layout ?>
        </div>
        
    </div>
    

</body>
</html>