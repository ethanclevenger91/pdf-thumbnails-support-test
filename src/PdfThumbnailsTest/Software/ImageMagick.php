<?php

namespace Eclev\PdfThumbnailsTest\Software;

class ImageMagick extends SoftwareAbstract {

  public $type = 'server';
  public $name = 'ImageMagick';

  public $errorMessage = 'Your server is missing software';
  public $actionMessage = 'Contact your host to install the missing software below';

  protected function runTest() {
    $result = `convert -v`;
    if(strpos($result, 'Version') !== false && strpos($result, 'Version') == 0) {
      return true;
    }
    return false;
  }

}
