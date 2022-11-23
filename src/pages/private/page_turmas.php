<?php

require 'src/functions/mudar_ano_turma.php';

mudar_ano_turma();

if (!isset($_GET['edit_turma'])) {
?>

  <main class="cont">
    <section class="turmas">
      <div class="options">
        <div class="option-item trigger" onclick="acao()">
          <span class="material-symbols-rounded">
            hotel_class
          </span>
          <label for="">
            Cadastrar Turma
          </label>
        </div>
      </div>
      <form class="search" method="GET" action="">
        <input type="hidden" name="p" value="turmas">
        <input type="text" name="qt" placeholder="Pesquisar Turma" value="<?php if (isset($_GET['qt'])) echo $_GET['qt']; ?>">
        <button class="icon" title="Pesquisar">
          <span class="material-symbols-rounded">
            search
          </span>
        </button>
      </form>


      <?php

      require 'src/modules/conection.php';

      $a = array('1º Ano', '2º Ano', '3º Ano');

      foreach ($a as $ano) {
        $key = array_search($ano, $a) + 1;

        if (isset($_GET['qt'])) {
          $qt = mb_strtoupper(trim($_GET['qt']));

          $sql = "SELECT * FROM tb_turma WHERE idTurma != 0 AND CONCAT(nomeTurma, anoTurma) LIKE '%$qt%' AND anoTurma = '$key' AND statusTurma = 'egressa' ORDER BY nomeTurma;";
        } else {
          $sql = "SELECT * FROM tb_turma WHERE idTurma != 0 AND anoTurma = '$key' AND statusTurma = 'egressa' ORDER BY nomeTurma;";
        }

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query)) {
      ?>
          <div class="turmas-cont">
            <header>
              <h1><?php echo $ano; ?></h1>
            </header>
            <main>
              <?php
              while ($turma = mysqli_fetch_assoc($query)) {
              ?>
                <div class="card-cont">
                  <div class="card-turma">
                    <h1><?php echo $turma['anoTurma'] . 'º'; ?></h1>
                    <section>
                      <h2>
                        <?php echo $turma['nomeTurma']; ?>
                      </h2>
                    </section>
                  </div>
                  <a href="?p=turmas&edit_turma=<?php echo $turma['idTurma']; ?>" class="edit-turma">
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
          Cadastrar Turma
        </h1>
        <button class="close">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" id="turmaForm" method="POST" action="src/modules/page_turmas/cad_turma.php">
          <fieldset class="oneline-modal">
            <div><label for="">Nome</label><input name="nome" id="nome" type="text"></div>
            <div class="ano">
              <label for="">Série</label>
              <select name="ano" id="ano">
                <option disabled selected value="0">Ano</option>
                <option value="1">1º</option>
                <option value="2">2º</option>
                <option value="3">3º</option>
              </select>
            </div>
          </fieldset>
          <fieldset><a onclick="turmaVerify()">Cadastrar Turma</a></fieldset>
        </form>
      </div>
    </div>
  </div>

<?php
} else {

  require 'src/modules/conection.php';
  $id_edit = $_GET['edit_turma'];
  $query_edit = mysqli_query($conn, "SELECT * FROM tb_turma WHERE idTurma = '$id_edit';");
  $turma_array = mysqli_fetch_assoc($query_edit);

?>
  <main class="cont">

  </main>

  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            magic_button
          </span>
          Editar Turma
        </h1>
        <button onclick="location.href='?p=turmas'" class="close">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" id="turmaForm" action="src/modules/page_turmas/edit_turma.php">
          <input type="hidden" name="id" value="<?php echo $turma_array['idTurma']; ?>">
          <fieldset class="oneline-modal">
            <div class="ano">
              <label for="">Série</label>
              <select name="ano" id="ano">
                <option disabled selected value="0">Ano</option>
                <option <?php if ($turma_array['anoTurma'] == '1') {
                          echo ' selected ';
                        } ?> value="1">1º</option>
                <option <?php if ($turma_array['anoTurma'] == '2') {
                          echo ' selected ';
                        } ?> value="2">2º</option>
                <option <?php if ($turma_array['anoTurma'] == '3') {
                          echo ' selected ';
                        } ?>value="3">3º</option>
              </select>
            </div>
            <div><label for="">Nome</label><input name="nome" id="nome" type="text" value="<?php echo $turma_array['nomeTurma']; ?>"></div>
          </fieldset>
          <fieldset class="oneline-modal">
            <a href="src/modules/page_turmas/del_turma.php?del_turma=<?php echo $turma_array['idTurma']; ?>" onclick="return confirm('Deseja realmente apagar turma? TODOS os ALUNOS cadrastados nela serão APAGADOS!')" class="del">
              <span class="material-symbols-rounded">
                delete_forever
              </span>
              Deletar Turma</a>
            <a onclick="turmaVerify()">
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar Turma</a>
          </fieldset>
        </form>
      </div>
    </div>
  </div>


<?php } ?>

<script>
  const turmaVerify = () => {

    const turmaForm = document.getElementById('turmaForm');
    const nameInput = document.getElementById('nome');
    const anoInput = document.getElementById('ano');

    if (nameInput.value === "") {
      toastr.warning("Digite o nome da turma!");
      nameInput.focus();
      return;
    }
    if (anoInput.value == 0) {
      toastr.warning("Selecione o ano da turma!");
      anoInput.focus();
      return;
    }
    turmaForm.submit();
  }
</script>