const chatLog = document.getElementById('chat-log');
const userInput = document.getElementById('user-input');
const sendButton = document.getElementById('send-button');
const buttonIcon = document.getElementById('button-icon');
const info = document.querySelector('.info');
var buttonDisabled = false;

sendButton.addEventListener('click', sendMessage);
userInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        if (!buttonDisabled) {
            sendMessage();
        }
    }
});

function sendMessage() {
    sendButton.disabled = true;
    buttonDisabled = true;
    const message = userInput.value.trim();
    if (message === '') {
        return;
    }

    appendMessage('user', message);
    userInput.value = '';

    fetch('https://chat.ibidi.com.tr/api/chat.php?question=' + encodeURIComponent(message))
        .then((response) => response.json())
        .then((response) => {
            if (response.reply) {
                setTimeout(() => {
                    appendMessage('bot', decodeURIComponent(response.reply));
                    buttonIcon.classList.add('fa-solid', 'fa-paper-plane');
                    buttonIcon.classList.remove('fas', 'fa-spinner', 'fa-pulse');
                    sendButton.disabled = false;
                    buttonDisabled = false;
                }, 1000);
            } else {
                buttonIcon.classList.add('fa-solid', 'fa-paper-plane');
                buttonIcon.classList.remove('fas', 'fa-spinner', 'fa-pulse');
                sendButton.disabled = false;
                buttonDisabled = false;
            }
        })
        .catch((err) => {
            appendMessage('bot', 'Hata: API Key kontrol edilmedi!');
            buttonIcon.classList.add('fa-solid', 'fa-paper-plane');
            buttonIcon.classList.remove('fas', 'fa-spinner', 'fa-pulse');
            sendButton.disabled = false;
            buttonDisabled = false;
        });
}

function appendMessage(sender, message) {
    info.style.display = "none";
    buttonIcon.classList.remove('fa-solid', 'fa-paper-plane');
    buttonIcon.classList.add('fas', 'fa-spinner', 'fa-pulse');

    const messageElement = document.createElement('div');
    const iconElement = document.createElement('div');
    const chatElement = document.createElement('div');
    const icon = document.createElement('i');

    chatElement.classList.add("chat-box");
    iconElement.classList.add("icon");
    messageElement.classList.add(sender);
    messageElement.innerText = message;

    if (sender === 'user') {
        icon.classList.add('fa-regular', 'fa-user');
        iconElement.setAttribute('id', 'user-icon');
    } else {
        icon.classList.add('fa-solid', 'fa-robot');
        iconElement.setAttribute('id', 'bot-icon');
    }

    iconElement.appendChild(icon);
    chatElement.appendChild(iconElement);
    chatElement.appendChild(messageElement);
    chatLog.appendChild(chatElement);
    chatLog.scrollTo = chatLog.scrollHeight;
}
