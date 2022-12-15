<?php
require '../pages/public/page_loading.php';
if (!isset($_SESSION)) {
  session_start();
  
}

session_destroy();

echo '
    <script type="text/javascript">
        window.location = "../../index.php";
    </script>
    ';
