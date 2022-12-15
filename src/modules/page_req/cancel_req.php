<?php
require '../../pages/public/page_loading.php';

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user'])) {

  $_SESSION['toast_error'] = "Essa página não pode ser acessada sem login!";

  die('
      <script type="text/javascript">
          window.location = "../../pages/public/login.php";
      </script>
      ');
}

unset($_SESSION['req']);

header('Location: ../../../index.php?p=requisicoes');
