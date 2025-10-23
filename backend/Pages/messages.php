<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Messenger Style Chat</title>
    <link rel="stylesheet" href="../../frontend/styles-css/messages.css">
</head>
<body>
  <?php
    include '../sql/connection.php';
  
  ?>
  <?php include '../includes/navbar.php'?>
  
  <div id="app">
    <!-- Contacts List -->
    <aside id="contacts-panel">
      <header>Messages</header>
      <div id="contacts-list">
        <div class="contact active" data-name="Alice" style="--avatar-color:#4b7bec;">
          <div class="avatar" style="background-color:#4b7bec;">A</div>
          <div class="details">
            <div class="name">Alice</div>
            <div class="last-message">Hey, how are you?</div>
          </div>
        </div>
        <div class="contact" data-name="Bob" style="--avatar-color:#20bf6b;">
          <div class="avatar" style="background-color:#20bf6b;">B</div>
          <div class="details">
            <div class="name">Bob</div>
            <div class="last-message">Don’t forget the meeting.</div>
          </div>
        </div>
        <div class="contact" data-name="Charlie" style="--avatar-color:#fc5c65;">
          <div class="avatar" style="background-color:#fc5c65;">C</div>
          <div class="details">
            <div class="name">Charlie</div>
            <div class="last-message">Are we still on for today?</div>
          </div>
        </div>
        <div class="contact" data-name="Diana" style="--avatar-color:#a55eea;">
          <div class="avatar" style="background-color:#a55eea;">D</div>
          <div class="details">
            <div class="name">Diana</div>
            <div class="last-message">Thanks for the help!</div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Chat Panel -->
    <section id="chat-panel">
      <header id="chat-header">
        <div class="avatar" style="background-color:#4b7bec;">A</div>
        <div class="name">Alice</div>
      </header>

      <div id="messages-container">
        <div class="message received">Hey, how are you?</div>
        <div class="message sent">I'm good, thanks! And you?</div>
        <div class="message received">Doing great, working on a project.</div>
      </div>

      <form id="input-area" onsubmit="sendMessage(event)">
        <input
          type="text"
          id="message-input"
          placeholder="Type a message..."
          autocomplete="off"
          required
        />
        <button type="submit" id="send-btn">Send</button>
      </form>
    </section>
  </div>

  <script>
    const contacts = document.querySelectorAll('.contact');
    const chatHeader = document.getElementById('chat-header');
    const messagesContainer = document.getElementById('messages-container');
    const messageInput = document.getElementById('message-input');

    const messagesData = {
      Alice: [
        { type: 'received', text: 'Hey, how are you?' },
        { type: 'sent', text: "I'm good, thanks! And you?" },
        { type: 'received', text: 'Doing great, working on a project.' },
      ],
      Bob: [
        { type: 'received', text: 'Don’t forget the meeting.' },
        { type: 'sent', text: 'I won’t, thanks!' },
      ],
      Charlie: [
        { type: 'received', text: 'Are we still on for today?' },
      ],
      Diana: [
        { type: 'sent', text: 'Thanks for the help!' },
        { type: 'received', text: 'You’re welcome!' },
      ],
    };

    // Load messages for selected contact
    function loadMessages(name) {
      messagesContainer.innerHTML = '';
      chatHeader.querySelector('.avatar').textContent = name[0];
      chatHeader.querySelector('.avatar').style.backgroundColor = getComputedStyle(document.querySelector(`.contact[data-name="${name}"] .avatar`)).backgroundColor;
      chatHeader.querySelector('.name').textContent = name;

      const msgs = messagesData[name] || [];
      msgs.forEach(({type, text}) => {
        const div = document.createElement('div');
        div.classList.add('message', type);
        div.textContent = text;
        messagesContainer.appendChild(div);
      });
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Switch active contact
    contacts.forEach(contact => {
      contact.addEventListener('click', () => {
        contacts.forEach(c => c.classList.remove('active'));
        contact.classList.add('active');
        loadMessages(contact.dataset.name);
      });
    });

    // Send message
    function sendMessage(e) {
      e.preventDefault();
      const text = messageInput.value.trim();
      if (!text) return;

      const currentContact = document.querySelector('.contact.active').dataset.name;

      // Add sent message UI
      const sentMsg = document.createElement('div');
      sentMsg.classList.add('message', 'sent');
      sentMsg.textContent = text;
      messagesContainer.appendChild(sentMsg);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;

      // Add to data
      messagesData[currentContact].push({type: 'sent', text});

      messageInput.value = '';
      messageInput.focus();

      // Simulate reply
      setTimeout(() => {
        const replyText = "Thanks for your message!";
        const receivedMsg = document.createElement('div');
        receivedMsg.classList.add('message', 'received');
        receivedMsg.textContent = replyText;
        messagesContainer.appendChild(receivedMsg);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        messagesData[currentContact].push({type: 'received', text: replyText});
      }, 1200);
    }

    // Initial load
    loadMessages('Alice');
  </script>
</body>
</html>
