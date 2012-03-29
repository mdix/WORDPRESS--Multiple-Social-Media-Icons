<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IconSet
 *
 * @author marc
 */
class IconSet {
    private $linkToSprite;
    
    public function __construct($param) {
        if (is_int($param)) {
            //$id = $param;
        } elseif (is_array($param)) {
            //$itemsToBuild = $param;
        } else {
            Throw new InvalidArgumentException('Either a id or a array with strings has to be given!');
        }
    }
}

?>
