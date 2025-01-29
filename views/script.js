const imageContainer = document.getElementById('container-image');
const chatContainer = document.getElementById('container-chat');
const T2SContainer = document.getElementById('container-text2speech')
const navImage = document.getElementById('navImage');
const navChat = document.getElementById('navChat');
const navT2S = document.getElementById('navT2S');

if (localStorage.getItem("chat-display") === null) {
  localStorage.setItem("chat-display", "0");
}
if (localStorage.getItem("chat-display") == "0") {
      imageContainer.style.display = "none";
      chatContainer.style.display = "block";
      T2SContainer.style.display = "none";
} else if(localStorage.getItem("chat-display") == "1"){
      imageContainer.style.display = "block";
      chatContainer.style.display = "none";
      T2SContainer.style.display = "none";
}else if(localStorage.getItem("chat-display") == "2"){
      T2SContainer.style.display = "block";
      imageContainer.style.display = "none";
      chatContainer.style.display = "none";
}


navImage.addEventListener("click", () => {
  imageContainer.style.display = "block";
  chatContainer.style.display = "none";
  T2SContainer.style.display = "none";
  localStorage.setItem("chat-display", "1");
});

navChat.addEventListener("click", () => {
  imageContainer.style.display = "none";
  chatContainer.style.display = "block";
  T2SContainer.style.display = "none";
  localStorage.setItem("chat-display", "0");
});

navT2S.addEventListener("click", () => {
  imageContainer.style.display = "none";
  chatContainer.style.display = "none";
  T2SContainer.style.display = "block";
  localStorage.setItem("chat-display", "2");
});