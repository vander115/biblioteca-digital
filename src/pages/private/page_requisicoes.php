<?php

if (isset($_GET['req'])) {
  require 'src/modules/conection.php';
  if (!isset($_SESSION)) {
    session_start();
  }

  $id_livro = $_SESSION['req']['livro'];
  $query_livro = mysqli_query($conn, "SELECT * FROM tb_livros WHERE idLivro = '$id_livro';");

  if (isset($_SESSION['req']['aluno'])) {
    $id_pessoa = $_SESSION['req']['aluno'];
    $sql_pessoa = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE p.idPessoa = '$id_pessoa';";
  } else {
    $id_pessoa = $_SESSION['req']['func'];
    $sql_pessoa = "SELECT * FROM tb_pessoa  WHERE idPessoa = '$id_pessoa';";
  }

  $query_pessoa = mysqli_query($conn, $sql_pessoa);

  $livro = mysqli_fetch_assoc($query_livro);
  $pessoa = mysqli_fetch_assoc($query_pessoa);
?>

  <main class="cont">
    <section class="validate-req">
      <header>
        <h1>Gerar Requisição</h1>
      </header>
      <main>
        <div class="req-info">
          <div class="livro-req">
            <header>
              <span class="material-symbols-rounded">
                menu_book
              </span>
            </header>
            <main>
              <h1><?php echo $livro['tituloLivro']; ?></h1>
              <p><?php echo $livro['autorLivro']; ?></p>
            </main>
          </div>
          <div class="icon">
            <span class="material-symbols-rounded">
              arrow_right_alt
            </span>
          </div>
          <div class="pessoa-req">
            <header>
              <span class="material-symbols-rounded">
                person
              </span>
            </header>
            <main>
              <h1><?php echo $pessoa['nomePessoa']; ?></h1>
              <p><?php echo $pessoa['anoTurma'] . 'º ' . $pessoa['nomeTurma']; ?></p>
            </main>
          </div>
        </div>
      </main>
    </section>
  </main>

<?php } ?>