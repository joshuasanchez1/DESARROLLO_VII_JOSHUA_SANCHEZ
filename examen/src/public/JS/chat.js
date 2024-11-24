document.addEventListener("DOMContentLoaded", function () {
    const messagesDiv = document.getElementById("messages");
    const chatForm = document.getElementById("chat-form");

    // Cargar mensajes
    function fetchMessages() {
        const receiverId = document.getElementById("receiver_id").value;
        fetch(`fetch_messages.php?user_id=${receiverId}`)
            .then(response => response.text())
            .then(data => {
                messagesDiv.innerHTML = data;
                messagesDiv.scrollTop = messagesDiv.scrollHeight; // Scroll automático
            });
    }

    // Enviar mensaje
    chatForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const senderId = document.getElementById("sender_id").value;
        const receiverId = document.getElementById("receiver_id").value;
        const message = document.getElementById("message").value;

        fetch("send_message.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `sender_id=${senderId}&receiver_id=${receiverId}&message=${message}`,
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById("message").value = "";
                fetchMessages(); // Actualizar mensajes después de enviar
            });
    });

    // Actualizar mensajes cada 2 segundos
    setInterval(fetchMessages, 2000);

    // Cargar mensajes al iniciar
    fetchMessages();
});
