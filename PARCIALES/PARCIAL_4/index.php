<?php
session_start();
require __DIR__ . "/oauth_settings.php";
$client->addScope("email");
$client->addScope("profile");
$url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Google login
    </title>
</head>

<body>
    <a href="<?= $url ?>">Login con google</a>
</body>

</html>