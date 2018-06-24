<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\componentes;

/**
 * Description of Mesagens
 *
 * @author henrique
 */
class Mesagens {
    //put your code here
    
    
    public static function erros($obj){
        $text  = '<ul>';
        foreach ($obj as $erro){
            $text .='<li>';
            $text .= $erro[0];
            $text .='</li>';        
        }
        $text  .= '<ul>';
        return $text;
        
    }
}
