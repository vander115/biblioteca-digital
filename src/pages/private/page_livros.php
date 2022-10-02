<?php

if (!isset($_GET['edit_livro'])) {
?>

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
                <div class="option-item <?php if (isset($_GET['mod'])) {
                                            echo 'active';
                                        } else {
                                            echo '';
                                        } ?>" onclick="location.href='<?php if (isset($_GET['mod'])) {
                                                                            echo '?p=livros';
                                                                        } else {
                                                                            echo '?p=livros&mod=simple';
                                                                        } ?>'">
                    <span class="material-symbols-rounded">
                        <span class="material-symbols-rounded">
                            format_list_bulleted
                        </span>
                    </span>
                    <label for="">
                        Listagem Simples
                    </label>
                </div>
            </div>

            <?php
            if (isset($_GET['mod'])) {
                if ($_GET['mod'] == "simple") {
                    require 'src/modules/page_livros/simply_render_livros.php';
                } else {
                    require 'src/modules/page_livros/render_livros.php';
                }
            } else {
                require 'src/modules/page_livros/render_livros.php';
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
                <form class="form-modal" method="POST" action="src/modules/page_livros/cad_livro.php">
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
                                    <option value="<?php echo $select_gender['idGenero'] ?>">
                                        <?php echo $select_gender['nomeGenero'] ?>
                                    </option>
                            <?php }
                            } ?>
                        </select>
                    </fieldset>
                    <fieldset class="oneline-modal">
                        <div>
                            <label for="">Tombo</label><input name="tombo" type="text">
                        </div>
                        <div class="qtd-div">
                            <label for="">Quantidade</label>
                            <div class="qtd-container">
                                <span class="next"></span>
                                <span class="prev"></span>
                                <input id="number" value="1" type="number" maxlength="3" name="qtd" />
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

<?php } else {
    require 'src/modules/page_livros/detalhes_livro.php';
} ?>

<script type="text/javascript">
    const inputQtd = document.getElementById('number');
    const next = document.querySelector('.next');
    const prev = document.querySelector('.prev');

    const nextNum = () => {
        inputQtd.value = Number(inputQtd.value) + 1;
    };

    const prevNum = () => {
        if (inputQtd.value != 0) {
            inputQtd.value = Number(inputQtd.value) - 1;
        }
    };

    next.addEventListener('click', nextNum, false);
    prev.addEventListener('click', prevNum, false);
</script>