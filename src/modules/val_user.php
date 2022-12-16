<?php
//Iniciar uma sessão caso não exista uma.
if (!isset($_SESSION)) {
    session_start();
}

// Conexão com o BD.
require '../pages/public/page_loading.php';
require_once './conection.php';




// Validação do Usuário.
if (!isset($_SESSION['user'])) {

    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);

    //Utilizando password_hash para descriptografar a senha do usuário
    $sql_pass = "SELECT * FROM tb_adm WHERE loginAdm = '$login' LIMIT 1;";
    $query_pass = mysqli_query($conn, $sql_pass);
    $linha = mysqli_num_rows($query_pass);
    if ($linha) {
        $user = mysqli_fetch_assoc($query_pass);
        $verificar = password_verify($pass, $user['passAdm']);
        if ($verificar) {
            $_SESSION['user']['id'] = $user['idAdm'];
            $_SESSION['user']['name'] = $user['loginAdm'];
            $_SESSION['toast_success'] = "Bem Vindo!!!";
            echo '
                 <script type="text/javascript">
                     window.location = "../../index.php";
                 </script>
                 ';
        } else {
            $_SESSION['toast_error'] = "Usuário ou Senha incorretos!";
            echo '
                 <script type="text/javascript">
                     window.location = "../../index.php";
                 </script>
                 ';
        }
    } else {
        $_SESSION['toast_error'] = "Usuário ou Senha incorretos!";
        echo '
         <script type="text/javascript">
             window.location = "../../index.php";
         </script>
         ';
    }
} else {
    echo '
    <script type="text/javascript">
        window.location = "../../index.php";
    </script>
    ';
}
