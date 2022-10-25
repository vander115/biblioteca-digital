<?php
if (!isset($_GET['edit_aluno']) and !isset($_GET['edit_senha_aluno'])) {
?>



  <main class="cont">
    <section class="alunos">
      <div class="options">
        <div class="option-item trigger" onclick="acao()">
          <span class="material-symbols-rounded">
            group_add
          </span>
          <label for="">
            Cadrastar Aluno
          </label>
        </div>
      </div>
      <form class="search" method="GET" action="">
        <input type="hidden" name="p" value="alunos">
        <input type="text" name="qa" placeholder="Pesquisar Aluno" value="<?php if (isset($_GET['qa'])) echo $_GET['qa']; ?>">
        <button class="icon" title="Pesquisar">
          <span class="material-symbols-rounded">
            search
          </span>
        </button>
      </form>
      <?php

      require 'src/modules/conection.php';

      $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma ORDER BY anoTurma, nomeTurma;");

      if ($query_turma_aluno) {
        while ($turma_aluno = mysqli_fetch_assoc($query_turma_aluno)) {
          $id_turma = $turma_aluno['idTurma'];
          if (isset($_GET['qa'])) {
            $qa = mb_strtoupper($_GET['qa']);
            $sql_aluno = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE turmaPessoa = '$id_turma' AND CONCAT(nomePessoa, nomeTurma, anoTurma) LIKE '%$qa%' ORDER BY turmaPessoa, nomePessoa;";
          } else {
            $sql_aluno = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE turmaPessoa = '$id_turma' ORDER BY turmaPessoa, nomePessoa; ";
          }

          $query_aluno_info = mysqli_query($conn, $sql_aluno);
          if (mysqli_num_rows($query_aluno_info)) {

      ?>
            <div class="alunos-cont">
              <header>
                <h1><?php echo $turma_aluno['anoTurma'] . 'º ' . $turma_aluno['nomeTurma']; ?></h1>
              </header>
              <main>

                <?php
                while ($aluno_data = mysqli_fetch_assoc($query_aluno_info)) {
                ?>

                  <div class="card-cont" onclick="location.href='src/modules/page_req/gerar_req.php?id_aluno_req=<?php echo $aluno_data['idPessoa']; ?>'">
                    <div class="card-aluno">
                      <header>
                        <span class="material-symbols-rounded">
                          person
                        </span>
                      </header>
                      <main>
                        <h1><?php echo $aluno_data['nomePessoa']; ?></h1>
                        <p><?php echo $aluno_data['anoTurma'] . 'º ' . strtok($aluno_data['nomeTurma'], " "); ?></p>
                      </main>
                    </div>
                    <a href="?p=alunos&edit_aluno=<?php echo $aluno_data['idPessoa']; ?>" class="edit-aluno">
                      <span class="material-symbols-rounded">
                        edit
                      </span>
                    </a>
                  </div>
                <?php } ?>
              </main>
            </div>

      <?php

          }
        }
      }


      ?>


    </section>
  </main>

  <div class="modal">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            magic_button
          </span>
          Cadrastar Turma
        </h1>
        <button class="close">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_alunos/cad_aluno.php">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select name="turma">
              <option selected disabled>Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma ORDER BY anoTurma, nomeTurma;");

              if ($query_turma_aluno) {
                while ($turmas = mysqli_fetch_assoc($query_turma_aluno)) {
              ?>

                  <option value="<?php echo $turmas['idTurma']; ?>"><?php echo $turmas['anoTurma'] . "º " . $turmas['nomeTurma']; ?></option>

              <?php
                }
              }
              ?>
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
          <fieldset><button>Cadrastar Aluno</button></fieldset>
        </form>
      </div>
    </div>
  </div>

<?php
} else if (isset($_GET['edit_aluno'])) {
  require 'src/modules/conection.php';
  $id_aluno = $_GET['edit_aluno'];
  $query_edit_aluno = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa = '$id_aluno';");
  $edit_aluno = mysqli_fetch_assoc($query_edit_aluno);
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
        <button class="close" onclick="location.href='?p=alunos'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_alunos/edit_aluno.php">
          <input type="hidden" name="id" value="<?php echo $edit_aluno['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" value="<?php echo $edit_aluno['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select name="turma">
              <option selected disabled>Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma ORDER BY anoTurma, nomeTurma;");

              if ($query_turma_aluno) {
                while ($turmas = mysqli_fetch_assoc($query_turma_aluno)) {
              ?>

                  <option <?php if ($edit_aluno['turmaPessoa'] == $turmas['idTurma']) {
                            echo ' selected ';
                          }; ?> value="<?php echo $turmas['idTurma']; ?>"><?php echo $turmas['anoTurma'] . "º " . $turmas['nomeTurma']; ?></option>

              <?php
                }
              }
              ?>
            </select>
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

<?php } else if (isset($_GET['edit_senha_aluno'])) {

  require 'src/modules/conection.php';
  $id_aluno = $_GET['edit_aluno'];
  $query_edit_aluno = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa = '$id_aluno';");
  $edit_aluno = mysqli_fetch_assoc($query_edit_aluno);

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
        <button class="close" onclick="location.href='?p=alunos'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_alunos/edit_aluno.php">
          <input type="hidden" name="id" value="<?php echo $edit_aluno['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" readonly value="<?php echo $edit_aluno['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select readonly name="turma">
              <option selected disabled>Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma ORDER BY anoTurma, nomeTurma;");

              if ($query_turma_aluno) {
                while ($turmas = mysqli_fetch_assoc($query_turma_aluno)) {
              ?>

                  <option <?php if ($edit_aluno['turmaPessoa'] == $turmas['idTurma']) {
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