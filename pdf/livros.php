<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      --corLaranja: rgb(232, 114, 59);
      --corLaranja100: rgb(254, 157, 102);
      --corLaranja200: rgb(241, 73, 22);

      --corVerde: rgb(46, 150, 51);
      --corVerde100: rgb(114, 254, 119);
      --corVerde200: rgb(11, 107, 14);

      --corTextoLaranja200: rgb(0, 0, 0);

      --sombraLaranja: rgb(232, 114, 59, 0.4);
      --sombraVerde: rgb(46, 150, 51, 0.2);

      --fundoVerde: hsl(122, 100%, 97%);
      --fundoLaranja: hsl(22, 100%, 97%);
      --fundoFosco: rgba(255, 255, 255, 0.85);
      --fundoFoscoVerde: rgba(240, 255, 240, 0.85);

      --gadrientLaranja: 225deg, rgb(254, 157, 102), rgb(232, 113, 58),
        rgb(241, 73, 22);
      --gadrientVerde: 45deg, rgb(114, 254, 119), rgb(46, 150, 51), rgb(11, 107, 14);

      --fontFamily: 'Poppins', Arial, Helvetica, sans-serif;
    }

    body {
      width: 100vw;
      height: 100vh;
      background-color: rgb(240, 255, 240);
    }

    header {
      min-width: 100%;
      width: 100%;
      max-width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    main {
      margin-top: 3rem;
      min-width: 100%;
      position: relative;
    }

    main table {
      position: absolute;
      width: 90%;
      left: 50%;
      transform: translateX(-50%);
      border-collapse: collapse;
      border: 1px solid black;
      font-family: 'Poppins' !important;
    }

    main table th {
      border: 1px solid black;
      margin: 0;
      font-size: 0.9rem;
      padding: 0;
      background-color: rgb(11, 107, 14);
      color: white;
    }

    h1 {
      text-align: center;
      font-family: "Poppins", sans-serif;
      font-size: 2rem;
      color: rgb(11, 107, 14);
      margin-top: 7rem;
    }

    h2 {
      color: rgb(11, 107, 14);
      text-align: center;
      font-family: "Poppins", sans-serif;
      font-size: 1.5rem;
    }

    img {
      position: absolute;
      height: 5rem;
      top: 2rem;
      left: 50%;
      transform: translateX(-50%);
    }
  </style>

  <title>Document</title>
</head>

<body>
  <header>
    <h1>Relatório Biblioteca Digital</h1>
    <img src="http://localhost/biblioteca-digital/pdf/assets/logo.png" alt="">
    <h2>Livros cadrastados no sistema</h2>
  </header>
  <main>
    <table>
      <tr>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Gênero</th>
        <th>Tombo</th>
        <th>Editora</th>
      </tr>
    </table>
  </main>
</body>

</html>