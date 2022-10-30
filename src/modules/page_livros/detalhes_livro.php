<?php
require 'src/modules/conection.php';
$idLivro = $_GET['edit_livro'];
$sql_edit_livro = "SELECT * FROM tb_livros as l JOIN tb_genero_livro as g ON l.generoLivro = g.idGenero WHERE l.idLivro = '$idLivro';";
$query_edit_livro = mysqli_query($conn, $sql_edit_livro);
$editLivro = mysqli_fetch_assoc($query_edit_livro);
?>

<main class="cont">
  <section class="detalhes-livro">
    <header>
      <h1><?php echo $editLivro['tituloLivro']; ?></h1>
    </header>
    <main>
      <div class="details">
        <div class="info-cont">
          <div class="info">
            <div>
              <label for="">Gênero:</label>
              <p><?php echo $editLivro['nomeGenero']; ?></p>
            </div>
            <div>
              <label for="">Autor:</label>
              <p><?php echo $editLivro['autorLivro']; ?></p>
            </div>
            <div>
              <label for="">Editora:</label>
              <p><?php echo $editLivro['editoraLivro']; ?></p>
            </div>
          </div>
          <div class="info">
            <div>
              <label for="">Quantidade:</label>
              <p><?php echo $editLivro['qtdLivro'] . ' unidades'; ?></p>
            </div>
            <div>
              <label for="">Tombo:</label>
              <p><?php echo $editLivro['tomboLivro']; ?></p>
            </div>
            <div>
              <label for="">Status:</label>
              <p><?php echo mb_strtoupper($editLivro['statusLivro']); ?></p>
            </div>
          </div>
        </div>
        <div class="options">
          <a onclick="return confirm('Você deseja realmente APAGAR o livro?')" href="src/modules/page_livros/del_livro.php?id_del=<?php echo $editLivro['idLivro'] ?>" class="del">
            <span class="material-symbols-rounded">
              delete_forever
            </span>
            Deletar Livro</a>
          <button onclick="location.href='?p=livros&editar_livro=<?php echo $editLivro['idLivro'] ?>'">
            <span class="material-symbols-rounded">
              edit
            </span>
            Alterar Livro</button>
        </div>
      </div>

      <?php
      if ($editLivro['qtdLivro'] <= 0) {
      ?>
        <div class="espera">
          <header>
            <h2>Fila de Espera</h2>
          </header>
          <main>
            <div class="pessoa">
              <div class="numero">
                <h2>2</h2>
              </div>
              <div class="dados">
                <h3>Vanderlei Furtuna</h3>
                <p>3° Informática</p>
              </div>
            </div>
          </main>
          <footer>
            <div class="options">
              <button onclick="location.href='src/modules/page_livros/gerar_fila.php?id_livro_fila=<?php echo $editLivro['idLivro'] ?>'">
                <span class="material-symbols-rounded">
                  edit
                </span>
                Adicionar na lista de espera</button>
            </div>
          </footer>
        </div>
      <?php
      }
      ?>
    </main>
  </section>
</main>