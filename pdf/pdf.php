<?php
require '../src/modules/conection.php';

$sql = mysqli_query($conn, "SELECT COUNT(*) FROM tb_livros;");

$livro = mysqli_fetch_assoc($sql);

?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
<style>
  * {
    margin: auto;
  }

  body {
    width: 100vw;
    height: 100vh;
    background-color: hsl(122, 100%, 97%);
  }

  header {
    padding: 1rem;
    min-width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  img {
    width: 100%;
    height: auto;
  }

  h1 {
    text-align: center;
    font-family: "Poppins";
    font-size: 20px;
  }
</style>

<body>
  <header>
    <h1>Relatorio Biblioteca Digital</h1>
    <h2><?php echo implode(",", $livro) ?></h2>
  </header>
</body>