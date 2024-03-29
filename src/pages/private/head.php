<?php
if (!isset($_SESSION)) {
    session_start();
}

function change_theme()
{
    if (isset($_SESSION['theme'])) {
        if (isset($_GET['p'])) {
            if ($_GET['p'] == 'devs') {
                echo 'purple';
            } else if ($_SESSION['theme'] == 'default') {
                echo 'default';
            } else if ($_SESSION['theme'] == 'dark') {
                echo 'dark';
            }
        } else if ($_SESSION['theme'] == 'default') {
            echo 'default';
        } else if ($_SESSION['theme'] == 'dark') {
            echo 'dark';
        }
    } else {
        echo 'default';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="<?php change_theme(); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/google_icons.css" />
    <link rel="stylesheet" href="src/styles/toastr/toastr.mim.css">
    <link rel="stylesheet" href="src/styles/toastr.css">
    <link rel="stylesheet" href="src/styles/global.css">
    <script src="src/jquery/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="src/jquery/jquery.mask.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="src/styles/toastr/toastr.min.js"></script>
    <style>
        .material-symbols-rounded {
            font-variation-settings:
                'FILL'1,
                'wght'700,
                'GRAD'0,
                'opsz'48
        }
    </style>
    <link rel="icon" type="image/png" sizes="192x192" href="src/assets/favicon.png">
    <title><?php echo gerarTitulo() ?></title>
</head>

<body>