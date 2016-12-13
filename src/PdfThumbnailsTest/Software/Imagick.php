<?php

namespace Eclev\PdfThumbnailsTest\Software;

class Imagick extends SoftwareAbstract {

  public $type = 'server';
  public $name = 'Imagick';

  public $errorMessage = 'Your server is missing software';
  public $actionMessage = 'Contact your host to install the missing software below';

  protected function runTest() {
    if(extension_loaded('imagick')) {
      return true;
    }
    return false;
  }

}
