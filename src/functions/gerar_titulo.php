<?php
function gerarTitulo()
{
  (isset($_GET['p'])) ? $titulo_pagina = $_GET['p'] : $titulo_pagina = 'home';
  switch ($titulo_pagina) {
    case 'home':
      $titulo = "BD - Início";
      break;

    case 'livros':
      $titulo = "BD - Livros";
      break;

    case 'genders':
      $titulo = 'BD - Gêneros';
      break;

    case 'devs':
      $titulo = 'BD - Desenvolvedores';
      break;

    case 'turmas':
      $titulo = 'BD - Turmas';
      break;

    case 'alunos':
      $titulo = 'BD - Alunos';
      break;

    case 'funcionarios';
      $titulo = 'BD - Funcionários';
      break;

    case 'requisicoes':
      $titulo = 'BD - Requisições';
      break;

    case 'dados':
      $titulo = 'BD - Dados';
      break;

    default:
      $titulo = "Biblioteca Digital";
      break;
  }
  return $titulo;
}
