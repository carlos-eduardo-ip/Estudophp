<?php

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['email'])) {
  include('./php/verificarLogin.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre nós</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/stylep.css">
</head>

<body class="Sobrenos">
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

  <div class="container">
    <h1 class="mt-4 mb-4">Sobre Nós</h1>
    <p class="fw-medium">Somos uma plataforma dedicada a facilitar a gestão de prédios residenciais. Nossa missão é proporcionar uma experiência de moradia tranquila e organizada para todos os moradores.</p>
    <p class="fw-medium">Nossa equipe é composta por profissionais apaixonados por tecnologia e inovação, sempre buscando as melhores soluções para atender às necessidades de nossos usuários. Acreditamos que a comunicação eficaz e a organização são fundamentais para uma convivência harmoniosa em qualquer comunidade residencial.</p>
    <p class="fw-medium">Nosso site permite que os moradores se registrem. Além disso, nosso sistema facilita o acesso a informações essenciais, como contatos de emergência, tornando a vida no prédio mais segura e conveniente.</p>
    <p class="fw-medium">Estamos sempre abertos a feedback e sugestões. Se você tiver alguma dúvida ou precisar de assistência, não hesite em nos contatar.</p>
    <p class="fw-medium">Obrigado por escolher nossa plataforma para sua gestão residencial!</p>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>