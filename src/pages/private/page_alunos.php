<?php
if (!isset($_GET['edit_aluno']) and !isset($_GET['edit_senha_aluno']) and !isset($_GET['ranking']) and !isset($_GET['estante'])) {
?>



  <main class="cont">
    <section class="alunos">
      <div class="options">
        <div class="option-item trigger" onclick="acao()">
          <span class="material-symbols-rounded">
            group_add
          </span>
          <label for="">
            Cadastrar Aluno
          </label>
        </div>
        <div class="option-item trigger" onclick="location.href='?p=alunos&ranking'">
          <span class="material-symbols-rounded">
            diamond
          </span>
          <label for="">
            Ranking
            Leitores
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

      $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma WHERE idTurma != 'funcionarios' ORDER BY anoTurma, nomeTurma;");

      if (mysqli_num_rows($query_turma_aluno)) {
        while ($turma_aluno = mysqli_fetch_assoc($query_turma_aluno)) {
          $id_turma = $turma_aluno['idTurma'];
          if (isset($_GET['y']) and isset($_GET['n'])) {
            $y = trim($_GET['y']);
            $n = mb_strtoupper(trim($_GET['n']));
            $sql_aluno = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE idTurma != 'funcionarios' AND turmaPessoa = '$id_turma' AND statusPessoa != 'inativo' AND statusTurma != 'concluida' AND nomeTurma = '$n' AND anoTurma = '$y' ORDER BY turmaPessoa, nomePessoa;";
          } else if (isset($_GET['qa'])) {
            $qa = mb_strtoupper(trim($_GET['qa']));
            $sql_aluno = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE idTurma != 'funcionarios' AND turmaPessoa = '$id_turma' AND statusPessoa != 'inativo' AND statusTurma != 'concluida' AND CONCAT(nomePessoa, nomeTurma, anoTurma) LIKE '%$qa%' ORDER BY turmaPessoa, nomePessoa;";
          } else {
            $sql_aluno = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE idTurma != 'funcionarios' AND turmaPessoa = '$id_turma' AND statusPessoa != 'inativo' AND statusTurma != 'concluida' ORDER BY turmaPessoa, nomePessoa; ";
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
                    <a title="Editar Aluno" href="?p=alunos&edit_aluno=<?php echo $aluno_data['idPessoa']; ?>" class="edit-aluno">
                      <span class="material-symbols-rounded">
                        edit
                      </span>
                    </a>
                    <a title="Alterar Identificação" href="?p=alunos&edit_senha_aluno=<?php echo $aluno_data['idPessoa']; ?>" class="key-aluno">
                      <span class="material-symbols-rounded">
                        key
                      </span>
                    </a>
                    <a title="Abrir Estante" href="?p=alunos&estante=<?php echo $aluno_data['idPessoa']; ?>" class="estante-aluno">
                      <span class="material-symbols-rounded">
                        toc
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
            school
          </span>
          Cadastrar Aluno
        </h1>
        <button class="close">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_alunos/cad_aluno.php" id="alunoForm">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" id="nome">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select name="turma" id="turma">
              <option selected disabled value="0">Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma WHERE idTurma != 'funcionarios' ORDER BY anoTurma, nomeTurma;");

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
              <input type="text" name="ident" id="ident">
            </div>
            <div class="ident">
              <label for="">Tipo</label>
              <select name="tipoIdent" id="tipoIdent">
                <option selected disabled value="0">Selecione o tipo de dado</option>
                <option value="CPF">CPF</option>
                <option value="Matricula">Matrícula</option>
              </select>
            </div>
          </fieldset>
          <fieldset><a onclick="alunoVerify()">Cadastrar Aluno</a></fieldset>
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
            school
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
        <form class="form-modal" method="POST" action="src/modules/page_alunos/edit_aluno.php" id="alunoForm">
          <input type="hidden" name="id" value="<?php echo $edit_aluno['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" id="nome" value="<?php echo $edit_aluno['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select name="turma" id="turma">
              <option selected disabled value="0">Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma WHERE idTurma != 'funcionarios' ORDER BY anoTurma, nomeTurma;");

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
            <a class="del" onclick="return confirm('Deseja realmente EXCLUIR esse aluno?')" href="src/modules/page_alunos/del_aluno.php?del=<?php echo $edit_aluno['idPessoa'] ?>">
              <span class="material-symbols-rounded">
                delete_forever
              </span>
              Excluir Aluno
            </a>
            <a onclick="alunoEditVerify()">
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar Aluno
            </a>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

<?php } else if (isset($_GET['edit_senha_aluno'])) {

  require 'src/modules/conection.php';
  $id_aluno = $_GET['edit_senha_aluno'];
  $query_edit_aluno = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa = '$id_aluno';");
  $edit_aluno = mysqli_fetch_assoc($query_edit_aluno);

?>

  <main class="cont"></main>

  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            school
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
        <form class="form-modal" method="POST" action="src/modules/page_alunos/edit_ident_aluno.php" id="alunoForm">
          <input type="hidden" name="id" value="<?php echo $edit_aluno['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" id="nome" disabled value="<?php echo $edit_aluno['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select disabled name="turma" id="turma">
              <option selected disabled value="0">Escolha uma turma</option>

              <?php
              require 'src/modules/conection.php';

              $query_turma_aluno = mysqli_query($conn, "SELECT * FROM tb_turma WHERE idTurma != 'funcionarios' ORDER BY anoTurma, nomeTurma;");

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
              <input type="text" name="ident" id="ident">
            </div>
            <div class="ident">
              <label for="">Tipo</label>
              <select name="tipo" id="tipoIdent">
                <option selected disabled value="0">Selecione o tipo de dado</option>
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
            <a onclick="alunoIdentVerify()">
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar Aluno
            </a>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

<?php } else if (isset($_GET['ranking'])) {

  require 'src/modules/conection.php';

  $raking = mysqli_query($conn, "SELECT p.nomePessoa, t.nomeTurma, SUM(r.qtdReq) 'num' FROM tb_req AS r JOIN tb_pessoa AS p JOIN tb_turma AS t ON r.idPessoa = p.idPessoa AND p.turmaPessoa = t.idTurma WHERE p.statusPessoa = 'ativo' AND p.tipoPessoa = 'aluno' GROUP BY p.idPessoa ORDER BY num DESC, p.nomePessoa ASC;");

?>

  <main class="cont">
    <section class="ranking">
      <a class="back" href="?p=alunos">
        <span class="material-symbols-rounded">
          close
        </span>
      </a>
      <h1>Raking de Alunos Leitores</h1>
      <div class="rules">
        <div class="header">
          <span class="material-symbols-rounded">
            privacy_tip
          </span>
          <p>Regras de Desempate</p>
        </div>
        <div class="info">
          <p>O objetivo do raking é listar os alunos que MAIS LERAM LIVROS da biblioteca. Caso alguns alunos tenha efetuado a mesma quantidade de leituras, seja essa quantidade qual for, o sistema irá ordena-los na lista por ORDEM ALFABÉTICA. NENHUM dado como turma, gênero ou idade pode ser utilizado como parametros desse raking.</p>
        </div>
      </div>
      <div class="ranking-cont">
        <table>
          <tr>
            <th>Nº</th>
            <th>Nome</th>
            <th>Turma</th>
            <th>Leituras</th>
          </tr>
          <?php
          if ($raking) {
            $number = 1;
            while ($rank = mysqli_fetch_assoc($raking)) {
          ?>
              <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $rank['nomePessoa'] ?></td>
                <td><?php echo $rank['nomeTurma'] ?></td>
                <td><?php echo $rank['num'] ?></td>
              </tr>
          <?php
              $number = $number + 1;
            }
          }
          ?>
        </table>
      </div>
    </section>

  </main>

<?php } else if (isset($_GET['estante'])) { ?>

  <main class="cont">
    <section class="estante">
      <header>
        <h1>Estante de José Vanderlei</h1>
      </header>
    </section>
  </main>

<?php } ?>

<script>
  const alunoVerify = () => {
    const alunoForm = document.getElementById('alunoForm');
    const nameInput = document.getElementById('nome');
    const turmaSelect = document.getElementById('turma');
    const identInput = document.getElementById('ident');
    const tipoIdentSelect = document.getElementById('tipoIdent');

    if (nameInput.value === "") {
      toastr.warning("Digite o nome do aluno!");
      nameInput.focus();
      return;
    }
    if (turmaSelect.value == 0) {
      toastr.warning("Selecione a turma do aluno!");
      turmaSelect.focus();
      return;
    }
    if (identInput.value === "") {
      toastr.warning("Digite a identificação do aluno!");
      identInput.focus();
      return;
    }
    if (tipoIdentSelect.value == 0) {
      toastr.warning("Selecione o tipo de identificação do aluno!");
      tipoIdentSelect.focus();
      return;
    }
    alunoForm.submit();
  }
  const alunoEditVerify = () => {
    const alunoForm = document.getElementById('alunoForm');
    const nameInput = document.getElementById('nome');
    const turmaSelect = document.getElementById('turma');

    if (nameInput.value === "") {
      toastr.warning("Digite o nome do aluno!");
      nameInput.focus();
      return;
    }
    if (turmaSelect.value == 0) {
      toastr.warning("Selecione a turma do aluno!");
      turmaSelect.focus();
      return;
    }
  }
  const alunoIdentVerify = () => {
    const alunoForm = document.getElementById('alunoForm');
    const identInput = document.getElementById('ident');
    const tipoIdentSelect = document.getElementById('tipoIdent');
    if (identInput.value === "") {
      toastr.warning("Digite a identificação do aluno!");
      identInput.focus();
      return;
    }
    if (tipoIdentSelect.value == 0) {
      toastr.warning("Selecione o tipo de identificação do aluno!");
      tipoIdentSelect.focus();
      return;
    }
    alunoForm.submit();
  }
</script>