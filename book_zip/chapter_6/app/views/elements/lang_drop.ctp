<?php

    echo $form->create( 'Twittertwister',
                        array(  'url' => '/Twittertwister/changeLanguage',
                                'class' => 'lang_change_form'
                                ) );
?>

<cake:nocache>

<?php

    ClassRegistry::addObject( 'view', $this );
    
    echo $form->select( "Twittertwister.language",
                        $session->read( "getLang" ),
                        $session->read( "userLang" ),
                        null,
                        true
                        );
?>

</cake:nocache>                    
  
<?php  
                        
    echo $form->submit( 'Change', array(    'label' => false,
                                            'div' => false
                                            ) );                                    
    
    echo $form->end();
?>