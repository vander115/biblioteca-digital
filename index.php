<?php

require 'src/pages/private/head.php';



session_start();


if (!isset($_SESSION['user'])) {

    require 'src/pages/public/login.php';

} else {

require 'src/functions/catch_page.php';

require 'src/pages/private/sidebar.php';

loadPage();

require 'src/pages/private/footer.php';

}