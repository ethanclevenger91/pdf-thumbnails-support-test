<?php

namespace Eclev\PdfThumbnailsTest\Software;

class WordPress extends SoftwareAbstract {

  public $type = 'site';
  public $name = 'WordPress >= 4.7';

  public $errorMessage = 'WordPress is out of date';
  public $actionMessage = 'Update your WordPress to a version greater than or equal to 4.7';

  protected function runTest() {
    if(get_bloginfo('version') >= 4.7) {
      return true;
    }
    return false;
  }

}
