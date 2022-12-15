<?php  
    //Conexão com o Banco de Dados
    $servername = "localhost"; //Nome do servidor
    $usarname = "root"; //Nome do usuário do servidor
    $password = "@Suncat105"; //Senha do servidor
    $database = "bd_biblioteca_digital_novo"; //Nome da base de dados

    $conn = mysqli_connect($servername, $usarname, $password, $database); //Variavel que executa a conexão

    mysqli_set_charset($conn, "utf8"); //Permite que as requisições sejam compativeis com o padrão UTF-8
?>