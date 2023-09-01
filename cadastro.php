<?php 
    include('conexao.php');

    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_POST['usuario'], $_POST['email'], $_POST['password'])) {
        $usuario = $mysqli->real_escape_string(trim($_POST['usuario']));
        $email = $mysqli->real_escape_string(trim($_POST['email']));
        $password = $mysqli->real_escape_string(trim(md5($_POST['password'])));
        
        $sql_code = "SELECT COUNT(*) AS total FROM usuarios WHERE email = '$email'";
        $result = $mysqli->query($sql_code);
        $row = $result->fetch_assoc();
        
        if ($row['total'] == 1) {
            $mysqli->close();
            $_SESSION['errorCad'] = true;
            header("Location: index.php");
            exit;
        }

        $sql_code = "INSERT INTO usuarios (id, nome, email, senha, data_cadastro) VALUES (NULL, '$usuario', '$email', '$password', NOW())";
        $mysqli->query($sql_code);

        $mysqli->close();
        $_SESSION['cadreg'] = true;
        header("Location: index.php");
        exit;
    }
?>