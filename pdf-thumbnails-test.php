<?php
/*
Plugin Name: PDF Thumbnails Support Test
Plugin URI:
Desription: Determine if your server is missing software for WordPress 4.7's native PDF thumbnail generator
Version: 1.0.0
Author: Ethan Clevenger / Sterner Stuff Design
Author URI: https://sternerstuffdesign.com
 */

class PdfThumbnailsTest {

  public function __construct() {
    add_action('admin_menu', [$this, 'add_menu_page']);
  }

  public function add_menu_page() {
    add_management_page('PDF Thumbnails Support Test', 'PDF Thumbnails Support Test', 'manage_options', 'pdf-thumbnails-support-test', [$this, 'render_menu_page']);
  }

  public function render_menu_page() {
    $serverSoftwareNeeded = false;
    $wordpressUpdateNeeded = false;
    $results = [
      'ImageMagick' => false,
      'Imagick PECL Extension' => false,
      'GhostScript' => false,
      'WordPress >= 4.7' => false,
    ];
    $imagemagickResult = `convert -v`;
    if(strpos($imagemagickResult, 'Version') !== false && strpos($imagemagickResult, 'Version') == 0) {
      $results['ImageMagick'] = true;
      $allValid = false;
    } else {
      $serverSoftwareNeeded = true;
    }
    if(extension_loaded('imagick')) {
      $results['Imagick PECL Extension'] = true;
      $allValid = false;
    } else {
      $serverSoftwareNeeded = true;
    }
    if(`which gs`) {
      $results['GhostScript'] = true;
      $allValid = false;
    } else {
      $serverSoftwareNeeded = true;
    }
    if(get_bloginfo('version') >= 4.7) {
      $results['WordPress >= 4.7'] = true;
      $allValid = false;
    } else {
      $wordpressUpdateNeeded = true;
    }
    ?>

    <div class="wrap">
      <h2>PDF Thumbnails Support Test</h2>
      <p>This will quickly tell your server has all the software installed to take advantage of WordPress 4.7's built-in PDF thumbnail generation. Some plugins may shim the functionality in other ways. This test only concerns the native WordPress functionality.</p>
      <table style="text-align:left">
        <?php
          $allValid = true;
          foreach($results as $software => $installed) { ?>
          <tr>
            <th><?php echo $software; ?>: </th>
            <td>
              <?php if($installed) { ?>
                <span style="color:#46b450;" class="dashicons dashicons-yes success"></span> Installed
              <?php } else {
                $allValid = false; ?>
                <span style="color:#dc3232;" class="dashicons dashicons-no"></span> Not Installed
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </table>
      <?php if($allValid) { ?>
        <div class="notice notice-success">
            <p>Your server has all the necessary software for PDF thumbnail generation! If it still isn't working, try deactivating all plugins.</p>
        </div>
      <?php } else {
        if($serverSoftwareNeeded) {
          $outputLineOne = 'Your server is missing software';
          $outputLineTwo = 'Contact your host to install the missing software below';
        }
        if($serverSoftwareNeeded && $wordpressUpdateNeeded) {
          $outputLineOne .= ' and WordPress is out of date';
          $outputLineTwo .= ' and update your WordPress to a version greater than or equal to 4.7';
        } else if($wordpressUpdateNeeded) {
          $outputLineOne = 'WordPress it out of date';
          $outputLineTwo = 'WordPress must be updated to a version greater than or equal to 4.7';
        }
        $outputLineOne .= '. ';
        $outputLineTwo .= '.';
        ?>
        <div class="notice notice-error">
            <p><?php echo $outputLineOne.$outputLineTwo; ?></p>
        </div>
      <?php } ?>
    </div>

  <?php }

}

$pdfThumbnailsTest = new PdfThumbnailsTest();
