<?php



function quant_livro()
{
  require 'src/modules/conection.php';
  $query_quant = mysqli_query($conn, "SELECT * FROM tb_livros ORDER BY tituloLivro;");

  while ($livro = mysqli_fetch_assoc($query_quant)) {
    $qtd = $livro['qtdLivro'];
    $id = $livro['idLivro'];
    $status = $livro['statusLivro'];
    if ($qtd == 0 && $status == 'disponivel') {
      mysqli_query($conn, "UPDATE tb_livros SET statusLivro = 'emprestado' WHERE idLivro = '$id';");
    } else if ($qtd > 0 && $status == 'emprestado') {
      mysqli_query($conn, "UPDATE tb_livros SET statusLivro = 'disponivel' WHERE idLivro = '$id';");
    }
  }
}
