<?php
session_start();
require __DIR__ . "/oauth_settings.php";
if (!isset($_SESSION['usuario']) || !isset($_SESSION['token'])) {
    header("Location: index.php");  // Redirect to login page if not logged in
    exit();
}

$userinfo = $_SESSION['usuario'];
$token = $_SESSION['token'];

echo "<pre>";
print_r($userinfo);
echo "</pre>";
echo "<pre>";
print_r($token);
echo "</pre>";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Google OAuth Dashboard</title>
</head>

<body>
    <h3>Bienvenido! <? htmlspecialchars($userinfo->name) ?></h3>
    <a href="logout.php">Logout</a>
</body>

</html>