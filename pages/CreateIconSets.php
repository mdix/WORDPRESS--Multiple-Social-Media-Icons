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
        echo '  <div class="wrap">
                <h2>Create Icon Sets</h2>
                    <form method="post" action="options.php">
                    <table class="form-table">
                        <tbody>
                        <tr valign="top">
                        <th scope="row">
                        <label for="blogname">Site Title</label>
                        </th>
                        <td>
                        <input name="blogname" type="text" id="blogname" value="wordpress_extension_dev" class="regular-text">
                        </td>
                        </tr>
                        <tr valign="top">
                        <th scope="row">
                        <label for="blogdescription">Tagline</label>
                        </th>
                        <td>
                        <input name="blogdescription" type="text" id="blogdescription" value="Just another WordPress site" class="regular-text">
                        <span class="description">In a few words, explain what this site is about.</span>
                        </td>
                        </tr>
                        <tr valign="top">
                        <th scope="row">
                        <label for="siteurl">WordPress Address (URL)</label>
                        </th>
                        <td>
                        <input name="siteurl" type="text" id="siteurl" value="http://localhost/wordpress_extension_dev" class="regular-text code">
                        </td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
                    </p>
                    </form>
                </div>';
    }
    
}

?>
