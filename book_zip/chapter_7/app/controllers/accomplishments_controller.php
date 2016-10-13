<?php

App::import('Core', 'Sanitize');

class AccomplishmentsController extends AppController {
   var $name = 'Accomplishments';
   var $helpers = array('Time');

   function index() {
      if (empty($this->params['url']['team_member'])) {
         $this->redirect(array('action' => 'login'), 302);
      }

      $this->Accomplishment->set(array('Accomplishment' => array('team_member' => $this->params['url']['team_member'])));
      
      if (!$this->Accomplishment->validates()) {
         $this->Session->setFlash('Invalid username: ' . Sanitize::html($this->Accomplishment->data['Accomplishment']['team_member']));
         $this->redirect(array('action' => 'login'), 302);
      }
      
      $this->set('my_accomplishments', $this->Accomplishment->find('all',
         array('conditions' => array("Accomplishment.team_member" => $this->Accomplishment->data['Accomplishment']['team_member']),
               'order' => array('Accomplishment.created DESC'))));
      
      $this->set('other_accomplishments', $this->Accomplishment->find('all',
         array('conditions' => array('not' => array( "Accomplishment.team_member" => $this->Accomplishment->data['Accomplishment']['team_member'])),
               'order' => array('Accomplishment.created DESC'))));
   }

   function login() {
   }

   function add() {
      if (!empty($this->data)) {
         $this->Accomplishment->save($this->data);
      }
      $this->redirect("/accomplishments/?team_member=" . $this->data['Accomplishment']['team_member'], 302);
   }
}
