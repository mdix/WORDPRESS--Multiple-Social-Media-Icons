<?php
require_once dirname(__FILE__) . '/../class/Icon.php';

/**
 * Description of AdminMain
 *
 * @author marc
 */
class ViewCreateIconSets {
    //put your code here
    public function __construct($insecurePOST) {
        if (!empty($insecurePOST)) {
            echo 'post!';
        }
        $this->echoMarkup();
    }
    
    public function echoMarkup() {
        echo '  <div class="wrap">
                    <h2>Create Icon Sets</h2>
                    <form method="post" action="options.php">
                    <table class="form-table">
                        <tbody>
                            '.$this->getMarkupForAllPossibleIcons().'
                        </tbody>
                    </table>
                    <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
                    </p>
                    </form>
                </div>';
    }
    
    private function getMarkupForAllPossibleIcons() {
        $markup = '';
        foreach (Icon::$AVAILABLE_ICONS as $iconName) {
            $markup .=  '<tr valign="top">
                        <th scope="row">
                        <label for="blogname">' . $iconName . '</label>
                        </th>
                        <td>
                        <input name="' . $iconName . '-link" type="text" class="regular-text">
                        </td>
                        </tr>';
        }
        return $markup;
    }
    
}

?>
