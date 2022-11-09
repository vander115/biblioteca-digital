<?php

require 'src/functions/quant_livro.php';

quant_livro();

if (!isset($_GET['edit_livro']) and !isset($_GET['editar_livro'])) {
?>

    <main class="cont">
        <section class="livros">
            <div class="options">
                <div class="option-item trigger" onclick="acao()">
                    <span class="material-symbols-rounded">
                        bookmark_add
                    </span>
                    <label for="">
                        Adicionar Livro
                    </label>
                </div>
                <a class="option-item trigger" target="_blank" href="pdf/index.php?l">
                    <span class="material-symbols-rounded">
                        receipt_long
                    </span>
                    <label for="">
                        Relatório Livros
                    </label>
                </a>
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
                <form class="form-modal" method="POST" action="src/modules/page_livros/cad_livro.php" id="livro-form">
                    <fieldset>
                        <label for="">Título</label><input name="title" id="title" type="text">
                    </fieldset>
                    <fieldset>
                        <label for="">Autor</label><input name="author" id="author" type="text">
                    </fieldset>
                    <fieldset>
                        <label for="">Gênero</label>
                        <select name="gender" id="gender">
                            <option value="0" selected disabled>Escolha um gênero</option>
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
                            <label for="">Tombo</label><input name="tombo" id="tombo" type="text">
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
                        <label for="">Editora</label><input name="edit" id="edit" type="text">
                    </fieldset>
                    <fieldset>
                        <label for="">Temáticas</label><input maxlenght="255" name="tags" id="tags" type="text">
                    </fieldset>
                    <fieldset><button type="button" onclick="livrosVerify()">Cadrastar Livro</button></fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        const livroForm = document.getElementById('livro-form');

        const titleInput = document.getElementById('title');
        const authorInput = document.getElementById('author');
        const genderInput = document.getElementById('gender');
        const tomboInput = document.getElementById('tombo');
        const numberInput = document.getElementById('number');
        const editInput = document.getElementById('edit');
        const tagsInput = document.getElementById('tags');

        const livrosVerify = () => {
            if (titleInput.value === "") {
                toastr.warning("Informe o titulo do livro!");
                titleInput.focus();
                return;
            }
            if (authorInput.value === "") {
                toastr.warning("Informe o autor do livro!");
                authorInput.focus();
                return;
            }
            if (genderInput.value == 0) {
                toastr.warning("Escolha o gênero do livro!");
                genderInput.focus();
                return;
            }
            if (tomboInput.value === "") {
                toastr.warning("Informe o tombo do livro!");
                tomboInput.focus();
                return;
            }
            if (editInput.value === "") {
                toastr.warning("Informe a editora do livro!");
                editInput.focus();
                return;
            }
            livroForm.submit();
        }
    </script>

<?php } else if (isset($_GET['editar_livro'])) {
    require_once 'src/modules/page_livros/editar_livro.php';
} else {
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