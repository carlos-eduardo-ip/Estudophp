<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['id'])) {
        $_SESSION['sem_usuario'] = true;
        die(header("Location: index.php"));
    }
?>

