<main class="cont">
    <section class="livros">
        <div class="options">
            <div class="option-item">
                <span class="material-symbols-rounded">
                    auto_stories
                </span>
                <label for="">
                    Emprestar Livro
                </label>
            </div>
            <div class="option-item trigger" onclick="acao()">
                <span class="material-symbols-rounded">
                    bookmark_add
                </span>
                <label for="">
                    Adicionar Livro
                </label>
            </div>
        </div>
        <div class="search">
            <input type="text" placeholder="Pesquisar Livro">
            <button class="icon" title="Pesquisar">
                <span class="material-symbols-rounded">
                    search
                </span>
            </button>
        </div>

        <?php 

            require 'src/modules/conection.php';

            $sql_gender_livro = "SELECT * FROM tb_genero_livro ORDER BY nomeGenero;"; 

            $query_gender_livro = mysqli_query($conn, $sql_gender_livro);

            if ($query_gender_livro) {
                while($gender_info = mysqli_fetch_assoc($query_gender_livro)) {
                    $id_gender = $gender_info['idGenero'];
                    if(isset($_GET['qb'])) {
                        $qb = $_GET['qb'];
                        $sql_livro_info = "SELECT * FROM tb_livros as l JOIN tb_genero_livro as g ON l.generoLivro = g.idGenero WHERE generoLivro = '$id_gender' AND CONCAT(tituloLivro, autorLivro, nomeGenero) LIKE '%$qb%' ORDER BY nomeGenero, tituloLivro;";
                    } else {
                        $sql_livro_info = "SELECT * FROM tb_livros as l JOIN tb_genero_livro as g ON l.generoLivro = g.idGenero WHERE generoLivro = '$id_gender' ORDER BY nomeGenero, tituloLivro;";
                    }

                    $query_livro_info = mysqli_query($conn, $sql_livro_info);
                    if(mysqli_num_rows($query_livro_info)){

            ?>

                        <div class="livro-cont">
                            <header>
                                <h1><?php echo $gender_info['nomeGenero']; ?></h1>
                            </header>
                            <main>
                            <?php
                                while ($livro_data = mysqli_fetch_assoc($query_livro_info)) {
                            ?>
                                <div class="livro-card">
                                    <div class="card-info">
                                        <h1><?php echo $livro_data['tituloLivro']?></h1>
                                        <h2><?php echo $livro_data['autorLivro']?></h2>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
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
                    bookmark_add
                </span>
                Cadrastar Livro
            </h1>
            <button class="close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </button>
        </div>
        <div class="modal-main">
            <form class="form-modal" method="POST" action="src/modules/cad_livro.php">
                <fieldset>
                    <label for="">Título</label><input name="title" type="text">
                </fieldset>
                <fieldset>
                    <label for="">Autor</label><input name="author" type="text">
                </fieldset>
                <fieldset>
                    <label for="">Gênero</label>
                    <select name="gender">
                        <option selected disabled>Escolha um gênero</option>
                        <?php 
                            require 'src/modules/conection.php';

                            $sql_select_gender = "SELECT * FROM tb_genero_livro ORDER BY nomeGenero";

                            $query_select_gender = mysqli_query($conn, $sql_select_gender);

                            if ($query_select_gender) {
                                while ($select_gender = mysqli_fetch_assoc($query_select_gender)) {
                        ?> 
                        <option value="<?php echo $select_gender['idGenero']?>">
                        <?php echo $select_gender['nomeGenero']?>
                        </option>
                        <?php }} ?>
                    </select>
                </fieldset>
                <fieldset class="oneline-livro">
                    <div>
                        <label for="">Tombo</label><input name="tombo" type="text">
                    </div>
                    <div class="qtd-div">
                        <label for="">Quantidade</label>
                        <div class="qtd-container">
                            <span class="next"></span>
                            <span class="prev"></span>
                            <input id="number" value="1" type="number" maxlength="3" name="qtd"/>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <label for="">Editora</label><input name="edit" type="text">
                </fieldset>
                <fieldset>
                    <label for="">Temáticas</label><input maxlenght="255" name="tags" type="text">
                </fieldset>
                <fieldset><button>Cadrastar Livro</button></fieldset>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    const inputQtd = document.getElementById('number');
    const next = document.querySelector('.next');
    const prev = document.querySelector('.prev');

    const nextNum = () => {
        inputQtd.value = Number(inputQtd.value) + 1;
      };

      const prevNum = () => {
        if (inputQtd.value != 1) {
          inputQtd.value = Number(inputQtd.value) - 1;
        }
      };

      next.addEventListener('click', nextNum, false);
      prev.addEventListener('click', prevNum, false);

</script>