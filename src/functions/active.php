<?php
function active($page) {
    if(isset($_GET['p'])) {
        if ($_GET['p'] == $page) {
            echo 'active';
        } else {
            echo ' ';
        }
    }
}