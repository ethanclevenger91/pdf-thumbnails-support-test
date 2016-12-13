<?php

namespace Eclev\PdfThumbnailsTest\Software;

abstract class SoftwareAbstract {

  abstract protected function runTest();

  public function __get($prop) {
    if($prop == 'supported') {
      return $this->test();
    }
    return $this->$prop;
  }

  public function test($force = false) {
    if(isset($this->supported) && !$force) {
      return $this->supported;
    }
    $this->supported = $this->runTest();
    return $this->supported;
  }

  public function message() {
    if($this->supported) {

    }
  }

}
