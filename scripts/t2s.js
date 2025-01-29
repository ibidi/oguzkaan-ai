    const textarea = document.querySelector(".textarea-t2s");
    const button = document.querySelector(".t2s-btn");
    let isSpeaking = true;
    const textToSpeech = () => {
      const synth = window.speechSynthesis;
      const text = textarea.value;
      if (!synth.speaking && text) {
        const utternace = new SpeechSynthesisUtterance(text);
        synth.speak(utternace);
      }
      if (text.length > 50) {
        if (synth.speaking && isSpeaking) {
          button.innerText = "Durdur";
          synth.resume();
          isSpeaking = false;
        } else {
          button.innerText = "Devam Et";
          synth.pause();
          isSpeaking = true;
        }
      } else {
        isSpeaking = false;
        button.innerText = "Konuşuyor";
      }
      setInterval(() => {
        if (!synth.speaking && !isSpeaking) {
          isSpeaking = true;
          button.innerText = "Sese Çevir";
        }
      });
    };
    button.addEventListener("click", textToSpeech);