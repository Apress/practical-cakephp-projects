<?php

class CakeTagsView extends View {

    function render($action, $layout, $file) {
        
        $result = parent::render($action, $layout, $file);
        
        $cakeTagRender = $this->_renderCt( $result );
        
        return $cakeTagRender;
    }
    
    function _renderCt( $output ) {
    
        $result = $output;
        $match = 1;
        $offset = 0;

        while ( $match ) {
        
            preg_match("/<ct ([\w]+)[^>]*\/>/", $result, $match, PREG_OFFSET_CAPTURE, $offset );

            if ( $match ) {

                $plugin = '';
                $controller = '';
                $action = '';
                $params = '';
    
                $tag = $match[0][0];
                $offset = $match[0][1];
                
                $xml = new SimpleXMLElement( $tag );
                
                foreach( $xml->attributes() as $a => $b ) {
                    
                    switch ($a) {
                    
                        case 'plugin':
                            $plugin = $b;
                            break;
                    
                        case 'controller':
                            $controller = $b;
                            break;
                            
                        case 'action':
                            $action = $b;
                            break;
                            
                        default:
                            $params .= $a.':'.$b.'/';
                            break;
                    }
                }
                
                if ( $controller && $action ) {
                
                    $tagResult = $this->requestAction( '/'.$plugin.'/'.$controller.'/'.$action.'/'.$params, array( 'return' ) );
                    
                    $result = str_replace( $tag, $tagResult, $result ); 
                }
            }
            else {
                break;
            }
        }
        
        return $result;
    }
}

?>
