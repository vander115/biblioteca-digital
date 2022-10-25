<?php require_once 'src/functions/active.php' ?>
<nav id="sidebar">
    <div class="logo-cont-nav">
        <div class="logo" title="Biblioteca Digital">
            <div class="logo-cont">
                <div class="b">
                    <div class="b1"></div>
                    <div class="b2"></div>
                </div>
                <div class="d"></div>
            </div>
        </div>
    </div>
    <ul class="bar-cont">
        <li class="list <?php active('home') ?>" onclick="location.href='?p=home'">
            <span class="material-symbols-rounded">
                home
            </span>Início
        </li>

        <li class="list <?php active('livros') ?>" onclick="location.href='?p=livros'">
            <span class="material-symbols-rounded">
                menu_book
            </span>Livros
        </li>

        <li class="list <?php active('genders') ?>" onclick="location.href='?p=genders'">
            <span class="material-symbols-rounded">
                auto_awesome
            </span>Gêneros
        </li>

        <li class="list <?php active('requisicoes');
                        if (isset($_SESSION['req']['status'])) {
                            if ($_SESSION['req']['status'] == "pendente") {
                                echo ' req ';
                            }
                        } ?>" onclick="location.href='?p=requisicoes'">
            <div class="not"></div>
            <span class="material-symbols-rounded">
                swap_horiz
            </span>Requisições
        </li>

        <li class="list <?php active('turmas') ?>" onclick="location.href='?p=turmas'">
            <span class="material-symbols-rounded">
                hotel_class
            </span>Turmas
        </li>

        <li class="list <?php active('alunos') ?>" onclick="location.href='?p=alunos'">
            <span class="material-symbols-rounded">
                school
            </span>Alunos
        </li>

        <li class="list">
            <span class="material-symbols-rounded">
                person
            </span>Funcionários
        </li>

        <li class="list">
            <span class="material-symbols-rounded">
                description
            </span>Gerar Relatório
        </li>

        <li class="list">
            <span class="material-symbols-rounded">
                tips_and_updates
            </span>Sobre Nós
        </li>

        <li class="list <?php active('devs') ?>" onclick="location.href='?p=devs'">
            <span class="material-symbols-rounded">
                code
            </span>Developers
        </li>

        <li class="list" onclick="location.href='src/modules/logout.php'">
            <span class="material-symbols-rounded">
                logout
            </span>Sair
        </li>
    </ul>
</nav>