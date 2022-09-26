<main class="cont">
  <section class="genders">
  <div class="options">
            <div class="option-item trigger" onclick="acao()">
                <span class="material-symbols-rounded">
                    magic_button
                </span>
                <label for="">
                    Adicionar Gênero
                </label>
            </div>
        </div>
            <form class="search" method="GET" action="">
                <input type="hidden" name="p" value="genders">
                <input type="text" name="q" placeholder="Pesquisar Gênero" value="<?php if (isset($_GET['q'])) echo $_GET['q']; ?>">
                <button class="icon" title="Pesquisar">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                </button>
            </form>
    </div>

    <article>
        <?php

            require 'src/modules/conection.php';

            if (isset($_GET['q'])) {
                $busca = mb_strtoupper($_GET['q']);
                $sql_busca = "SELECT * FROM tb_genero_livro WHERE nomeGenero LIKE '%$busca%' ORDER BY nomeGenero;";
            } else { 
                $sql_busca = "SELECT * FROM tb_genero_livro ORDER BY nomeGenero;";
            }

            $query_busca = mysqli_query($conn, $sql_busca);

            if ($query_busca) {

                while ($gender = mysqli_fetch_assoc($query_busca)) {

            ?>
        <div class="gender-fullcont">
            <a class="gender-cont" href="?p=livros&qb=<?php echo $gender['nomeGenero']; ?>">
                    <h1><?php echo $gender['nomeGenero']; ?></h1>
            </a>
            <a onclick="confirm('Deseja excluir essa seção? Todos os livros contidos nela serão apagados!')" href="src/modules/del_gender.php?id_del=<?php echo $gender['idGenero']; ?>" class="del-gender">
                <span class="material-symbols-rounded">
                delete_forever
                </span>
            </a>
        </div>
        <?php 
            }}
            if (isset($_GET['q'])) {
                if (!mysqli_num_rows($query_busca)) {
                    echo '<p id="legenda"> Nenhum gênero encontrado :(</p>';
                }
            }
        
        ?>
    </article>
  </section>
</main>

<div class="modal">
    <div class="modal-cont">
        <div class="modal-header">
            <h1>
                <span class="material-symbols-rounded">
                    magic_button
                </span>
                Cadrastar Gênero
            </h1>
            <button class="close">
                <span class="material-symbols-rounded">
                    close
                </span>
            </button>
        </div>
        <div class="modal-main">
            <form class="form-modal" method="POST" action="src/modules/cad_gender.php">
                <fieldset>
                    <label for="">Título</label><input name="title" type="text">
                </fieldset>
                <fieldset><button>Cadrastar Gênero</button></fieldset>
            </form>
        </div>
    </div>
</div>