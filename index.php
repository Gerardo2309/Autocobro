<?php
  session_start();
  require_once("Config/Config.php");
  require_once("Helpers/Helpers.php");
  $url = !empty($_GET['url']) ? $_GET['url'] : '';
  $arrUrl = explode("/", $url);

  if(isset($_SESSION['user'])){
    switch ($_SESSION['rol']) {
        case (1):
          $url = !empty($_GET['url']) ? $_GET['url'] : 'dashboard/dashboard';
          $arrUrl = explode("/", $url);
          $controller = $arrUrl[0];
          $method = $arrUrl[0];
          $params = "";
            break;
        case 2:
          $controller = "scanner";
          $method = "scanner";
          $params = "";
            break;
        case 3:
          $controller = "caja";
          $method = "caja";
          $params = "";
            break;
    }
  }else{
    $controller = 'home';
    $method = 'home';
    $params = "";
  }

  if ($arrUrl[0]=="home" && $arrUrl[1]=="Cerrarsesion") {
    $controller = 'home';
    $method = 'Cerrarsesion';
    $params = "";
  }

  if (!empty($arrUrl[1])) {
    if ($arrUrl[1] != "") {
      $method = $arrUrl[1];
    }
  }

  if (!empty($arrUrl[2])) {
    if ($arrUrl[2] != "") {
      for ($i=2; $i < count($arrUrl) ; $i++) { 
        $params .= $arrUrl[$i].'&';
      }
      $params = trim($params,'&');
    }
  }
  require_once("Libraries/Core/Autoload.php");
  require_once("Libraries/Core/Load.php");
 
?>