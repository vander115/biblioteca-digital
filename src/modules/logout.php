<?php
if (!isset($_SESSION)) {
  session_start();
}
require '../pages/public/page_loading.php';

session_destroy();

echo '
    <script type="text/javascript">
        window.location = "../../index.php";
    </script>
    ';
