<?php

require 'src/pages/private/head.php';

require 'src/functions/toast.php';

session_start();

if (!isset($_SESSION['user'])) {

    require 'src/pages/public/login.php';

    toast_success();

} else {

require 'src/functions/catch_page.php';

require 'src/pages/private/sidebar.php';

loadPage();

require 'src/pages/private/footer.php';

toast_success();

}