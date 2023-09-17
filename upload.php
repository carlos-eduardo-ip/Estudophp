<?php

if (!isset($_SESSION)) {
        session_start();
}

if (!isset($_SESSION['email'])) {
        include('./php/verificarLogin.php');
}



if (!empty($_GET['id'])) {
        include('./php/conexao.php');
        $id = $_GET['id'];

        $sql_code = "SELECT * FROM formulario WHERE id=$id";
        $result = $mysqli->query($sql_code);
        if ($result->num_rows > 0) {
                while ($users_date = mysqli_fetch_assoc($result)) {
                        $nome = $mysqli->real_escape_string($users_date['nome']);
                        $telefone = $mysqli->real_escape_string($users_date['telefone']);
                        $idade = $mysqli->real_escape_string($users_date['idade']);
                        $cep = $mysqli->real_escape_string($users_date['cep']);
                        $rua = $mysqli->real_escape_string($users_date['rua']);
                        $bairro = $mysqli->real_escape_string($users_date['bairro']);
                        $cidade = $mysqli->real_escape_string($users_date['cidade']);
                }
        }
        else {
                die(header('Location: gerenciador.php'));
        }
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

                        <form class="row g-3 p-5" action="./php/deledit.php" method="post">
                                <legend class="text-center text-uppercase fs-2 bg-light" style='border-radius: 5px'>Formulário do Cliente</legend>
                                <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="floatingInputGroup1" name="nome" placeholder="Nome Completo" value="<?php echo $nome ?>" required>
                                        <label for="floatingInputGroup1">Nome Completo</label>
                                </div>
                                <div class="form-floating col-md-3">
                                        <input type="text" class="form-control" id="floatingInputGroup1" name="telefone" placeholder="Telefone" maxlength="11" value="<?php echo $telefone ?>" required>
                                        <label for="floatingInputGroup1">Telefone</label>
                                </div>
                                <div class="form-floating col-md-2">
                                        <input type="text" class="form-control" id="floatingInputGroup1" name="idade" placeholder="Idade" value="<?php echo $idade ?>" required>
                                        <label for="floatingInputGroup1">Idade</label>
                                </div>
                                <div class="form-floating col-md-2">
                                        <input type="text" class="form-control" id="cep floatingInputGroup1" name="cep" placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);" value="<?php echo $cep ?>" required>
                                        <label for="floatingInputGroup1">CEP</label>
                                </div>
                                <div class="form-floating col-md-3">
                                        <input type="text" class="form-control" id="rua floatingInputGroup1" name="rua" placeholder="Rua" value="<?php echo $rua ?>">
                                        <label for="floatingInputGroup1">Rua</label>
                                </div>
                                <div class="form-floating col-md-2">
                                        <input type="text" class="form-control" id="bairro floatingInputGroup1" name="bairro" placeholder="Bairro" value="<?php echo $bairro ?>">
                                        <label for="floatingInputGroup1">Bairro</label>
                                </div>
                                <div class="form-floating col-md-3">
                                        <input type="text" class="form-control" id="cidade floatingInputGroup1" name="cidade" placeholder="Cidade" value="<?php echo $cidade ?>">
                                        <label for="floatingInputGroup1">Cidade</label>
                                </div>
                                <div class="d-grid gap-2 d-md-block">
                                        <input type="hidden" name="idx" value="<?php echo $id?>">
                                        <button class="btn btn-primary" type="submit" name="update">Salvar</button>
                                        <a class="btn btn-primary" href="#" role="button">Cancelar</a>
                                </div>
                        </form>
                </div>

        </header>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>