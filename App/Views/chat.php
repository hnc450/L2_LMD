<?php

if (!isset($_SESSION['user'][0]['id_user'])) {
    header('Location: /connexion');
    exit();
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Le Monde Dans Ma Poche</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .chat-container {
            display: flex;
            height: 95vh;
            margin: 0;
            max-width: 1200px;
            width: 100vw;
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .chat-sidebar {
            width: 300px;
            background: var(--bg-color);
            border-right: 1px solid var(--border-color);
            padding: var(--spacing-md);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding-bottom: var(--spacing-md);
            border-bottom: 1px solid var(--border-color);
            margin-bottom: var(--spacing-md);
        }

        .sidebar-header h3 {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: var(--spacing-sm);
        }

        .online-users {
            flex: 1;
            overflow-y: auto;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: var(--spacing-sm);
            border-radius: var(--border-radius-md);
            margin-bottom: var(--spacing-sm);
            cursor: pointer;
            transition: background-color var(--transition-fast);
        }

        .user-item:hover {
            background-color: rgba(138, 43, 226, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: var(--spacing-sm);
            border: 2px solid var(--primary-color);
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .user-status {
            font-size: 0.8rem;
            color: var(--primary-color);
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--card-bg);
            min-height: 600px;
        }

        .chat-header {
            padding: var(--spacing-md);
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header h2 {
            font-size: 1.2rem;
            margin: 0;
        }

        .chat-messages {
            flex: 1;
            padding: var(--spacing-md);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
        }

        .message {
            max-width: 70%;
            padding: var(--spacing-md);
            border-radius: var(--border-radius-lg);
            position: relative;
        }

        .message.sent {
            align-self: flex-end;
            background: var(--primary-color);
            color: white;
            border-bottom-right-radius: 0;
        }

        .message.received {
            align-self: flex-start;
            background: var(--bg-color);
            color: var(--text-color);
            border-bottom-left-radius: 0;
        }

        .message-header {
            display: flex;
            align-items: center;
            margin-bottom: var(--spacing-xs);
        }

        .message-sender {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .message-time {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-left: var(--spacing-sm);
        }

        .message-content {
            font-size: 1rem;
            line-height: 1.4;
        }

        .chat-input {
            padding: var(--spacing-md);
            background: var(--bg-color);
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: var(--spacing-md);
        }

        .message-input {
            flex: 1;
            padding: var(--spacing-md);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-md);
            background: var(--card-bg);
            color: var(--text-color);
            font-size: 1rem;
            resize: none;
            min-height: 50px;
            max-height: 150px;
        }

        .send-button {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius-md);
            padding: 0 var(--spacing-lg);
            cursor: pointer;
            transition: background-color var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .send-button:hover {
            background: var(--primary-dark);
        }

        .send-button i {
            font-size: 1.2rem;
        }

        @media (max-width: 900px) {
            .chat-container {
                flex-direction: column;
                height: 90vh;
                max-width: 100vw;
            }
            .chat-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        
        <?php
           require __DIR__ . '/sidebar.php';
        ?>

        <header class="main-header">
            <div class="header-left">
                <img src="/img/logo.png" alt="Logo" class="logo">
                <h1>Le Monde Dans Ma Poche</h1>
            </div>
            <div class="header-right">
                <div class="theme-toggle">
                    <input type="checkbox" id="themeSwitch" class="theme-switch">
                    <label for="themeSwitch" class="theme-switch-label">
                        <i class="fas fa-sun"></i>
                        <i class="fas fa-moon"></i>
                        <span class="switch-ball"></span>
                    </label>
                </div>
                <div class="user-info-header">
                    <img src="/img/avatar.png" alt="Avatar" class="avatar">
                    <div>
                        <p class="username"><?= $_SESSION['user'][0]['prenoms']; ?></p>
                        <p class="rank"><?=  $_SESSION['user'][0]['role']; ?></p>
                    </div>
                </div>
            </div>
        </header>

        <div class="chat-container">
            <div class="chat-sidebar">
                <div class="sidebar-header">
                    <h3>Utilisateurs en ligne</h3>
                </div>
                <div class="online-users">
                    <!-- Les utilisateurs en ligne seront chargés dynamiquement -->
                </div>
            </div>
            <div class="chat-main">
                <div class="chat-header">
                    <h2>Chat Général</h2>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <!-- Les messages seront chargés dynamiquement -->
                </div>
                <form class="chat-input" id="messageForm">
                    <textarea class="message-input" placeholder="Écrivez votre message..." required></textarea>
                    <button type="submit" class="send-button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="/js/script.js" defer></script>
    <script>
        function loadMessages() {
            fetch('/chat/messages')
                .then(response => response.json())
                .then(messages => {
                    const chatMessages = document.getElementById('chatMessages');
                    chatMessages.innerHTML = '';
                    const myId = <?php echo $_SESSION['user'][0]['id_user']; ?>;
                    messages.forEach(message => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = `message ${message.sender_id === myId ? 'sent' : 'received'}`;
                        
                        const messageHeader = document.createElement('div');
                        messageHeader.className = 'message-header';
                        
                        const sender = document.createElement('span');
                        sender.className = 'message-sender';
                        sender.textContent = (message.sender_id === myId) ? 'Moi' : message.prenoms;
                        
                        const time = document.createElement('span');
                        time.className = 'message-time';
                        time.textContent = new Date(message.created_at).toLocaleTimeString();
                        
                        const content = document.createElement('div');
                        content.className = 'message-content';
                        content.textContent = message.content;
                        
                        messageHeader.appendChild(sender);
                        messageHeader.appendChild(time);
                        messageDiv.appendChild(messageHeader);
                        messageDiv.appendChild(content);
                        
                        chatMessages.appendChild(messageDiv);
                    });
                    
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                })
                .catch(error => console.error('Erreur lors du chargement des messages:', error));
        }

        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const input = this.querySelector('.message-input');
            const message = input.value.trim();
            
            if (message) {
                fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        input.value = '';
                        loadMessages();
                    }
                })
                .catch(error => console.error('Erreur lors de l\'envoi du message:', error));
            }
        });

        // Charger les messages toutes les 5 secondes
        loadMessages();
        setInterval(loadMessages, 5000);
    </script>
</body>
</html> 