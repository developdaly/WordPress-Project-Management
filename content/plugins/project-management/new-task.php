<?php

function pm_users( $form ){
    
    foreach( $form['fields'] as &$field ){
        
        if( $field['type'] != 'select' || strpos( $field['cssClass'], 'users' ) === false )
            continue;
        
        $users = get_users();
        
        $choices = array( array('text' => 'Select a User', 'value' => ' ') );
        
        foreach( $users as $user ){
            $choices[] = array( 'text' => $user->display_name, 'value' => $user->ID );
        }
        
        $field['choices'] = $choices;
        
    }
    
    return $form;
}