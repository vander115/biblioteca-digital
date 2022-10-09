<?php

require_once 'src/functions/gerar_titulo.php';

require_once 'src/modules/conection.php';

require_once 'src/pages/private/head.php';

require_once 'src/functions/toast.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {

    require_once 'src/pages/public/login.php';
} else {

    require_once 'src/functions/catch_page.php';

    require_once 'src/pages/private/sidebar.php';

    loadPage();
}

toast_success();
toast_error();
toast_aviso();

require_once 'src/pages/private/footer.php';
