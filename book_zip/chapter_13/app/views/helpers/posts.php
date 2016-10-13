<?php

class postsHelper extends AppHelper {

    function fragment( $text, $length, $ellipsis= ' ...' ) {

        $result = $text;

        if ( strlen( $text ) > $length ) {
        
            $match_result = preg_match( '/^(.*)\W.*$/', substr( $text, 0, $length+1 ), $matches );
                        
            if ( $match_result ) {       
                $result = $matches[1];
            }
            else {
                $result = substr( $text, 0, $length );
            }                                            
        }
        
        $result .= $ellipsis;
        
        return $result;
    } 
}

?>