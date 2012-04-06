<?php
/**
 * Description of AdminMain
 *
 * @author marc
 */
class CreateIconSets {
    //put your code here
    public function __construct($insecurePOST) {
        if (!empty($insecurePOST)) {
            echo 'post!';
        }
        echo '<h1>Create Icon Sets</h1><form method="POST" action=""><input type="text" name="test"></input><input type="submit"></input></form>';
        
    }
    
}

?>
