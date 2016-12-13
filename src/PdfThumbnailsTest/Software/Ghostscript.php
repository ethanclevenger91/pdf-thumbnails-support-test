<?php

namespace Eclev\PdfThumbnailsTest\Software;

class Ghostscript extends SoftwareAbstract {

  public $type = 'server';
  public $name = 'Ghostscript';

  public $errorMessage = 'Your server is missing software';
  public $actionMessage = 'Contact your host to install the missing software below';

  protected function runTest() {
    if(`which gs`) {
      return true;
    }
    return false;
  }

}
