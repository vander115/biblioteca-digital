<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
<style>
  * {
    margin: 0;
    --corLaranja: rgb(232, 114, 59);
    --corLaranja100: rgb(254, 157, 102);
    --corLaranja200: rgb(241, 73, 22);

    --corVerde: rgb(46, 150, 51);
    --corVerde100: rgb(114, 254, 119);
    --corVerde200: rgb(11, 107, 14);

    --corTextoLaranja200: rgb(0, 0, 0);

    --sombraLaranja: rgb(232, 114, 59, 0.4);
    --sombraVerde: rgb(46, 150, 51, 0.2);

    --fundoVerde: hsl(122, 100%, 97%);
    --fundoLaranja: hsl(22, 100%, 97%);
    --fundoFosco: rgba(255, 255, 255, 0.85);
    --fundoFoscoVerde: rgba(240, 255, 240, 0.85);

    --gadrientLaranja: 225deg, rgb(254, 157, 102), rgb(232, 113, 58),
      rgb(241, 73, 22);
    --gadrientVerde: 45deg, rgb(114, 254, 119), rgb(46, 150, 51), rgb(11, 107, 14);

    --fontFamily: 'Poppins', Arial, Helvetica, sans-serif;
  }

  body {
    width: 100vw;
    height: 100vh;
    background-color: white;
    font-family: 'Poppins' !important;
    padding: 2rem;
    position: relative;
  }

  header {
    padding: 1rem;
    min-width: 100%;
    text-align: center;
  }

  header h1 {
    color: rgb(11, 107, 14);
  }

  header h1 span {
    color: rgb(232, 114, 59);
  }

  main .tabela {
    width: 100%;
    text-align: left;
  }

  main .tabela h2 {
    font-size: 1.2rem;
    color: black;
    font-weight: normal;
  }

  main .tabela p {
    font-size: 1.5rem;
    font-weight: bold; 
    color: black;
  }

  footer {
    width: 100%;
    text-align: center;
    position: absolute;
    bottom: 1rem;
  }
</style>

<body>
  <?php
  require_once "../src/modules/conection.php";

  $livros = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idLivro) 'livros' FROM tb_livros;"));
  $turma = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idTurma) 'turma' FROM tb_turma;"));
  $aluno = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idPessoa) 'aluno' FROM tb_pessoa WHERE tipoPessoa = 'Aluno' AND statusPessoa != 'inativo';"));
  $func = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idPessoa) 'func' FROM tb_pessoa WHERE tipoPessoa != 'Aluno' AND statusPessoa != 'inativo';"));

  $reqC = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idReq) 'req' FROM tb_req WHERE statusReq = 'concluida';"));
  $reqP = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idReq) 'req' FROM tb_req WHERE statusReq = 'pendente';"));
  $reqA = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idReq) 'req' FROM tb_req WHERE statusReq = 'ativa';"));


  $dataAtual = date("d/m/Y");
  ?>

  <header>
    <h1>Relatorio Biblioteca <span class="orange">Digital</span></h1>
    <h2>Gerado em <?php echo $dataAtual; ?></h2>
  </header>

  <main>
    <div class="tabela">
      <h2>Quantidade de livros</h2>
      <p><?php if ($livros['livros'] == 1) {
            echo $livros['livros'] . ' livro';
          } else {
            echo $livros['livros'] . ' livros';
          } ?></p>

    </div>

    <div class="tabela">
      <h2>Quantidade de turmas</h2>
      <p><?php if ($turma['turma'] == 1) {
            echo $turma['turma'] . ' turma';
          } else {
            echo $turma['turma'] . ' turmas';
          } ?></p>

    </div>

    <div class="tabela">
      <h2>Quantidade de alunos</h2>
      <p><?php if ($aluno['aluno'] == 1) {
            echo $aluno['aluno'] . ' aluno';
          } else {
            echo $aluno['aluno'] . ' alunos';
          } ?></p>

    </div>

    <div class="tabela">
      <h2>Quantidade de funcionarios</h2>
      <p><?php if ($func['func'] == 1) {
            echo $func['func'] . ' funcionário';
          } else {
            echo $func['func'] . ' funcionários';
          } ?></p>
    </div>

    <div class="tabela">
      <h2>Quantidade de requisições ativas</h2>
      <p><?php if ($reqA['req'] == 1) {
            echo $reqA['req'] . ' requisição ativa';
          } else {
            echo $reqA['req'] . ' requisições ativa';
          } ?></p>
    </div>

    <div class="tabela">
      <h2>Quantidade de requisições concluidas</h2>
      <p><?php if ($reqC['req'] == 1) {
            echo $reqC['req'] . ' requisição concluída';
          } else {
            echo $reqC['req'] . ' requisições concluídas';
          } ?></p>
    </div>

    <div class="tabela">
      <h2>Quantidade de requisições pendentes</h2>
      <p><?php if ($reqP['req'] == 1) {
            echo $reqP['req'] . ' requisição pendente';
          } else {
            echo $reqP['req'] . ' requisições pendentes';
          } ?></p>
    </div>

  </main>
  <footer>
    <p>EEEP Francisca Neilyta Carneiro Albuquerque</p>
  </footer>
</body>