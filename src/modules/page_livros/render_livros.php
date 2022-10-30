<form method="GET" class="search">
  <input type="hidden" name="p" value="livros">
  <input type="text" name="qb" placeholder="Pesquisar Livro" value="<?php if (isset($_GET['qb'])) echo $_GET['qb']; ?>">
  <button class="icon" title="Pesquisar">
    <span class="material-symbols-rounded">
      search
    </span>
  </button>
</form>

<?php

require 'src/modules/conection.php';

$sql_gender_livro = "SELECT * FROM tb_genero_livro ORDER BY nomeGenero;";

$query_gender_livro = mysqli_query($conn, $sql_gender_livro);

if ($query_gender_livro) {
  while ($gender_info = mysqli_fetch_assoc($query_gender_livro)) {
    $id_gender = $gender_info['idGenero'];
    if (isset($_GET['qb'])) {
      $qb = mb_strtoupper($_GET['qb']);
      $sql_livro_info = "SELECT * FROM tb_livros as l JOIN tb_genero_livro as g ON l.generoLivro = g.idGenero WHERE generoLivro = '$id_gender' AND CONCAT(tituloLivro, autorLivro, editoraLivro, nomeGenero) LIKE '%$qb%' ORDER BY nomeGenero, tituloLivro;";
    } else {
      $sql_livro_info = "SELECT * FROM tb_livros as l JOIN tb_genero_livro as g ON l.generoLivro = g.idGenero WHERE generoLivro = '$id_gender' ORDER BY nomeGenero, tituloLivro;";
    }

    $query_livro_info = mysqli_query($conn, $sql_livro_info);
    if (mysqli_num_rows($query_livro_info)) {

?>

      <div class="livro-cont">
        <header>
          <h1><?php echo $gender_info['nomeGenero']; ?></h1>
        </header>
        <main>
          <?php
          while ($livro_data = mysqli_fetch_assoc($query_livro_info)) {
          ?>
            <div class="card-cont">
              <div onclick="location.href='src/modules/page_req/gerar_req.php?id_livro_req=<?php if ($livro_data['statusLivro'] == 'disponivel') {
                                                                                              echo $livro_data['idLivro'];
                                                                                            } else {
                                                                                              echo 'n';
                                                                                            } ?>'" class="livro-card <?php if (($livro_data['statusLivro']) != 'disponivel') {
                                                                            echo 'indisp';
                                                                          } ?>">
                <div class="card-info">
                  <h1><?php echo $livro_data['tituloLivro'] ?></h1>
                  <h2><?php echo $livro_data['autorLivro'] ?></h2>
                </div>
                <div class="livro-info">
                  <h1>Quant.</h1>
                  <p><?php echo $livro_data['qtdLivro'] ?></p>
                </div>
              </div>
              <a href="?p=livros&edit_livro=<?php echo $livro_data['idLivro']; ?>" class="edit-livro">
                <span class="material-symbols-rounded">
                  edit
                </span>
              </a>
            </div>
          <?php
          }
          ?>
        </main>
      </div>

<?php
    }
  }
}

?>