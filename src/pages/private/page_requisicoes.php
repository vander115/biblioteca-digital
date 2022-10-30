<?php

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['req']['status'])) {
  if ($_SESSION['req']['status'] == "pendente") {
    require 'src/modules/conection.php';


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
          <div class="req-dados">
            <form action="src/modules/page_req/validar_req.php" method="POST">
              <input type="hidden" name="id-pessoa" value="<?php echo $pessoa['idPessoa']; ?>">
              <input type="hidden" name="id-livro" value="<?php echo $livro['idLivro']; ?>">
              <fieldset>
                <div class="tipo-ident">
                  <label for="">Tipo</label>
                  <select name="tipo-ident">
                    <option value="1" selected>Aluno/Funcionário</option>
                    <option value="2">Administrador</option>
                  </select>
                </div>
                <div>
                  <label for="">Identificação do Aluno: <?php echo $pessoa['tipoIdentPessoa'] ?></label>
                  <input type="text" name="ident">
                </div>

                <div class="dias">
                  <label for="">Prazo: Dias</label>
                  <div class="dias-input">
                    <span class="next"></span>
                    <span class="prev"></span>
                    <input id="number" type="number" name="prazo" value="5">
                  </div>
                </div>
              </fieldset>
              <fieldset class="oneline-modal">
                <button class="del" type="button" onclick="location.href='src/modules/page_req/cancel_req.php'">
                  <span class="material-symbols-rounded">
                    delete_forever
                  </span>
                  Cancelar
                </button>
                <button>
                  <span class="material-symbols-rounded">
                    edit
                  </span>
                  Confirmar
                </button>
              </fieldset>
            </form>
          </div>
        </main>
      </section>
    </main>

    <script type="text/javascript">
      const inputQtd = document.getElementById('number');
      const next = document.querySelector('.next');
      const prev = document.querySelector('.prev');

      const nextNum = () => {
        inputQtd.value = Number(inputQtd.value) + 5;
      };

      const prevNum = () => {
        if (inputQtd.value != 5) {
          inputQtd.value = Number(inputQtd.value) - 5;
        }
      };

      next.addEventListener('click', nextNum, false);
      prev.addEventListener('click', prevNum, false);
    </script>

  <?php
  }
} else {

  ?>


  <main class="cont">
    <section class="requisicoes">
      <div class="options">
        <div class="option-item trigger" onclick="location.href='src/modules/page_req/gerar_req.php'">
          <span class="material-symbols-rounded">
            magic_button
          </span>
          <label for="">
            Gerar Requisição
          </label>
        </div>
      </div>
      <form class="search" method="GET" action="">
        <input type="hidden" name="p" value="requisicoes">
        <input type="text" name="qr" placeholder="Pesquisar Requisição " value="<?php if (isset($_GET['qr'])) echo $_GET['qr']; ?>">
        <button class="icon" title="Pesquisar">
          <span class="material-symbols-rounded">
            search
          </span>
        </button>
      </form>
      <div class="req-cont">
        <header>
          <h1>Requisições</h1>
        </header>
        <main>
          <div class="req-info">
            <div class="req-card">
              <div class="req-dados">
                <div class="req-livro"></div>
                <div class="req-pessoa"></div>
              </div>
            </div>
          </div>
        </main>
      </div>

    </section>
  </main>


<?php

}

?>