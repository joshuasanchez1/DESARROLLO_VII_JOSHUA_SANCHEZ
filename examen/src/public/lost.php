<?php
require_once "../php/models/User.php";

if (isset($_POST["login_email"])) {
    $user = new User(null, null, $_POST["login_email"], null);
    $info = $user->getUserByEmail();
    if (empty($info)) {
        echo "Correo no encontrado";
    }
    $info = $info[0];
    $nombre = $info["usr_name"];
    $email = $info["usr_email"];
    $pass = $info["usr_password"];
    $randomNumber = rand(1, 5);

    switch ($randomNumber) {
        case 1:
            echo "Oh no, senpai! You forgot your password again? UwU~ Don't worry, I'll help you recover it! >w<";
            echo "<br>";
            echo "Usuario: $email";
            echo "<br>";
            echo "Password: $pass";
            break;
        case 2:
            echo "Ara ara~ Someone’s been a little forgetful. Don’t fret, your password recovery journey begins now, darling~";
            echo "<br>";
            echo "Usuario: $email";
            echo "<br>";
            echo "Password: $pass";
            break;
        case 3:
            echo "Baka! You forgot your password? How could you?! Hmph… fine, I’ll help you, but only this once, okay? >///<";
            echo "<br>";
            echo "Usuario: $email";
            echo "<br>";
            echo "Password: $pass";
            break;
        case 4:
            echo "Nani?! Password lost?! Don’t worry, hero-san, your password recovery quest has been accepted! Fight on! OwO";
            echo "<br>";
            echo "Usuario: $email";
            echo "<br>";
            echo "Password: $pass";
            break;
        case 5:
            echo "Teehee~ Looks like we need to summon the ancient recovery scrolls. Password retrieval magic incoming, nyan~ ✨";
            echo "<br>";
            echo "Usuario: $email";
            echo "<br>";
            echo "Password: $pass";
            break;
        default:
            echo "Uwu~ Something went wrong, senpai. Did you break the internet?! OwO";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST" class="form-login">
        <div class="form-group">
            <label for="login_email">Email</label>
            <input type="text" id="login_email" name="login_email" required />
        </div>
        <br>
        </div>
        <button type="submit" id="login">Login</button>
        </div>
        <br>
    </form>
    <br>
    <a href="./index.php">Regresar Pagina Principal</a>
</body>

</html>