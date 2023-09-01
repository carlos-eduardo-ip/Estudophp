<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2ª Experiência de Aprendizagem</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-box">
        <form action="" method="post">
            <h2>Faça o Login</h2>
            <div class="input-box">
                <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
                <input type="email" name = "email"required>
                <label>E-mail</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="eye" id="olho"></ion-icon></ion-icon></span>
                <input type="password" id="password" name="password" required>
                <label>Senha</label>
            </div>
            <div class="button login">
                <button type="submit" name="login">Entrar</button>
            </div>
        </form>
        <div class="separador"></div>
        <form action="cadastro.php" method="post">
            <h2>Inscreva-se</h2>
            <div class="input-box">
                <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
                <input type="text" name = "usuario"required>
                <label>Nome</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
                <input type="email" name = "email"required>
                <label>E-mail</label>
            </div>
            <div class="input-box">
                <span class="icon" id="olho1"><ion-icon name="eye"></ion-icon></span>
                <input type="password" id="password1" name="password" required>
                <label>Senha</label>
            </div>
            <div class="button cadastro">
                <button type="submit" name="cadastro">Cadastre-se</button>
            </div>
        </form>
    </div>

    <script src="./js/Function.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>


<?php 
    include('conexao.php');

    if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = $mysqli->real_escape_string(md5($_POST['password']));

            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$password'";
            $sql_query = $mysqli->query($sql_code) or die('Falha na execução do código SQL: ' . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1) {
                $usuario = $sql_query->fetch_assoc();
                
                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: painel.php");

            } else {
                echo "
                <div id='alert'>
                <span class='closebtn' onclick='closeFunction();'>&times;</span> 
                <strong>Falha ao logar! E-mail ou senha incorretos.</strong>
                </div>";
            }
        }
    
    if (isset($_SESSION['sem_usuario'])) {
        echo "<div id='alert'>
        <span class='closebtn' onclick='closeFunction();'>&times;</span> 
        <strong>É necessário logar para acessar o sistema!</strong>
        </div>";
        session_destroy();
    } elseif (isset($_SESSION['errorCad'])) {
        echo "
        <div id='alert'>
        <span class='closebtn' onclick='closeFunction();'>&times;</span> 
        <strong>E-mail já cadastrado!</strong>
        </div>";
        session_destroy();
    }elseif (isset($_SESSION['cadreg'])) {
        echo "
        <div id='alert' style= 'background:green'>
        <span class='closebtn' onclick='closeFunction();'>&times;</span> 
        <strong>Cadastro realizado com sucesso.</strong>
        </div>";
        session_destroy();
    }

?>
