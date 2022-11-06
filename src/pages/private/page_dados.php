<main class="cont">
  <section class="dados">
    <div class="options">
      <div class="option-item trigger" onclick="location.href='pdf'">
        <span class="material-symbols-rounded">
          receipt_long
        </span>
        <label for="">
          Relatório Geral
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