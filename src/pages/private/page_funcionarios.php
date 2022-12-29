<?php

function option($option, $value)
{
  if ($option == $value) {
    echo ' selected';
  }
}

if (!isset($_GET['edit_func']) and !isset($_GET['edit_senha_func']) and !isset($_GET['estante'])) {
?>



  <main class="cont">
    <section class="alunos">
      <div class="options">
        <div class="option-item trigger" onclick="acao()">
          <span class="material-symbols-rounded">
            group_add
          </span>
          <label for="">
            Cadastrar Funcionário
          </label>
        </div>
      </div>
      <form class="search" method="GET">
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
            $qf = mb_strtoupper(trim($_GET['qf']));
            $sql_funcionario = "SELECT * FROM tb_pessoa WHERE CONCAT (nomePessoa, tipoPessoa) LIKE '%$qf%' AND tipoPessoa != 'Aluno' AND statusPessoa != 'inativo' ORDER BY turmaPessoa, nomePessoa;";
          } else {
            $sql_funcionario = "SELECT * FROM tb_pessoa WHERE tipoPessoa != 'Aluno' AND statusPessoa != 'inativo' ORDER BY tipoPessoa, nomePessoa; ";
          }

          $query_func_info = mysqli_query($conn, $sql_funcionario);
          if (mysqli_num_rows($query_func_info)) {
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
                <a title="Alterar Funcionário" href="?p=funcionarios&edit_func=<?php echo $func_data['idPessoa']; ?>" class="edit-aluno">
                  <span class="material-symbols-rounded">
                    edit
                  </span>
                </a>
                <a title="Alterar Identificação" href="?p=funcionarios&edit_senha_func=<?php echo $func_data['idPessoa']; ?>" class="key-aluno">
                  <span class="material-symbols-rounded">
                    key
                  </span>
                </a>
                <a title="Abrir Estante" href="?p=funcionarios&estante=<?php echo $func_data['idPessoa']; ?>" class="estante-aluno">
                  <span class="material-symbols-rounded">
                    toc
                  </span>
                </a>
              </div>
            <?php }
          } else { ?>
            <p>Nenhum funcionário correspondente :(</p>
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
            person
          </span>
          Cadastrar Funcionário
        </h1>
        <button class="close">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_func/cad_func.php" name="funcForm" id="funcForm">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" id="nome">
          </fieldset>
          <fieldset>
            <label for="">Tipo:</label>
            <select name="tipo" id="tipo">
              <option selected disabled value="0">Escolha uma cargo:</option>
              <option value="Professor">Professor(a)</option>
              <option value="Diretor">Diretor(a)</option>
              <option value="Coordenador">Coordenador(a)</option>
              <option value="Secretário">Secretário(a)</option>
              <option value="Limpeza">Limpeza</option>
              <option value="Funcionário">Funcionário(a)</option>
            </select>
          </fieldset>
          <fieldset class="oneline-modal">
            <div>
              <label name="ident" for="">Indentificação</label>
              <input type="text" id="ident" name="ident">
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
          <fieldset>
            <a onclick="funcVerify()">
              <span class="material-symbols-rounded">
                add
              </span>
              Cadastrar Funcionário
            </a>
          </fieldset>
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
            person
          </span>
          Alterar Funcionário
        </h1>
        <button class="close" onclick="location.href='?p=funcionarios'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" id="funcForm" action="src/modules/page_func/edit_func.php">
          <input type="hidden" name="id" value="<?php echo $edit_funcionario['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" id="nome" type="text" value="<?php echo $edit_funcionario['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Tipo:</label>
            <select name="tipo" id="tipo">
              <option selected disabled value="0">Escolha uma cargo:</option>
              <option value="Professor" <?php option('Professor', $edit_funcionario['tipoPessoa']); ?>>Professor</option>
              <option value="Diretor" <?php option('Diretor', $edit_funcionario['tipoPessoa']); ?>>Diretor</option>
              <option value="Coordenador" <?php option('Coordenador', $edit_funcionario['tipoPessoa']); ?>>Coordenador</option>
              <option value="Secretário" <?php option('Secretário', $edit_funcionario['tipoPessoa']); ?>>Secretário</option>
              <option value="Limpeza" <?php option('Limpeza', $edit_funcionario['tipoPessoa']); ?>>Limpeza</option>
              <option value="Funcionário" <?php option('Funcionário', $edit_funcionario['tipoPessoa']); ?>>Funcionário</option>
            </select>
          </fieldset>
          <fieldset class="oneline-modal">
            <a class="del" onclick="return confirm('Deseja realmente EXCLUIR funcionário?')" href="src/modules/page_func/del_func.php?del=<?php echo $edit_funcionario['idPessoa'] ?>">
              <span class="material-symbols-rounded">
                delete_forever
              </span>
              Excluir Funcionário
            </a>
            <a type="button" onclick="funcVerifyEdit()">
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar Funcionário
            </a>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

<?php } else if (isset($_GET['edit_senha_func'])) {

  require 'src/modules/conection.php';
  $id_funcionario = $_GET['edit_senha_func'];
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
          Alterar Identificação do Funcionário
        </h1>
        <button class="close" onclick="location.href='?p=funcionarios'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <form class="form-modal" method="POST" action="src/modules/page_func/edit_ident_func.php" name="funcForm" id="funcForm">
          <input type="hidden" name="id" value="<?php echo $edit_funcionario['idPessoa']; ?>">
          <fieldset>
            <label for="">Nome</label>
            <input name="nome" type="text" id="nome" disabled value="<?php echo $edit_funcionario['nomePessoa']; ?>">
          </fieldset>
          <fieldset>
            <label for="">Turma</label>
            <select disabled name="turma" id="turma">
              <option selected disabled value="0">Escolha uma cargo:</option>
              <option value="Professor" <?php option('Professor', $edit_funcionario['tipoPessoa']); ?>>Professor</option>
              <option value="Diretor" <?php option('Diretor', $edit_funcionario['tipoPessoa']); ?>>Diretor</option>
              <option value="Coordenador" <?php option('Coordenador', $edit_funcionario['tipoPessoa']); ?>>Coordenador</option>
              <option value="Secretário" <?php option('Secretário', $edit_funcionario['tipoPessoa']); ?>>Secretário</option>
              <option value="Limpeza" <?php option('Limpeza', $edit_funcionario['tipoPessoa']); ?>>Limpeza</option>
              <option value="Funcionário" <?php option('Funcionário', $edit_funcionario['tipoPessoa']); ?>>Funcionário</option>
            </select>
          </fieldset>
          <fieldset class="oneline-modal">
            <div>
              <label name="ident" for="">Indentificação</label>
              <input type="text" id="ident" name="ident">
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
            <a onclick="funcVerifyEditPassword()">
              <span class="material-symbols-rounded">
                edit
              </span>
              Alterar
            </a>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

<?php } else if (isset($_GET['estante'])) {
  require 'src/modules/conection.php';

  $id_estante = $_GET['estante'];

  $pessoa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE idPessoa ='$id_estante';"));

  $query_estante = mysqli_query($conn, "SELECT * FROM tb_req as r JOIN tb_livros as l ON r.idLivro = l.idLivro WHERE r.idPessoa = '$id_estante' ORDER BY dataEntregaReq DESC;");
?>
  <main class="cont">
    <section class="estante">
      <button class="close" onclick="location.href='?p=funcionarios'">
        <span class="material-symbols-rounded">
          close
        </span>
      </button>
      <header>
        <h1>Estante de <?php echo $pessoa['nomePessoa']; ?></h1>
        <h2><?php echo $pessoa['tipoPessoa'] ?></h2>
      </header>
      <main>
        <?php
        if (mysqli_num_rows($query_estante)) {
          while ($estante = mysqli_fetch_assoc($query_estante)) {
        ?>
            <div class="book-info <?php if ($estante['statusReq'] == 'pendente') {
                                    echo 'pendente';
                                  } ?>">
              <div class="book">
                <h2><?php echo $estante['tituloLivro']; ?></h2>
                <p><?php echo $estante['autorLivro']; ?></p>
              </div>
              <div class="status">
                <p><?php echo $estante['statusReq']; ?></p>
              </div>
              <div class="date">
                <p>Pedido em: <?php echo date("d/m/Y", strtotime($estante['dataReq'])); ?></p>
                <p>Entrega em: <?php echo date("d/m/Y", strtotime($estante['dataEntregaReq'])); ?></p>
              </div>
            </div>
          <?php   }
        } else { ?>
          <p>Nenhum livro lido até o momento :( </p>
        <?php } ?>
      </main>
    </section>
  </main>
<?php
} ?>

<script>
  const funcVerify = () => {

    const funcForm = document.getElementById('funcForm');
    const nameInput = document.getElementById('nome');
    const tipoFunc = document.getElementById('tipo');
    const tipoIdent = document.getElementById('tipoIdent');
    const identInput = document.getElementById('ident');

    if (nameInput.value === "") {
      toastr.warning("Digite o nome do funcionário");
      nameInput.focus();
      return;
    }
    if (tipoFunc.value == 0) {
      toastr.warning("Selecione o tipo de funcionário!");
      tipoFunc.focus();
      return;
    }
    if (identInput.value == 0) {
      toastr.warning("Digite a identificação do funcionário!");
      identInput.focus();
      return;
    }
    if (tipoIdent.value == 0) {
      toastr.warning("Selecione o tipo de identificação!");
      anoInput.focus();
      return;
    }
    funcForm.submit();
  }
  const funcVerifyEdit = () => {

    const funcForm = document.getElementById('funcForm');
    const nameInput = document.getElementById('nome');
    const tipoFunc = document.getElementById('tipo');
    const tipoIdent = document.getElementById('tipoIdent');
    const identInput = document.getElementById('ident');

    if (nameInput.value === "") {
      toastr.warning("Digite o nome do funcionário");
      nameInput.focus();
      return;
    }
    if (tipoFunc.value == 0) {
      toastr.warning("Selecione o tipo de funcionário!");
      tipoFunc.focus();
      return;
    }
    funcForm.submit();
  }
  const funcVerifyEditPassword = () => {

    const funcForm = document.getElementById('funcForm');
    const nameInput = document.getElementById('nome');
    const tipoFunc = document.getElementById('tipo');
    const tipoIdent = document.getElementById('tipoIdent');
    const identInput = document.getElementById('ident');

    if (identInput.value === "") {
      toastr.warning("Digite a identificação do funcionário!");
      identInput.focus();
      return;
    }
    if (tipoIdent.value == 0) {
      toastr.warning("Selecione o tipo de identificação!");
      tipoIdent.focus();
      return;
    }
    funcForm.submit();
  }
</script>