<form method="GET" class="search">
  <input type="hidden" name="mod" value="simple">
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
          <table>
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Qtd</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($livro_data = mysqli_fetch_assoc($query_livro_info)) {
              ?>

                <tr class="<?php if (($livro_data['statusLivro']) != 'disponivel') {
                              echo 'indisp';
                            } ?>">
                  <td onclick="location.href='?p=livros&mod=simple&edit_livro=<?php echo $livro_data['idLivro']; ?>'"><?php echo $livro_data['tituloLivro']; ?></td>
                  <td><?php echo $livro_data['autorLivro']; ?></td>
                  <td><?php echo $livro_data['editoraLivro']; ?></td>
                  <td><?php echo $livro_data['qtdLivro']; ?></td>
                  <td><?php echo $livro_data['statusLivro']; ?></td>
                  <td>
                    <a class="edit-livro" href="?p=livros&mod=simple&edit_livro=<?php echo $livro_data['idLivro']; ?>">
                      <span class="material-symbols-rounded">
                        edit
                      </span>
                    </a>
                  </td>
                </tr>

              <?php
              }
              ?>
            </tbody>
          </table>
        </main>
      </div>

<?php
    }
  }
}

?>