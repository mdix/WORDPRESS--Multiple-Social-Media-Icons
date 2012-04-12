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
            var_dump($insecurePOST);
        }
        $this->echoMarkup();
    }
    
    public function echoMarkup() {
        echo '  <div class="wrap">
                    <h2>Create Icon Sets</h2>
                    <form method="post" action="">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <td><strong>Use</strong></td>
                                <td><strong>Icon</strong></td>
                                <td><strong>Name</strong></td>
                                <td><strong>Link</strong></td>
                                <td><strong>Title</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                            ' . $this->getMarkupForAllPossibleIcons() . '
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
            $icon = new Icon($iconName, 32);
            $markup .=  '
                        <tr>
                            <td>
                                <input type="checkbox" name="' . $iconName . '" />
                            </td>
                            <td>
                                ' . $icon->getMarkup()  . '
                            </td>
                            <td>
                                ' . $iconName . '
                            </td>
                            <td>
                                <input name="' . $iconName . '-link" type="text" class="regular-text" />
                            </td>
                            <td>
                                <input name="' . $iconName . '-link" type="text" class="regular-text" />
                            </td>
                        </tr>';
        }
        return $markup;
    }
    
}

?>
