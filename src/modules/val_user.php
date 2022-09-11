<?php

// Conexão com o BD.
require_once './conection.php';


//Iniciar uma sessão caso não exista uma.
if (!isset($_SESSION)) {
    session_start();
}
echo $_SESSION['user'];
// Validação do Usuário.
if (!empty($_SESSION['user'])) {

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    //Utilizando password_hash para descriptografar a senha do usuário
    $sql_pass = "SELECT * FROM tb_adm WHERE loginAdm = '$login' LIMIT 1;";
    $query_pass = mysqli_query($conn, $sql_pass);
    $linha = mysqli_num_rows($query_pass);
    if ($linha) {
        $user = mysqli_fetch_assoc($query_pass);
        $verificar = password_verify($pass, $user['passAdm']);
        if ($verificar) {
            $_SESSION['user'] = $user['idAdm'];
            echo '
                 <script type="text/javascript">
                     window.location = "../../index.php";
                 </script>
                 ';
        } else {
            echo '
                 <script type="text/javascript">
                     alert("Senha Incorreta!");
                     window.location = "../../index.php";
                 </script>
                 ';
        }
    } else {
        echo '
         <script type="text/javascript">
             alert("Usuário ou Senha Incorretos!");
             window.location = "../../index.php";
         </script>
         ';
    }
}else{
    header('../../index.php');echo '
    <script type="text/javascript">
        window.location = "../../index.php";
    </script>
    ';
}
