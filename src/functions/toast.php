<?php 
function toast_success() {
    if (isset($_SESSION['toast_success'])) {
        $message = $_SESSION['toast_success'];
    }
?>
    <script>
        let message = "<?php echo $message; ?>";
        if (message !== " ") {
            toastr.success(message);
        }
    </script>
    
<?php 
    unset($_SESSION['toast_success']);
} 
?>