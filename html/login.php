<?php
require "php/db_functions.php";
require "php/authenticate.php";

$error = false;
$password = $email = "";

if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {

        $conn = connect_db();

        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $password = md5($password);

        $sql = "SELECT user_id,username,email,password_hash FROM $table_users
            WHERE email = '$email';";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                if ($user["password_hash"] == $password) {

                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["user_name"] = $user["username"];
                    $_SESSION["user_email"] = $user["email"];

                    header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/home.php");
                    exit();
                } else {
                    $error_msg = "Senha incorreta!";
                    $error = true;
                }
            } else {
                $error_msg = "Usuário não encontrado!";
                $error = true;
            }
        } else {
            $error_msg = mysqli_error($conn);
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
    <link rel="stylesheet" href="../assets/login.css">
    <title>Login</title>
</head>

<body>
    <?php if ($login): ?>
        <h3 style="text-align:center">Você já está logado!</h3>
        <h3 style="text-align:center">
        <a href="home.php">Home </a>
        </h3>
    </body>

    </html>
    <?php exit(); ?>
<?php endif; ?>

<?php if ($error): ?>
    <h3 style="color:red; text-align:center;">
        <?php echo $error_msg; ?>
    </h3>
<?php endif; ?>
<img id="nuvem1" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem2" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem3" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem4" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem5" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="star1" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star2" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star3" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star4" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star5" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star6" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star7" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star8" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star9" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star10" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star11" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star12" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="lua" class="decorations" src="../assets/images/estrelas/2.svg">

<div class="container" id="logincontainer">
    <div class="content">
        <h2>LOGIN</h2>
        <form action="login.php" method="post">
            <div class="forminfo">
                <label for="email">Email</label>
                <input type="email" name="email" class="inputbox" id="email" placeholder="Digite seu email"
                    value="<?php echo $email; ?>" required>
            </div>
            <div class="forminfo">
                <label for="password">Senha</label>
                <input type="password" class="inputbox" name="password" id="password" placeholder="Digite sua senha"
                    value="" required>
                <span id="trocar">Ainda não possui uma conta? <a href="cadastro.php">Registre-se</a></span>
            </div>

            <div class="loginbutton">
                <button type="submit" name="submit" id="loginbtn" value="Entrar" class="btn"><img class="imgbtn" src="../assets/images/Entrar.svg"></button>
            </div>
        </form>
    </div>
</div>
</body>

</html>
