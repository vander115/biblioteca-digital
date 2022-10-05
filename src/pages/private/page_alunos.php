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
    <div class="alunos-cont">
      <header>
        <h1>3° Informática</h1>
      </header>
      <main>
        <div class="card-cont">
          <div class="card-aluno">
            <header>
              <span class="material-symbols-rounded">
                person
              </span>
            </header>
            <main>
              <h1>José Vanderlei Furtuna Tomé</h1>
              <p>3º Informática</p>
            </main>
          </div>
        </div>
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
        <fieldset><button>Cadrastar Aluno</button></fieldset>
      </form>
    </div>
  </div>
</div>