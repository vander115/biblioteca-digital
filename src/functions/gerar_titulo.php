<?php 
  function gerarTitulo() {
    (isset($_GET['p'])) ? $titulo_pagina = $_GET['p'] : $titulo_pagina = 'home';
    switch ($titulo_pagina) {
      case 'home':
        $titulo = "Início";
        break;

      case 'livros':
        $titulo = "Livros";
        break;

      case 'genders':
        $titulo = 'Gêneros';
        break;
      
      case 'devs':
        $titulo = 'Desenvolvedores';
        break;

      default:
        $titulo = "Início";
        break;
    } 
    return $titulo;
  }
?>