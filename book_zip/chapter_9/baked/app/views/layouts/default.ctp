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
            <h1>Future News</h1>
            <h2><i><?__( "Read tomorrow's news today!" )?></i></h2>
        </div>
        
        <div class="nav_1">
        
            <div class="nav_links">      
                
                <?php
                    echo $html->link(   'Home',
                                        '/' );
                ?>
                
                &nbsp;|&nbsp;
                
                <?php
                    if ( $session->check( 'User' ) ) {
                    
                        echo $html->link( __( 'Logout', true ), '/Users/logout' );
                        
                        echo '&nbsp;|&nbsp;';
                        
                        echo $html->link( __( 'List Stories', true ), '/admin/Stories/index' );
                        
                        echo '&nbsp;|&nbsp;';
                        
                        echo $html->link( __( 'New Story', true ), '/admin/Stories/add' );
                        
                        echo '&nbsp;|&nbsp;';
                        
                        echo $html->link( __( 'Translate', true ), '/admin/Stories/toTrans' );
                    }
                    else {
                    
                        echo $html->link( 'Login', '/Users/login' );
                    }
                ?>
                
                &nbsp;|&nbsp;
                [&nbsp;
                <?php
                    echo $html->link( 'en', '/Stories/changeLocale/locale:en_us' );
                    echo '&nbsp;|&nbsp;';
                    echo $html->link( 'ja', '/Stories/changeLocale/locale:jpn' );
                    echo '&nbsp;|&nbsp;';
                    echo $html->link( 'de', '/Stories/changeLocale/locale:deu' );
                ?>
                &nbsp;]
            </div>                                                        
                                        
        </div>
        
        <?php
            if ( $session->check( 'Message.flash'  ) ) {
                echo '<div class="hilight">';
                $session->flash();
                echo '</div>';
            }
            elseif ( isset( $error ) ) {
                echo '<div class="hilight">';
                echo $error;
                echo '</div>';
            }
        ?>
            
        <div id="main_content_container">
            <?php echo $content_for_layout ?>
        </div>
        
    </div>
    

</body>
</html>