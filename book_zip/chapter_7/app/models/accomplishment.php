<?php

class Accomplishment extends AppModel {
   var $name = 'Accomplishment';

   var $validate = array(
      'team_member' => array(
         'rule' => array('validUsername'),
         'message' => "Invalid Username!"
      ),
   );

   function validUsername($data) {
      // return (preg_match('/^[A-Za-z]+$/', $data['team_member']));
      // return (preg_match('/^[A-Za-z0-9]+$/', $data['team_member']));
      return (preg_match('/^[A-Za-z][A-Za-z0-9]+$/', $data['team_member']));
   }
}
