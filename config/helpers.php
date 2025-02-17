<?php
function renderView(string $view,array $datas=[], string $layout="base"){
    ob_start();
    extract($datas);
    require_once "../views/$view";
    $content = ob_get_clean();
    require_once "../views/layout/$layout.layout.php";
}