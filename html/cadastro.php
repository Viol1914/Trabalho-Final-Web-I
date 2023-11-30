<?php
require "php/db_functions.php";

$error = false;
$success = false;
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {

    $conn = connect_db();

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    if ($password == $confirm_password) {
      $password = md5($password);

      $sql = "INSERT INTO $table_users (username, email, password_hash) VALUES ('$name', '$email', '$password');";

      if (mysqli_query($conn, $sql)) {
        $success = true;

        $user_id = mysqli_insert_id($conn);

        if ($user_id > 0) {
          $sqlLigaGeral = "SELECT league_id FROM leagues WHERE league_name = 'Geral'";
          $resultLigaGeral = mysqli_query($conn, $sqlLigaGeral);

          if ($resultLigaGeral && mysqli_num_rows($resultLigaGeral) > 0) {
            $row = mysqli_fetch_assoc($resultLigaGeral);
            $liga_id_geral = $row['league_id'];

            $sqlInsertUserLeague = "INSERT INTO user_league (user_id, league_id) VALUES ($user_id, $liga_id_geral)";
            mysqli_query($conn, $sqlInsertUserLeague);
          } else {
            $error_msg = "Erro ao encontrar a liga 'Geral'.";
            $error = true;
          }
        } else {
          $error_msg = "Erro ao obter o ID do usuário recém-criado.";
          $error = true;
        }

      } else {
        $error_msg = mysqli_error($conn);
        $error = true;
      }
    } else {
      $error_msg = "Senha não confere com a confirmação.";
      $error = true;
    }
  } else {
    $error_msg = "Por favor, preencha todos os dados.";
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/cadastro.css">
  <title>Cadastro</title>
</head>

<body>

  <?php if ($success): ?>
    <h3 style="color:lightgreen;">Usuário criado com sucesso!</h3>
    <p>
      Seguir para <a href="login.php">login</a>.
    </p>
  <?php endif; ?>

  <?php if ($error): ?>
    <h3 style="color:red;">
      <?php echo $error_msg; ?>
    </h3>
  <?php endif; ?>

  <div class="container" id="cadastrocontainer">
    <div class="content">
      <h2>Cadastro</h2>
      <form action="cadastro.php" method="post">
        <div class="forminfo">
          <label for="email">Email</label>
          <input type="email" name="email" class="inputbox" id="email" placeholder="Digite seu email" value="<?php echo$email; ?>" required>
        </div>
        <div class="forminfo">
          <label for="text">nome de usuário:</label>
          <input type="text" class="inputbox" id="nomedeusuario" name="name"placeholder="Digite seu nome de usuário" value="<?php echo $name; ?>" required>
        </div>
        <div class="forminfo">
          <label for="password">Senha:</label>
          <input type="password" name="password" class="inputbox" id="password" placeholder="Digite uma senha" value="" required>
        </div>
        <div class="forminfo">
          <label for="password">Confirmar senha:</label>
          <input type="password" name="confirm_password" class="inputbox" id="password" placeholder="Confirme sua senha" value="" required>
          <span id="trocar">Já não possui uma conta? <a href="login.php">Faça login</a></span>
        </div>
        <div class="loginbutton">
          <button type="submit" name="submit" id="loginbtn" class="btn" value="Criar usuário">Entrar</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
