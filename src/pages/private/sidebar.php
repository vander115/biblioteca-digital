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
        <li class="list <?php active('home') ?>" onclick="location.href='?p=home'"><span class="material-symbols-rounded">
                home
            </span>Início</li>

        <li class="list <?php active('livros') ?>" onclick="location.href='?p=livros'"><span class="material-symbols-rounded">
                menu_book
            </span>Livros</li>

        <li class="list"><span class="material-symbols-rounded">
                error
            </span>Pendentes</li>

        <li class="list"><span class="material-symbols-rounded">
                hotel_class
            </span>Turmas</li>

        <li class="list"><span class="material-symbols-rounded">
                school
            </span>Alunos</li>

        <li class="list"><span class="material-symbols-rounded">
                person
            </span>Funcionários</li>
        <li class="list <?php active('devs') ?>" onclick="location.href='?p=devs'"><span class="material-symbols-rounded">
                code
            </span>Developers</li>
    </ul>
</nav>