<?php 
function devs() {
    if(isset($_GET['p'])) {
        if ($_GET['p'] == 'devs') {
            echo 'purple';
        } else {
            echo ' ';
        }
    }
}