<?php

require 'src/pages/private/head.php';

require 'src/functions/toast.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {

    require 'src/pages/public/login.php';

    toast_success();
} else {

    require 'src/functions/catch_page.php';

    require 'src/pages/private/sidebar.php';

    loadPage();

    toast_success();
}

require 'src/pages/private/footer.php';