<?php
/**
 * Representation of a set of social media icons. Can either be build by giving an id 
 * (and thus retrives its information from the database) or created from scratch by 
 * passing an array with icon names.
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
            Throw new InvalidArgumentException('Either a id or an array with strings has to be given!');
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