<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
<style>
  * {
    margin: auto;
  }

  body {
    width: 100vw;
    height: 100vh;
    background-color: hsl(122, 100%, 97%);
  }

  header {
    padding: 1rem;
    min-width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  img {
    width: 100%;
    height: auto;
  }

  h1 {
    text-align: center;
    font-family: "Poppins";
    font-size: 20px;
  }
</style>

<body>
  <header>
    <h1>Relatorio Biblioteca Digital</h1>
  </header>

  <?php
  require_once "../src/modules/conection.php";

  $livros = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idLivro) 'livros' FROM tb_livros;"));
  $turma = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idTurma) 'turma' FROM tb_turma;"));
  $aluno = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idPessoa) 'aluno' FROM tb_pessoa WHERE tipoPessoa = 'Aluno' AND statusPessoa != 'inativo';"));
  $func = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idPessoa) 'func' FROM tb_pessoa WHERE tipoPessoa != 'Aluno' AND statusPessoa != 'inativo';"));

  $reqC = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idReq) 'req' FROM tb_req WHERE statusReq = 'concluida';"));
  $reqP = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idReq) 'req' FROM tb_req WHERE statusReq = 'pendente';"));
  $reqA = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(idReq) 'req' FROM tb_req WHERE statusReq = 'ativa';"));

  ?>


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
            echo $func['func'] . ' funcionario';
          } else {
            echo $func['func'] . ' funcionarios';
          } ?></p>
    </div>

    <div class="tabela">
      <h2>Quantidade de requisições ativas</h2>
      <p><?php if ($reqA['req'] == 1) {
            echo $reqA['req'] . ' requisição';
          } else {
            echo $reqA['req'] . ' requisições';
          } ?></p>
    </div>

    <div class="tabela">
      <h2>Quantidade de requisições concluidas</h2>
      <p><?php if ($reqC['req'] == 1) {
            echo $reqC['req'] . ' requisição';
          } else {
            echo $reqC['req'] . ' requisições';
          } ?></p>
    </div>

    <div class="tabela">
      <h2>Quantidade de requisições pendentes</h2>
      <p><?php if ($reqP['req'] == 1) {
            echo $reqP['req'] . ' requisição';
          } else {
            echo $reqP['req'] . ' requisições';
          } ?></p>
    </div>

  </main>
</body>