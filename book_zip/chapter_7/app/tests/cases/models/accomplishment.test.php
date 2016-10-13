<?php

App::import('Model', 'Accomplishment');

class AccomplishmentTest extends Accomplishment {
   var $name = 'AccomplishmentTest';
   var $useDbConfig = 'test';
}

class AccomplishmentTestCase extends CakeTestCase {
   var $fixtures = array( 'app.accomplishment_test' );

   function testValidUsername() {
      $this->AccomplishmentTest =& new AccomplishmentTest();
      
      $this->assertTrue($this->AccomplishmentTest->validUsername(array('team_member' => 'adam')));
      $this->assertTrue($this->AccomplishmentTest->validUsername(array('team_member' => 'MATT')));
      $this->assertTrue($this->AccomplishmentTest->validUsername(array('team_member' => 'Sean')));
      $this->assertTrue($this->AccomplishmentTest->validUsername(array('team_member' => 'BH44')));
      $this->assertFalse($this->AccomplishmentTest->validUsername(array('team_member' => '97devin')));
      $this->assertFalse($this->AccomplishmentTest->validUsername(array('team_member' => 'stukdog!')));
   }
}

class AccomplishmentWebTestCase extends CakeWebTestCase {
   function testLoginGoodUsername() {
      $this->get('http://cakephp/accomplishments/');
      $this->setField('team_member', 'Richard');
      $this->click('Login');
      $this->assertText('Team Accomplishments');
      $this->assertText('My Accomplishments');
      $this->assertText("Others' Accomplishments");
   }
   function testLoginBadUsername() {
      $this->get('http://cakephp/accomplishments/');
      $this->setField('team_member', '97devin');
      $this->click('Login');
      $this->assertText('Invalid username');
   }
   function testWikipediaArticle() {
      $this->addHeader("User-Agent: CakePHP/SimpleTest");
      $this->get('http://en.wikipedia.org/wiki/Cakephp');
      $this->assertText('Unit testing');
   }
}
