<?php
/**
 * Representation of a single social media icon, like a twitter or facebook button. Used
 * to build IconSets.
 *
 * @author marc
 */
class Icon {
    private $name;
    private $iconSize;
    private $iconTitle;
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
    
    /**
     * Determines the left offset of the current icon in the sprite, which is the iconSize
     * multiplied with the position of the icon (from the left), starting with 0, negated!
     * @return int Left offset (in px) or -1 if not found
     */
    public function getNegatedLeftOffset() {
        if (in_array($this->name, $this->availableIcons)) {
            $itemsArrayKey = array_search($this->name, $this->availableIcons);
            return -bcmul($this->iconSize, $itemsArrayKey);
        }
        return -1;
    }
    
    /**
     * Adds a default title, alt text and link to the icon. 
     */
    private function setDefaultValues() {
        $this->iconTitle = 'Follow me on ' . $this->name;
        $this->iconLink  = '#';
    }
    
    /*
     * Set the title tag of the icon, shown when hovering it.
     * @param String $title The title text which will be rendered into the quotas: title=""
     */
    public function setCustomIconTitle($title) {
        $this->iconTitle = $title;
    }
    
    /**
     * Set the link target that is called when clicking the icon.
     * @param String $link The link target which will be rendered into the qutoas <a href=""
     */
    public function setCustomIconLink($link) {
        $this->iconLink = $link;
    }
    
    /**
     * Returns The markup of the curren icon, used to be rendered as html junk. The ###SPRITE###
     * placeholder is replaced with the corresponding sprite image by IconSet.
     * @return String Buttons html markup
     */
    public function getMarkup() {
        $template = '<div style="width:%1$spx;height:%1$spx;background-image:###SPRITE###;background-position:%4$spx 0;">'.
                    '<a style="display:block;width:%1$spx;height:%1$spx;" href="%2$s" title="%3$s" target="_blank"></a></div>';
        return sprintf($template, $this->iconSize, $this->iconLink, $this->iconTitle, $this->getNegatedLeftOffset());
    }
    
}