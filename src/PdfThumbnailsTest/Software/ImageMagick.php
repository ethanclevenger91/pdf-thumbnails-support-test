<?php

namespace Eclev\PdfThumbnailsTest\Software;

class ImageMagick extends SoftwareAbstract {

  public $type = 'server';
  public $name = 'ImageMagick';

  public $errorMessage = 'Your server is missing software';
  public $actionMessage = 'Contact your host to install the missing software below';

  protected function runTest() {
    $imagick = new Imagick();
    return $imagick->getPackageName() == 'ImageMagick';
  }

}
