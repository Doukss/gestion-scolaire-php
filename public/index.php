<?php
require_once "../model.php";
require_once "../config/helpers.php";
define("WEBROOT","http://malick.mbodji.ecole221.sn:8000/?");



if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if ($controller == "commande") {
        require_once "../controller/controller.commande.php";
    }elseif ($controller == "client") {
        require_once "../controller/controller.client.php";
    }elseif ($controller == "security") {
        require_once "../controller/security.controller.php";
    }
}else{
    require_once "../controller/controller.client.php";
}