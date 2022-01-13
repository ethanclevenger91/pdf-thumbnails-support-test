<?php

namespace Eclev\PdfThumbnailsTest\Software;

class Ghostscript extends SoftwareAbstract {

  public $type = 'server';
  public $name = 'Ghostscript';

  public $errorMessage = 'Your server is missing software.';
  public $actionMessage = 'Contact your host to install the missing software below';

  protected function runTest() {
    $imagick = new Imagick();
    if(empty($imagick->queryFormats('PDF'))) {
      $this->actionMessage = 'ImageMagick is not reporting PDFs as an available format. This likely means it cannot find Ghostscript.'
        return false;
    }
    try {
      // bundle a sample PDF
      $imagick = new Imagick('sample.pdf');
    } catch(\ImagickException $e) {
      $this->errorMessage = 'There is a configuration error.';
      if(/*'attempt to perform an operation not allowed by the security policy'*/) {
        $this->actionMessage = 'Ghostscript is available but the PDF security policy for ImageMagick disables reading PDFs. See https://imagemagick.org/script/security-policy.php for more information.';
      } else {
        $this->actionMessage = 'There is a problem with ImageMagick\'s Ghostscript delegate.';
      }
    }
  }

}
