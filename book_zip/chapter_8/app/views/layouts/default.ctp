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
                <?php echo $html->link( __( 'Home', true ), '/ControlPanel/welcome' ); ?>
                &nbsp;|&nbsp;
                <?php echo $html->link( __( 'Control Panel', true ), '/ControlPanel/index' ); ?>
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
                        // echo $html->link( __( 'Dash Board', true ), '/ControlPanel/dashBoard' );

                        /*                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Security', true ), '/ControlPanel/Security' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Controllers', true ), '/ControlPanel/listControllers' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Components', true ), '/ControlPanel/listComponents' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Plugins', true ), '/ControlPanel/listPlugins' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Helpers', true ), '/ControlPanel/listHelpers' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Elements', true ), '/ControlPanel/listElements' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Configure', true ), '/ControlPanel/Configure' );
                        
                        echo '&nbsp;|&nbsp;';
                        echo $html->link( __( 'Routes', true ), '/ControlPanel/Routes' );
                        
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