<?php
session_start();
require_once '../php/config/dbConfig.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['id'])) {
    echo "Inicia sesión para usar el chat.";
    exit();
}

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

        // header("Location: chat.php?user_id=" . $receiver_id);
        // exit();
    } else {
        echo "Por favor selecciona un usuario y escribe un mensaje.";
    }
}


// ID del usuario logueado
$current_user = $_SESSION['id'];

// Obtén la lista de usuarios excepto el actual
$query = "SELECT usr_id, usr_name FROM users_usr WHERE usr_id != :current_user";
$stmt = $conn->prepare($query);
$stmt->execute(['current_user' => $current_user]);
$users = $stmt->fetchAll();

// Obtén los mensajes si hay un usuario seleccionado
$chat_user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$messages = [];

if ($chat_user_id) {
    $query = "
        SELECT msg_content, msg_sender_id, msg_created_at 
        FROM messages_usr 
        WHERE (msg_sender_id = :current_user AND msg_receiver_id = :chat_user_id)
           OR (msg_sender_id = :chat_user_id AND msg_receiver_id = :current_user)
        ORDER BY msg_created_at ASC
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute(['current_user' => $current_user, 'chat_user_id' => $chat_user_id]);
    $messages = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .chat-container { max-width: 600px; margin: 0 auto; }
        .user-select { margin-bottom: 20px; }
        .chat-box { border: 1px solid #ddd; padding: 10px; }
        .messages { height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
        .message { margin-bottom: 10px; }
        .message.sent { text-align: right; }
        .message.received { text-align: left; }
        textarea { width: 100%; height: 50px; }
        button { width: 100%; }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>Chat</h1>

        <!-- Selección del usuario para chatear -->
        <div class="user-select">
            <form method="GET" action="mensajes.php">
                <label for="user_id">Selecciona un usuario para chatear:</label>
                <select name="user_id" id="user_id" required>
                    <option value="">Seleccionar usuario</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['usr_id']; ?>" <?php echo $chat_user_id == $user['usr_id'] ? 'selected' : ''; ?>>
                            <?php echo $user['usr_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Iniciar Chat</button>
            </form>
        </div>

        <?php if ($chat_user_id): ?>
            <!-- Chat -->
            <div class="chat-box">
                <div class="messages" id="messages">
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $message): ?>
                            <?php $class = ($message['msg_sender_id'] == $current_user) ? 'sent' : 'received'; ?>
                            <div class="message <?php echo $class; ?>">
                                <span><?php echo htmlspecialchars($message['msg_content']); ?></span>
                                <small><?php echo $message['msg_created_at']; ?></small>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay mensajes aún.</p>
                    <?php endif; ?>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="receiver_id" value="<?php echo $chat_user_id; ?>">
                    <textarea name="message" placeholder="Escribe un mensaje..." required></textarea>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <script src="../public/JS/chat.js"></script>
</body>
</html>
