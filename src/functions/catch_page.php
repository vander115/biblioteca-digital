<?php 
function loadPage() {
    (isset($_GET['p']) ? $pagina = $_GET['p'] : $pagina = 'home');
    if (file_exists('src/pages/private/page_'. $pagina .'.php')) {
        require_once('src/pages/private/page_'.$pagina.'.php');
    } else {
        require_once('src/pages/private/page_home.php');
    }
}