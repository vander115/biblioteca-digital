<?php

require 'src/functions/verificar_req.php';

verificarReq();

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET['pr'])) {
  $idReq = $_GET['pr'];
  require 'src/modules/conection.php';
  $query_req_modal = mysqli_query($conn, "SELECT p.nomePessoa, l.tituloLivro, r.dataReq, r.dataEntregaReq, r.statusReq, r.idReq, t.nomeTurma, t.anoTurma FROM tb_req AS r JOIN tb_pessoa AS p JOIN tb_livros AS l JOIN tb_turma as t ON r.idLivro = l.idLivro AND r.idPessoa = p.idPessoa AND p.turmaPessoa = t.idTurma WHERE idReq = '$idReq';");

  $req_modal = mysqli_fetch_assoc($query_req_modal);
  $date = date('Y-m-d');
  $dataAtual = new DateTime($date);
  $dataEntrega = new DateTime($req_modal['dataEntregaReq']);
  $diasRestantes = $dataEntrega->diff($dataAtual)->format('%a');
?>

  <main class="cont"></main>

  <div class="modal open">
    <div class="modal-cont">
      <div class="modal-header">
        <h1>
          <span class="material-symbols-rounded">
            more_time
          </span>
          Prorrogar Requisição
        </h1>
        <button class="close" onclick="location.href='?p=requisicoes'">
          <span class="material-symbols-rounded">
            close
          </span>
        </button>
      </div>
      <div class="modal-main">
        <div class="req-info">
          <div class="req-dados">
            <section class='people'>
              <h2>Pessoa:</h2>
              <p><?php echo $req_modal['nomePessoa'] ?></p>
              <h3><?php echo $req_modal['anoTurma'] . 'º ' . strtok($req_modal['nomeTurma'], " "); ?></h3>
            </section>
            <section class='book'>
              <h2>Livro:</h2>
              <p><?php echo $req_modal['tituloLivro'] ?></p>
              <h3>3º Informática</h3>
            </section>
            <section class='infomations'>
              <div>
                <h2>Data de Requisição:</h2>
                <p><?php echo date("d/m/Y", strtotime($req_modal['dataReq'])) ?></p>
              </div>
              <div class="entrega">
                <h2>Data de Entrega:</h2>
                <p><?php echo date("d/m/Y", strtotime($req_modal['dataEntregaReq'])) ?></p>
              </div>
              <div>
                <h2>Status:</h2>
                <p><?php echo mb_strtoupper($req_modal['statusReq']) . '. Restam ' . $diasRestantes . ' dias.' ?></p>
              </div>
            </section>
          </div>
          <div class="req-dias">
            <form action="src/modules/page_req/prorrogar_req.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $req_modal['idReq']; ?>">
              <header>
                <h1>Quantidade de Dias</h1>
              </header>
              <main>
                <label for="">Prazo: Dias</label>
                <div class="dias-input">
                  <span class="next"></span>
                  <span class="prev"></span>
                  <input id="number" type="number" name="prazo" value="5">
                </div>
              </main>
              <footer>
                <button>
                  <span class="material-symbols-rounded">
                    more_time
                  </span>
                  Prorrogar
                </button>
              </footer>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
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
} else if (isset($_SESSION['req']['status'])) {
  if ($_SESSION['req']['status'] == "pendente") {
    require 'src/modules/conection.php';


    $id_livro = $_SESSION['req']['livro'];
    $query_livro = mysqli_query($conn, "SELECT * FROM tb_livros WHERE idLivro = '$id_livro';");

    if (isset($_SESSION['req']['aluno'])) {
      $id_pessoa = $_SESSION['req']['aluno'];
      $sql_pessoa = "SELECT * FROM tb_pessoa AS p JOIN tb_turma AS t ON p.turmaPessoa = t.idTurma WHERE p.idPessoa = '$id_pessoa';";
    } else {
      $id_pessoa = $_SESSION['req']['func'];
      $sql_pessoa = "SELECT * FROM tb_pessoa WHERE idPessoa = '$id_pessoa';";
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
        <div class="option-item trigger" onclick="location.href='?p=requisicoes&qr=pendente'">
          <span class="material-symbols-rounded">
            error
          </span>
          <label for="">
            Ver Pendentes
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
          <?php
          require 'src/modules/conection.php';

          if (isset($_GET['qr'])) {
            $qr = mb_strtoupper(trim($_GET['qr']));
            $sql_req = "SELECT p.nomePessoa, l.tituloLivro, r.dataReq, r.dataEntregaReq, r.statusReq, r.idReq, t.nomeTurma, t.anoTurma FROM tb_req AS r JOIN tb_pessoa AS p JOIN tb_livros AS l JOIN tb_turma as t ON r.idLivro = l.idLivro AND r.idPessoa = p.idPessoa AND p.turmaPessoa = t.idTurma WHERE statusReq != 'concluida' AND CONCAT(p.nomePessoa, l.tituloLivro, r.dataReq, r.dataEntregaReq, r.statusReq, r.idReq, t.nomeTurma, t.anoTurma) LIKE '%$qr%' ORDER BY r.dataEntregaReq;";
          } else {
            $sql_req = "SELECT p.nomePessoa, l.tituloLivro, r.dataReq, r.dataEntregaReq, r.statusReq, r.idReq, t.nomeTurma, t.anoTurma FROM tb_req AS r JOIN tb_pessoa AS p JOIN tb_livros AS l JOIN tb_turma as t ON r.idLivro = l.idLivro AND r.idPessoa = p.idPessoa AND p.turmaPessoa = t.idTurma WHERE statusReq != 'concluida' ORDER BY r.dataEntregaReq;";
          }

          $query_req = mysqli_query($conn, $sql_req);
          if (mysqli_num_rows($query_req)) {
            while ($req = mysqli_fetch_assoc($query_req)) {
              $date = date('Y-m-d');
              $dataAtual = new DateTime($date);
              $dataEntrega = new DateTime($req['dataEntregaReq']);
              $diasRestantes = $dataEntrega->diff($dataAtual)->format('%a');

          ?>
              <div class="req-info <?php if ($diasRestantes <= 0) {
                                      echo 'pendente';
                                    } ?>">
                <div class="req-card">
                  <div class="req-dados">
                    <section class='people'>
                      <h2>Pessoa:</h2>
                      <p><?php echo $req['nomePessoa'] ?></p>
                      <h3><?php echo $req['anoTurma'] . 'º ' . strtok($req['nomeTurma'], " "); ?></h3>
                    </section>
                    <section class='book'>
                      <h2>Livro:</h2>
                      <p><?php echo $req['tituloLivro'] ?></p>
                      <h3>3º Informática</h3>
                    </section>
                    <section class='infomations'>
                      <div>
                        <h2>Data de Requisição:</h2>
                        <p><?php echo date("d/m/Y", strtotime($req['dataReq'])) ?></p>
                      </div>
                      <div class="entrega">
                        <h2>Data de Entrega:</h2>
                        <p><?php echo date("d/m/Y", strtotime($req['dataEntregaReq'])) ?></p>
                      </div>
                      <div>
                        <h2>Status:</h2>
                        <p><?php echo mb_strtoupper($req['statusReq']) . '. Restam ' . $diasRestantes . ' dias.' ?></p>
                      </div>
                    </section>
                    <section class="buttons">
                      <a href="?p=requisicoes&pr=<?php echo $req['idReq'] ?>"><span class="material-symbols-rounded">
                          more_time
                        </span>Prorrogar</button>
                        <a href="src/modules/page_req/devolver_req.php?r=<?php echo $req['idReq']; ?>" onclick="return confirm('Deseja realmente encerrar essa requisição?')"><span class="material-symbols-rounded">
                            restart_alt
                          </span>Devolver</a>
                    </section>
                  </div>
                </div>
              </div>
            <?php
            }
          } else {
            ?>
            <p>Nenhuma requisição correspondente :(</p>
          <?php
          }
          ?>
        </main>
      </div>

    </section>
  </main>


<?php

}

?>