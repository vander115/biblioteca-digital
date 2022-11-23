<?php

if (!isset($_GET['editGender'])) {

?>

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
                            <a class="gender-cont" href="?p=livros&qb=<?php echo urlencode($gender['nomeGenero']); ?>">
                                <h1><?php echo $gender['nomeGenero']; ?></h1>
                            </a>
                            <a href="?p=genders&editGender=<?php echo $gender['idGenero']; ?>" class="del-gender">
                                <span class="material-symbols-rounded">
                                    edit
                                </span>
                            </a>
                        </div>
                <?php
                    }
                }
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
                <form class="form-modal" method="POST" id="genderForm" action="src/modules/page_genders/cad_gender.php">
                    <fieldset>
                        <label for="">Título</label><input name="title" id="titleGender" type="text">
                    </fieldset>
                    <fieldset><a type="button" onclick="genderVerify()">Cadrastar Gênero</a></fieldset>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const genderForm = document.getElementById('genderForm');
        const titleGenderInput = document.getElementById('titleGender');

        const genderVerify = () => {
            if (titleGenderInput.value === "") {
                toastr.warning("Digite o titulo do gênero!");
                titleGenderInput.focus();
                return;
            }
            genderForm.submit();
        }
    </script>

<?php } else {
    require 'src/modules/conection.php';
    $idGender = $_GET['editGender'];
    $sql_edit_gender = "SELECT * FROM tb_genero_livro WHERE idGenero = '$idGender';";
    $query_edit_gender = mysqli_query($conn, $sql_edit_gender);
    $editGender = mysqli_fetch_assoc($query_edit_gender);
?>


    <div class="modal open">
        <div class="modal-cont">
            <div class="modal-header">
                <h1>
                    <span class="material-symbols-rounded">
                        magic_button
                    </span>
                    Editar Gênero
                </h1>
                <button title="Cancelar" onclick="location.href='?p=genders'" class="close">
                    <span class="material-symbols-rounded">
                        arrow_back_ios
                    </span>
                </button>
            </div>
            <div class="modal-main">
                <form class="form-modal" name="genderForm" id="genderForm" method="POST" action="src/modules/page_genders/edit_gender.php">
                    <fieldset>
                        <input type="hidden" name="id" value="<?php echo $editGender['idGenero']; ?>">
                        <label for="">Título</label><input name="title" id="titleGender" type="text" value="<?php echo $editGender['nomeGenero']; ?>">
                    </fieldset>
                    <fieldset class="oneline-modal">
                        <a type="button" href="src/modules/page_genders/del_gender.php?id_del=<?php echo $editGender['idGenero']; ?>" onclick="return confirm('Deseja realmente excluir essa seção? TODOS os livros contidos nela serão EXCLUIDOS!!!')" class="del"><span class="material-symbols-rounded">
                                delete_forever
                            </span>Excluir Gênero</a>
                        <a onclick="genderVerify()"><span class="material-symbols-rounded">
                                edit
                            </span>Editar Gênero</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const genderForm = document.getElementById('genderForm');
        const titleGenderInput = document.getElementById('titleGender');

        const genderVerify = () => {
            if (titleGenderInput.value === "") {
                toastr.warning("Digite o titulo do gênero!");
                titleGenderInput.focus();
                return;
            }
            genderForm.submit();
        }
    </script>
<?php } ?>