<?php
require 'src/modules/conection.php';
$idLivro = $_GET['edit_livro'];
$sql_edit_livro = "SELECT * FROM tb_livros WHERE idLivro = '$idLivro';";
$query_edit_livro = mysqli_query($conn, $sql_edit_livro);
$editLivro = mysqli_fetch_assoc($query_edit_livro);
?>

<main class="cont"></main>
<div class="modal open">
  <div class="modal-cont">
    <div class="modal-header">
      <h1>
        <span class="material-symbols-rounded">
          bookmark_add
        </span>
        Detalhes do Livro
      </h1>
      <button onclick="location.href='?p=livros<?php if (isset($_GET['mod'])) {
                                                  echo '&mod=simple';
                                                } ?>'" class="close">
        <span class="material-symbols-rounded">
          close
        </span>
      </button>
    </div>
    <div class="modal-main">
      <form class="form-modal" method="POST" action="src/modules/page_livros/edit_livro.php">
        <?php if (isset($_GET['mod'])) {
          echo '<input type="hidden" name="mod" value="1">';
        } ?>
        <input type="hidden" name="idLivro" value="<?php echo $editLivro['idLivro'] ?>">
        <input type="hidden" name="statusLivro" value="<?php echo $editLivro['statusLivro'] ?>">
        <fieldset>
          <label for="">Título</label><input name="title" type="text" value="<?php echo $editLivro['tituloLivro'] ?>">
        </fieldset>
        <fieldset>
          <label for="">Autor</label><input name="author" type="text" value="<?php echo $editLivro['autorLivro'] ?>">
        </fieldset>
        <fieldset>
          <label for="">Gênero</label>
          <select name="gender">
            <option selected disabled>Escolha um gênero</option>
            <?php
            require 'src/modules/conection.php';

            $sql_select_gender = "SELECT * FROM tb_genero_livro ORDER BY nomeGenero";

            $query_select_gender = mysqli_query($conn, $sql_select_gender);

            if ($query_select_gender) {
              while ($select_gender = mysqli_fetch_assoc($query_select_gender)) {
            ?>
                <option <?php if ($editLivro['generoLivro'] == $select_gender['idGenero']) {
                          echo 'selected ';
                        } ?>value="<?php echo $select_gender['idGenero']; ?>">
                  <?php echo $select_gender['nomeGenero'] ?>
                </option>
            <?php }
            } ?>
          </select>
        </fieldset>
        <fieldset class="oneline-modal">
          <div>
            <label for="">Tombo</label><input name="tombo" type="text" value="<?php echo $editLivro['tomboLivro'] ?>">
          </div>
          <div class="qtd-div">
            <label for="">Quantidade</label>
            <div class="qtd-container">
              <span class="next"></span>
              <span class="prev"></span>
              <input id="number" value="<?php echo $editLivro['qtdLivro'] ?>" type="number" maxlength="3" name="qtd" />
            </div>
          </div>
        </fieldset>
        <fieldset>
          <label for="">Editora</label><input name="edit" type="text" value="<?php echo $editLivro['editoraLivro'] ?>">
        </fieldset>
        <fieldset>
          <label for="">Temáticas</label><input maxlenght="255" name="tags" type="text">
        </fieldset>
        <fieldset class="oneline-modal">
          <a href="#" class="del">
            <span class="material-symbols-rounded">
              delete_forever
            </span>
            Deletar Livro</a>
          <button>
            <span class="material-symbols-rounded">
              edit
            </span>
            Alterar Livro</button>
        </fieldset>
      </form>
    </div>
  </div>
</div>