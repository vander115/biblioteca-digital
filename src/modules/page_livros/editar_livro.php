<?php
require 'src/modules/conection.php';
$idLivro = $_GET['editar_livro'];
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
      <form class="form-modal" method="POST" id="livro-form" action="src/modules/page_livros/edit_livro.php">
        <?php if (isset($_GET['mod'])) {
          echo '<input type="hidden" name="mod" value="1">';
        } ?>
        <input type="hidden" name="idLivro" value="<?php echo $editLivro['idLivro'] ?>">
        <input type="hidden" name="statusLivro" value="<?php echo $editLivro['statusLivro'] ?>">
        <fieldset>
          <label for="">Título</label><input name="title" id="title" type="text" value="<?php echo $editLivro['tituloLivro'] ?>">
        </fieldset>
        <fieldset>
          <label for="">Autor</label><input name="author" id="author" type="text" value="<?php echo $editLivro['autorLivro'] ?>">
        </fieldset>
        <fieldset>
          <label for="">Gênero</label>
          <select name="gender" id="gender">
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
            <label for="">Tombo</label><input name="tombo" id="tombo" type="text" value="<?php echo $editLivro['tomboLivro'] ?>">
          </div>
          <div class="qtd-div">
            <label for="">Quantidade</label>
            <div class="qtd-container">
              <span class="next"></span>
              <span class="prev"></span>
              <input id="number" id="number" value="<?php echo $editLivro['qtdLivro'] ?>" type="number" maxlength="3" name="qtd" />
            </div>
          </div>
        </fieldset>
        <fieldset>
          <label for="">Editora</label><input name="edit" id="edit" type="text" value="<?php echo $editLivro['editoraLivro'] ?>">
        </fieldset>
        <fieldset>
          <label for="">Temáticas</label><input maxlenght="255" name="tags" id="tags" type="text">
        </fieldset>
        <fieldset class="oneline-modal">
          <a type="buttton" class="del" onclick="return confirm('Deseja realmente ARQUIVAR esse livro?')" href="src/modules/page_livros/del_livro.php?id_del=<?php echo $editLivro['idLivro'] ?>">
            <span class="material-symbols-rounded">
              archive
            </span>
            Arquivar</a>
          <a type="buttton" onclick="livrosVerify()">
            <span class="material-symbols-rounded">
              edit
            </span>
            Alterar</a>
        </fieldset>
      </form>
    </div>
  </div>
</div>

<script>
  const livroForm = document.getElementById('livro-form');

  const titleInput = document.getElementById('title');
  const authorInput = document.getElementById('author');
  const genderInput = document.getElementById('gender');
  const tomboInput = document.getElementById('tombo');
  const numberInput = document.getElementById('number');
  const editInput = document.getElementById('edit');
  const tagsInput = document.getElementById('tags');

  const livrosVerify = () => {
    if (titleInput.value === "") {
      toastr.warning("Informe o titulo do livro!");
      titleInput.focus();
      return;
    }
    if (authorInput.value === "") {
      toastr.warning("Informe o autor do livro!");
      authorInput.focus();
      return;
    }
    if (genderInput.value == 0) {
      toastr.warning("Escolha o gênero do livro!");
      genderInput.focus();
      return;
    }
    if (tomboInput.value === "") {
      toastr.warning("Informe o tombo do livro!");
      tomboInput.focus();
      return;
    }
    if (editInput.value === "") {
      toastr.warning("Informe a editora do livro!");
      editInput.focus();
      return;
    }
    livroForm.submit();
  }
</script>