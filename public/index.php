<?php
require_once "../model.php";
define("WEBROOT","http://malick.mbodji.ecole221.sn:8000/?");

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if ($controller == "commande") {
        require_once "../controller/controller.commande.php";
    }elseif ($controller == "client") {
        require_once "../controller/controller.client.php";
    }
}else{
    require_once "../controller/controller.client.php";
}