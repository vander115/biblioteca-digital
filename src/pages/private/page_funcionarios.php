<?php

function option($option, $value)
{
  if ($option == $value) {
    echo ' selected';
  }
}

if (!isset($_GET['edit_func']) and !isset($_GET['edit_senha_func'])) {
?>



  <main class="cont">
    <section class="alunos">
      <div class="options">
        <div class="option-item trigger" onclick="acao()">
          <span class="material-symbols-rounded">
            group_add
          </span>
          <label for="">
            Cadrastar Funcionário
          </label>
        </div>
      </div>
      <form class="search" method="GET" action="">
        <input type="hidden" name="p" value="funcionarios">
        <input type="text" name="qf" placeholder="Pesquisar Funcionário" value="<?php if (isset($_GET['qf'])) echo $_GET['qf']; ?>">
        <button class="icon" title="Pesquisar">
          <span class="material-symbols-rounded">
            search
          </span>
        </button>
      </form>
      <div class="alunos-cont">
        <header>
          <h1>Funcionários</h1>
        </header>
        <main>

          <?php

          require 'src/modules/conection.php';

          if (isset($_GET['qf'])) {
            $qf = mb_strtoupper($_GET['qf']);
            $sql_funcionario = "SELECT * FROM tb_pessoa WHERE CONCAT(nomePessoa, nomeTurma, anoTurma) LIKE '%$qf%' AND tipoPessoa != 'Aluno' ORDER BY turmaPessoa, nomePessoa;";
          } else {
            $sql_funcionario = "SELECT * FROM tb_pessoa WHERE tipoPessoa != 'Aluno' ORDER BY tipoPessoa, nomePessoa; ";
          }

          $query_func_info = mysqli_query($conn, $sql_funcionario);

          while ($func_data = mysqli_fetch_assoc($query_func_info)) {
          ?>

            <div class="card-cont" onclick="location.href='src/modules/page_req/gerar_req.php?id_func_req=<?php echo $func_data['idPessoa']; ?>'">
              <div class="card-aluno">
                <header>
                  <span class="material-symbols-rounded">
                    person
                  </span>
                </header>
                <main>
                  <h1><?php echo $func_data['nomePessoa']; ?></h1>
                  <p><?php echo mb_strtoupper($func_data['tipoPessoa']) ?></p>
                </main>
              </div>
              <a href="?p=funcionarios&edit_func=<?php echo $func_data['idPessoa']; ?>" class="edit-aluno">
                <span class="material-symbols-rounded">
                  edit
                </span>
              </a>
            </div>
          <?php } ?>
        </main>
      </div>
    </section>
  </main>

  <div class="modal">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            magic_button
          </span>
          Cadrastar Funcionário
        </h1>
        <button class="close">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_func/cad_func.php">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text">
          </fieldset>
          <fieldset>
            <label for="">Tipo:</label>
            <select name="tipo">
              <option selected disabled>Escolha uma cargo:</option>
              <option value="Professor">Professor</option>
              <option value="Diretor">Diretor</option>
              <option value="Coordenador">Coordenador</option>
              <option value="Secretário">Secretário</option>
              <option value="Limpeza">Limpeza</option>
              <option value="Funcionário">Funcionário</option>
            </select>
          </fieldset>
          <fieldset class="oneline-modal">
            <div>
              <label name="ident" for="">Indentificação</label>
              <input type="text" name="ident">
            </div>
            <div class="ident">
              <label for="">Tipo</label>
              <select name="tipoIdent" id="">
                <option selected disabled>Selecione o tipo de dado</option>
                <option value="CPF">CPF</option>
                <option value="Matricula">Matrícula</option>
              </select>
            </div>
          </fieldset>
          <fieldset><button>Cadrastar Funcionário</button></fieldset>
        </form>
      </div>
    </div>
  </div>

<?php
} else if (isset($_GET['edit_func'])) {
  require 'src/modules/conection.php';
  $id_funcionario = $_GET['edit_func'];
  $query_edit_funcionario = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa = '$id_funcionario';");
  $edit_funcionario = mysqli_fetch_assoc($query_edit_funcionario);
?>

  <main class="cont"></main>

  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            magic_button
          </span>
          Editar Aluno
        </h1>
        <button class="close" onclick="location.href='?p=funcionarios'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_funcionarios/edit_funcionario.php">
          <input type="hidden" name="id" value="<?php echo $edit_funcionario['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" value="<?php echo $edit_funcionario['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Tipo:</label>
            <select name="tipo">
              <option selected disabled>Escolha uma cargo:</option>
              <option value="Professor" <?php option('Professor', $edit_funcionario['tipoPessoa']); ?>>Professor</option>
              <option value="Diretor" <?php option('Diretor', $edit_funcionario['tipoPessoa']); ?>>Diretor</option>
              <option value="Coordenador" <?php option('Coordenador', $edit_funcionario['tipoPessoa']); ?>>Coordenador</option>
              <option value="Secretário" <?php option('Secretário', $edit_funcionario['tipoPessoa']); ?>>Secretário</option>
              <option value="Limpeza" <?php option('Limpeza', $edit_funcionario['tipoPessoa']); ?>>Limpeza</option>
              <option value="Funcionário" <?php option('Funcionário', $edit_funcionario['tipoPessoa']); ?>>Funcionário</option>
              ?>
            </select>
          </fieldset>
          <fieldset class="oneline-modal">
            <button class="del">
              <span class="material-symbols-rounded">
                delete_forever
              </span>
              Excluir Funcionário
            </button>
            <button>
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar Funcionário
            </button>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

<?php } else if (isset($_GET['edit_senha_funcionario'])) {

  require 'src/modules/conection.php';
  $id_funcionario = $_GET['edit_funcionario'];
  $query_edit_funcionario = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa = '$id_funcionario';");
  $edit_funcionario = mysqli_fetch_assoc($query_edit_funcionario);

?>

  <main class="cont"></main>

  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            magic_button
          </span>
          Alterar Identificação do Aluno
        </h1>
        <button class="close" onclick="location.href='?p=funcionarios'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_funcionarios/edit_funcionario.php">
          <input type="hidden" name="id" value="<?php echo $edit_funcionario['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" readonly value="<?php echo $edit_funcionario['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select readonly name="turma">
              <option selected disabled>Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_funcionario = mysqli_query($conn, "SELECT * FROM tb_turma ORDER BY anoTurma, nomeTurma;");

              if ($query_turma_funcionario) {
                while ($turmas = mysqli_fetch_assoc($query_turma_funcionario)) {
              ?>

                  <option <?php if ($edit_funcionario['turmaPessoa'] == $turmas['idTurma']) {
                            echo ' selected ';
                          }; ?> value="<?php echo $turmas['idTurma']; ?>"><?php echo $turmas['anoTurma'] . "º " . $turmas['nomeTurma']; ?></option>

              <?php
                }
              }
              ?>
            </select>
          </fieldset>
          <fieldset class="oneline-modal">
            <div>
              <label name="ident" for="">Indentificação</label>
              <input type="text">
            </div>
            <div class="ident">
              <label for="">Tipo</label>
              <select name="tipoIdent" id="">
                <option selected disabled>Selecione o tipo de dado</option>
                <option value="CPF">CPF</option>
                <option value="Matricula">Matrícula</option>
              </select>
            </div>
          </fieldset>
          <fieldset class="oneline-modal">
            <button class="del">
              <span class="material-symbols-rounded">
                delete_forever
              </span>
              Excluir Aluno
            </button>
            <button>
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar Aluno
            </button>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

<?php } ?>