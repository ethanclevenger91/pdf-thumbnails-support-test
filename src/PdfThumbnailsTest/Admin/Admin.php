<?php

namespace Eclev\PdfThumbnailsTest\Admin;

class Admin {

  private $softwares = [
    'ImageMagick',
    'Imagick',
    'Ghostscript',
    'WordPress',
  ];

  private $notifier;
  public $allSupported = true;

  public function __construct() {
    add_action('admin_menu', [$this, 'add_menu_page']);
  }

  public function add_menu_page() {
    add_management_page('PDF Thumbnails Support Test', 'PDF Thumbnails Support Test', 'manage_options', 'pdf-thumbnails-support-test', [$this, 'render_menu_page']);
  }

  public function test() {

    $softwareObjects = [];
    $this->notifier = new Notifier;

    foreach($this->softwares as $software) {
      $software = 'Eclev\PdfThumbnailsTest\Software\\'.$software;
      $softwareObj = new $software;
      if(!$softwareObj->supported) {
        $this->allSupported = false;
        $this->notifier->addMessage($softwareObj);
      }
      $softwareObjects[] = $softwareObj;
    }

    $this->softwares = $softwareObjects;
    return $this;
  }

  public function render_menu_page() { ?>
    <?php $this->test(); ?>
    <div class="wrap">
      <h2>PDF Thumbnails Support Test</h2>
      <p>This will quickly tell your server has all the software installed to take advantage of WordPress 4.7's built-in PDF thumbnail generation. Some plugins may shim the functionality in other ways. This test only concerns the native WordPress functionality.</p>
      <table style="text-align:left">
        <?php foreach($this->softwares as $software) { ?>
          <tr>
            <th><?php echo $software->name; ?>: </th>
            <td>
              <?php if($software->supported) { ?>
                <span style="color:#46b450;" class="dashicons dashicons-yes success"></span> Installed
              <?php } else { ?>
                <span style="color:#dc3232;" class="dashicons dashicons-no"></span> Not Installed
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </table>
      <?php $this->notifier->notify(); ?>
    </div>

  <?php }
}
