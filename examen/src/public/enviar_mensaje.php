<?php
session_start();
require_once '../php/config/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender_id = $_SESSION['id'];
    $receiver_id = $_POST['receiver_id'];
    $message = trim($_POST['message']);

    if ($receiver_id && !empty($message)) {
        $query = "INSERT INTO messages_usr (msg_sender_id, msg_receiver_id, msg_content) VALUES (:sender_id, :receiver_id, :message)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message
        ]);

        header("Location: chat.php?user_id=" . $receiver_id);
        exit();
    } else {
        echo "Por favor selecciona un usuario y escribe un mensaje.";
    }
}
?>
