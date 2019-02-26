<?php
/*
 * This is helper class for parsing HTML contents from the files.
 * It require files from resources/view directory by providing specified file name.
*/
class View{
  private $data;
  private $panelContentFile;

  // This function requires file.
  public function parseHTML($fileName){
    $file = __DIR__.'/../../resources/views/'.$fileName.'.php';
    if (file_exists($file)){
      require $file;
    }
    else{
      header("HTTP/1.0 404 Not Found");
      
      return;
    }
  }

  /*
   * This function sets class variable $data.
   * This variable can be accessed by views by: $this->data
  */
  public function setData($data = null){
    $this->data = $data;
  }

  // This function is used to set panel content file.
  public function setPanelContent($panelContentFile = null){
    $this->panelContentFile = $panelContentFile;
  }

  /*
   * This function is called from the HTML view.
   * It requires the content from the panel file.
  */
  public function getPanelContent(){
    $file = __DIR__.'/../../resources/views/'.$this->panelContentFile.'.php';
    if (file_exists($file)){
      require $file;
    }
    else{
      header("HTTP/1.0 404 Not Found");
      return;
    }
  }
}
?>