<?php
/* SVN FILE: $Id: app_controller.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 22:33:52 -0800 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppController extends Controller {

    var $pageTitle = 'Chapter 8 - The Cake Control Panel';
    
    var $components = array( 'Auth', 'Acl' );
    
    var $uses = array( 'User' );
    
    function beforeFilter() {  
    
        $this->Auth->authorize = 'actions';
    
        $this->Auth->authError = '  You do not have permission to access
                                    the page you just selected.';
	
        $this->Auth->loginRedirect = array( 'controller' => 'Pages',
                                            'action' => 'index' );
                                            
        $this->Auth->allow( 'welcome' );                                             
    }  
    
        // Public welcome page of control panel
    function welcome() {
    
        // check if the temporary user exists
        $tmpUser = $this->User->findByUsername( 'temp' );
        
        if ( empty( $tmpUser ) ) {
            
            $this->User->create();
            $this->User->save( array(   'username' => 'temp',
                                        'password' => Security::hash( 'temp', null, true ) ) );
        }
    }

    // Page when logged in
	function index() {
		
	}
	
    function dashBoard() {
		
		// list number of users
		
		// last login users
		
		// first 10 lines of debug log
		
		// last 10 lines of error log
		
		// application specific data
    }

}
?>