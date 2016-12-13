<?php

namespace Eclev\PdfThumbnailsTest\Admin;

class Notifier {

  public $serverSupported = true;
  public $siteSupported = true;

  private $errorMessages = [];
  private $actionMessages = [];

  public function addMessage($software) {
    if(!$software->supported) {
      $this->{$software->type.'Supported'} = false;
      $this->errorMessages[] = $software->errorMessage;
      $this->actionMessages[] = $software->actionMessage;
    }
  }

  public function getErrorMessage() {
    if(!count($this->errorMessages)) {
      return false;
    }
    $this->errorMessages = array_unique($this->errorMessages);
    return $this->concatenateMessages($this->errorMessages);

  }

  public function getActionMessage() {
    if(!count($this->actionMessages)) {
      return false;
    }
    $this->actionMessages = array_unique($this->actionMessages);
    return $this->concatenateMessages($this->actionMessages);
  }

  private static function concatenateMessages($messages = []) {
    $finalMessage = '';
    foreach($messages as $message) {
      if(!$finalMessage) {
        $finalMessage .= $message;
      } else {
        $finalMessage .= ' and ' . lcfirst($message);
      }
    }
    return $finalMessage . '. ';
  }

  public function notify() {
    if($this->serverSupported && $this->siteSupported) { ?>
      <div class="notice notice-success">
          <p>Your server has all the necessary software for PDF thumbnail generation! If it still isn't working, try deactivating all plugins.</p>
      </div>
    <?php } else { ?>
      <div class="notice notice-error">
          <p><?php echo $this->getErrorMessage() . $this->getActionMessage(); ?></p>
      </div>
    <?php }
  }
}
