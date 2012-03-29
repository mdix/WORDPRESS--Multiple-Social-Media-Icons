<?php
/*
 * Representation of a single social media icon, like a twitter or facebook button. Used
 * to build IconSets.
 */
class Icon {
    private $id;
    private $name;
    private $iconSize;
    private $iconTitle;
    private $iconAlt;
    private $iconLink;
    
    /**
     * All available Icons, sorted like they appear on the sprite from left to right
     */
    private $availableIcons = array('youtube', 'wordpress', 'vimeo', 'twitter', 'twitpic', 
            'stumbleupon', 'spotify', 'rss', 'playstation', 'lastfm', 'flickr', 
            'facebook', 'digg', 'delicious', 'tumblr', 'piano', 'linkedin', 'myspace', 
            'socialvibe', 'technorati', 'deviantart', 'blogger', 'behance', 'livejournal', 
            'megavideo', 'reddit', 'designfloat', 'audioboo', 'ember', 'skype', 
            'friendfeed', 'hyves', 'yahoo', 'bebo', 'typepad', 'xing', 'grooveshark', 
            'creativecommons', 'steam', 'dailybooth', 'lockerz', 'google', 'email', 
            'wakoopa', 'soundcloud', 'playfire', 'gowalla', 'forrst', 'dribbble', 
            'dopplr', 'buzz');
    
    public function __construct($name, $iconSize) {
        $this->name     = $name;
        $this->iconSize = $iconSize;
        $this->setDefaultValues();
    }
    
    public function getLeftOffset() {
        if (in_array($this->name, $this->availableIcons)) {
            $itemsArrayKey = array_search($this->name, $this->availableIcons);
            return bcmul($this->iconSize, $itemsArrayKey);
        }
        return -1;
    }
    
    private function setDefaultValues() {
        $this->iconTitle = 'Follow me on ' . $this->name;
        $this->iconAlt   = $this->name . ' icon';
        $this->iconLink  = '';
    }
    
    public function setCustomIconTitle($title) {
        $this->iconTitle = $title;
    }
    
    public function setCustomIconAlt($alt) {
        $this->iconAlt = $alt;
    }
    
    public function setCustomIconLink($link) {
        $this->iconLink = $link;
    }
}

?>
