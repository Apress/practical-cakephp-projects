<?php
class CaptchaController extends AppController {

    var $name = 'Captcha';

	var $uses = array('Captcha');	
    
    // The view helpers that we'll use globally
    var $helpers = array( 'Form', 'Html',  'Session');
    
    // Components that we'll often use
    var $components = array( 'Session', 'RequestHandler', 'AsciiCaptcha');	

	function beforeFilter() {
		$actionHeading = 'ASCII Art Captcha!';				
		$actionSlogan = '';
		$this->set(compact('actionHeading','actionSlogan'));					
	}
			
	function index() {
		$captcha = $this->AsciiCaptcha->getCaptcha();
		
		$string = implode("",array_keys($captcha));		
		$this->set(compact('captcha','string'));					
		$this->Session->write('string', $string);
	}

	function check() {
		if (!empty($this->data['Captcha']['text'])) {			
			if ($this->data['Captcha']['text'] == $this->Session->read('string')) {
				$this->Session->setFlash(__('<h1>You have entered the right characters</h1>', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('You have entered the wrong characters. Please, try again.', true));
				$this->redirect(array('action'=>'index'));			
			}
		} else {
				$this->Session->setFlash(__('You need to enter the correct characters. Please, try again.', true));
				$this->redirect(array('action'=>'index'));		
		}
	}
}
?>