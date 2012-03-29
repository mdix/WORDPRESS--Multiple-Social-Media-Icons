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
    private $icons = array();
    
    public function __construct($param, $iconSize = null) {
        if (is_int($param)) {
            // rebuild from database
        } elseif (is_array($param)) {
            $this->icons = $this->createIcons($param, $iconSize);
        } else {
            Throw new InvalidArgumentException('Either a id or a array with strings has to be given!');
        }
    }
    
    private function createIcons($param, $iconSize) {
        $iconSize = $iconSize ? $iconSize : 32;
        $icons = array();
        
        foreach ($param as $key => $iconName) {
            $icons[] = new Icon($iconName, $iconSize);
        }
        
        return $icons;
    }
    
    public function getMarkup() {
        $fullMarkup = '';
        
        foreach ($this->icons as $key => $markup) {
            $fullMarkup .= $markup->getMarkup();
        }
        
        return $fullMarkup;
    }
}

?>
 