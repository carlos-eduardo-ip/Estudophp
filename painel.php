<?php 

include ('verificarLogin.php');

if (!isset($_SESSION)) {
        session_start();
}

echo "<body style='background: Lightblue'>
        <h1>Seja Bem Vindo {$_SESSION['nome']}.</h1>
        <p>Essa página está em produção!</p>
        <a href='./logout.php'>Sair</a>
        </body>";
?>

