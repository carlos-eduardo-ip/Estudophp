<?php

if (!isset($_SESSION)) {
        session_start();
}

if (!isset($_SESSION['email'])) {
        include('./php/verificarLogin.php');
}

if (isset($_POST['nome'], $_POST['telefone'])) {
        include('./php/conexao.php');
        $nome = $mysqli->real_escape_string($_POST['nome']);
        $telefone = $mysqli->real_escape_string($_POST['telefone']);
        $idade = $mysqli->real_escape_string($_POST['idade']);
        $cep = $mysqli->real_escape_string($_POST['cep']);
        $rua = $mysqli->real_escape_string($_POST['rua']);
        $bairro = $mysqli->real_escape_string($_POST['bairro']);
        $cidade = $mysqli->real_escape_string($_POST['cidade']);

        $sql_code = "SELECT COUNT(*) AS total FROM formulario WHERE nome = '$nome'";
        $result = $mysqli->query($sql_code);
        $row = $result->fetch_assoc();

        if ($row['total'] == 1) {
                $mysqli->close();
                $_SESSION['cadastroDuplicado'] = true;
                die(header("Location: painel.php"));
        }

        $sql_code = "INSERT INTO formulario (id, nome, telefone, idade, cep, rua, bairro, cidade, data_cadastro) VALUES (NULL, '$nome', '$telefone', '$idade', '$cep', '$rua', '$bairro', '$cidade', NOW())";
        $mysqli->query($sql_code);

        $mysqli->close();
        if (!isset($_SESSION)) {
                session_start();
        }

        $_SESSION['cadastro'] = true;
        die(header("Location: painel.php"));
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel Gerencial</title>
        <link rel="stylesheet" href="./assets/stylep.css">
        <script src="./js/buscarCEP.js"></script>
        <script src="./js/closebtn.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="PaginaInicial">
        <header>
                <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                        <li class="nav-item active">
                                                <a class="nav-link" href="./painel.php">Página Inicial</a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link" href="./sobrenos.php">Sobre Nós</a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link" href="#">Contato</a>
                                        </li>
                                        <?php
                                        if ($_SESSION['id'] == 1) {
                                                echo '<li class="nav-item">
                                                        <a class="nav-link" href="gerenciador.php">Gerenciador</a>';
                                        }
                                        echo "<li class='nav-item'><p>Seja Bem-Vindo(a) {$_SESSION['nome']}</p></li>";
                                        ?>
                                </ul>
                                <div class="btn-sair">
                                        <a href="./php/logout.php" class="btn btn-danger">Sair</a>
                                </div>
                        </div>
                </nav>

                <?php
                if (isset($_SESSION['cadastroDuplicado'])) {
                        echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Nome já existe no banco de dados, digite outro Nome.</strong>
                <button type="button" class="btn-close"  onclick="closeFunction()" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                        unset($_SESSION['cadastroDuplicado']);
                }
                if (isset($_SESSION['cadastro'])) {
                        echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Usuário cadastrado com sucesso</strong>
                <button type="button" class="btn-close"  onclick="closeFunction()" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                        unset($_SESSION['cadastro']);
                }

                ?>

                <div id="cadastro-form" class="d-flex align-items-center justify-content-center">

                        <form class="row g-3 p-5" action="./painel.php" method="post">
                                <legend class="text-center text-uppercase fs-2 bg-light" style='border-radius: 5px'>Formulário do Cliente</legend>
                                <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="floatingInputGroup1" name="nome" placeholder="Nome Completo" required>
                                        <label for="floatingInputGroup1">Nome Completo</label>
                                </div>
                                <div class="form-floating col-md-3">
                                        <input type="text" class="form-control" id="floatingInputGroup1" name="telefone" placeholder="Telefone" maxlength="11" required>
                                        <label for="floatingInputGroup1">Telefone</label>
                                </div>
                                <div class="form-floating col-md-2">
                                        <input type="text" class="form-control" id="floatingInputGroup1" name="idade" placeholder="Idade" required>
                                        <label for="floatingInputGroup1">Idade</label>
                                </div>
                                <div class="form-floating col-md-2">
                                        <input type="text" class="form-control" id="cep floatingInputGroup1" name="cep" placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" required>
                                        <label for="floatingInputGroup1">CEP</label>
                                </div>
                                <div class="form-floating col-md-3">
                                        <input type="text" class="form-control" id="rua floatingInputGroup1" name="rua" placeholder="Rua">
                                        <label for="floatingInputGroup1">Rua</label>
                                </div>
                                <div class="form-floating col-md-2">
                                        <input type="text" class="form-control" id="bairro floatingInputGroup1" name="bairro" placeholder="Bairro">
                                        <label for="floatingInputGroup1">Bairro</label>
                                </div>
                                <div class="form-floating col-md-3">
                                        <input type="text" class="form-control" id="cidade floatingInputGroup1" name="cidade" placeholder="Cidade">
                                        <label for="floatingInputGroup1">Cidade</label>
                                </div>
                                <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary" type="submit">Enviar</button>
                                        <button class="btn btn-primary" type="reset">Resetar</button>
                                </div>
                        </form>
                </div>

        </header>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>