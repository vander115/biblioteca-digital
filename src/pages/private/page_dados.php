<?php
if (!isset($_SESSION['user'])) {
  session_start();
}

$username = $_SESSION['user']['name'];

if (!isset($_GET['user']) and !isset($_GET['pass'])) {



?>
  <main class="cont">
    <section class="dados">
      <div class="options">
        <div class="version">
          <h2>Versão: 1.0</h2>
          <h3>De: 28/12/2022</h3>
        </div>
        <div class="option-item" onclick="location.href='pdf'">
          <span class="material-symbols-rounded">
            receipt_long
          </span>
          <label for="">
            Relatório Geral
          </label>
        </div>
        <div class="option-item" onclick="location.href='?p=dados&user'">
          <span class="material-symbols-rounded">
            sensor_occupied
          </span>
          <label for="">
            Alterar Usuário
          </label>
        </div>
        <div class="option-item" onclick="location.href='?p=dados&pass'">
          <span class="material-symbols-rounded">
            lock_reset
          </span>
          <label for="">
            Alterar Senha
          </label>
        </div>
        <div class="option-item theme" onclick="location.href='src/modules/page_dados/change_theme.php'">
          <span class="material-symbols-rounded">
            <?php if ($_SESSION['theme'] == 'dark') {
              echo 'light_mode';
            } else if ($_SESSION['theme'] == 'default') {
              echo 'dark_mode';
            } ?>
          </span>
          <label for="">
            Alterar Tema para <?php if ($_SESSION['theme'] == 'dark') {
                                echo 'Claro';
                              } else if ($_SESSION['theme'] == 'default') {
                                echo 'Escuro';
                              } ?>
          </label>
        </div>
      </div>

      <div class="dados-cont">
        <header>
          <h2>Dados do Sistema</h2>
        </header>
        <main>
          <?php

          require 'src/modules/conection.php';

          $livros = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) 'livros' FROM tb_livros;"));
          $generos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) 'generos' FROM tb_genero_livro;"));
          $req = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) 'req' FROM tb_req;"));
          $alunos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) 'alunos' FROM tb_pessoa WHERE tipoPessoa = 'Aluno' AND statusPessoa = 'ativo';"));
          $func = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) 'func' FROM tb_pessoa WHERE tipoPessoa != 'Aluno';"));
          $turmas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) 'turmas' FROM tb_turma;"));

          ?>
          <div class="dados-card">
            <div class="dados-info">
              <article>
                <h2>Número de Livros:</h2>
                <p><?php echo $livros['livros'] . ' Livros'; ?></p>
              </article>
              <article>
                <h2>Número de Gêneros/Categorias:</h2>
                <p><?php echo $generos['generos'] . ' Gêneros'; ?></p>
              </article>
              <article>
                <h2>Número de Requisições:</h2>
                <p><?php echo $req['req'] . ' Requisições'; ?></p>
              </article>
            </div>
            <div class="dados-info">
              <article>
                <h2>Número de Alunos:</h2>
                <p><?php echo $alunos['alunos'] . ' Alunos'; ?></p>
              </article>
              <article>
                <h2>Número de Turmas</h2>
                <p><?php echo $turmas['turmas'] . ' Turmas'; ?></p>
              </article>
              <article>
                <h2>Número de Funcionários:</h2>
                <p><?php echo $func['func'] . ' Funcionários'; ?></p>
              </article>
            </div>
          </div>
        </main>
      </div>
    </section>
  </main>

<?php } else if (isset($_GET['user'])) {

?>
  <main class="cont">
  </main>
  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            sensor_occupied
          </span>
          Alterar Usuário
        </h1>
        <button class="close" onclick="location.href='?p=dados'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" id="userForm" action="src/modules/page_dados/edit_user.php">
          <fieldset>
            <label for="">Nome de Usuário Atual:</label><input value="<?php echo $username; ?>" disabled type="text">
          </fieldset>
          <fieldset>
            <label for="">Novo nome de Usuário:</label><input name="username" id="user" type="text">
          </fieldset>
          <fieldset><a type="button" onclick="userVerify()">Alterar Usuário</a></fieldset>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    const userForm = document.getElementById('userForm');
    const userInput = document.getElementById('user');

    const userVerify = () => {
      if (userInput.value === "") {
        toastr.warning('Digite o novo nome de usuário!');
        userInput.focus();
        return;
      }
      userForm.submit();
    }
  </script>

<?php } else if (isset($_GET['pass'])) { ?>
  <main class="cont">
  </main>
  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            lock_reset
          </span>
          Alterar Senha
        </h1>
        <button class="close" onclick="location.href='?p=dados'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" id="passForm" action="src/modules/page_dados/edit_pass.php">
          <fieldset>
            <label for="">Nova Senha:</label><input name="pass" id="passInput" type="text">
          </fieldset>
          <fieldset>
            <label for="">Digite a senha novamente:</label><input id="repassInput" name="repass" type="text">
          </fieldset>
          <fieldset><a type="button" onclick="passVerify()">Alterar Senha</a></fieldset>
        </form>
      </div>
    </div>
  </div>

  <script>
    const passVerify = () => {
      const passForm = document.getElementById('passForm');
      const passInput = document.getElementById('passInput');
      const repassInput = document.getElementById('repassInput');
      if (passInput.value === "") {
        passInput.focus();
        toastr.warning('Digite a nova senha!');
        return;
      }
      if (repassInput.value === "") {
        repassInput.focus();
        toastr.warning('Digite a nova senha!');
        return;
      }
      if (passInput.value != repassInput.value) {
        toastr.warning('As senhas não correspondem!');
        repassInput.value = "";
        return;
      }
      passForm.submit();
    }
  </script>
<?php } ?>