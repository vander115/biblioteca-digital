<?php 
function toast_success() {
    if (isset($_SESSION['toast_success'])) {
        $message_sucess = $_SESSION['toast_success'];
    } else {
        $message_sucess = " ";
    }
?>
    <script>
        let message_sucess = "<?php echo $message_sucess; ?>";
        if (message_sucess != " ") {
            toastr.success(message_sucess);
        }
    </script>
    
<?php 
    unset($_SESSION['toast_success']);
} 


function toast_error() {
    if (isset($_SESSION['toast_error'])) {
        $message_error = $_SESSION['toast_error'];
    } else {
        $message_error = " ";
    }
?>

    <script>
        let message_error = "<?php echo $message_error; ?>";
        if (message_error != " ") {
            toastr.error(message_error);
        }
    </script>

<?php 
        unset($_SESSION['toast_error']);
    }
?>