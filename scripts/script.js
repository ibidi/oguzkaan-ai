const imageContainer = document.getElementById('container-image');
const chatContainer = document.getElementById('container-chat');
const T2SContainer = document.getElementById('container-text2speech')
const navImage = document.getElementById('navImage');
const navChat = document.getElementById('navChat');
const navT2S = document.getElementById('navT2S');
const chatResponse = document.getElementById("response-content");
const imageSubmit = document.getElementById("imageSubmit");
const indicator = document.getElementById("writing-indicator");
const imagePromptArea = document.getElementById("imagePrompt");
const chatQuestionArea = document.getElementById("questionArea");
const chatSubmit = document.getElementById("chatSubmit");
const aiGenImage = document.getElementById("aiGenImage");
const imageResponseC = document.getElementById("response-content-image")
const ozluSoz = document.getElementById("ozluSoz")

if (localStorage.getItem("chat-display") === null) {
    localStorage.setItem("chat-display", "0");
}
if (localStorage.getItem("chat-display") == "0") {
    imageContainer.style.display = "none";
    chatContainer.style.display = "block";
    T2SContainer.style.display = "none";
} else if (localStorage.getItem("chat-display") == "1") {
    imageContainer.style.display = "block";
    chatContainer.style.display = "none";
    T2SContainer.style.display = "none";
} else if (localStorage.getItem("chat-display") == "2") {
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


var sozler = [
    'Matematikle ifade edebiliyorsanız, bilginiz doyurucudur. - Lord KELVIN',
    'Bir matematik problemine dalıp gitmekten daha büyük mutluluk yoktur. - C. Morley',
    'Matematik, insan zihninin idrak edebildiği bütün kavramların ve bu kavramlar arasındaki bütün ilişkilerin ifade edildiği dildir. - AİDOS 2000',
    'Matematik, dünyayı anlamamızda ve yaşadığımız çevreyi geliştirmede başvurduğumuz bir yardımcıdır. - Baykul',
    'Bir matematikçi sanmaz fakat bilir, inandırmaya çalışmaz çünkü ispat eder. - Henri Poincare',
    'Matematikte karşılaştığınız güçlükler için endişe etmeyin. Emin olun benim karşılaştıklarım sizinkilerden daha büyüktür. - Albert Einstein',
    'Dinsiz ilim topal, ilimsiz din kördür. - Albert Einstein',
    'Matematiğin hiçbir dalı yoktur ki, ne kadar soyut olursa olsun, bir gün gerçek dünyada uygulama alanı bulmasın. - Lobachevski',
    'Doğanın muazzam kitabının dili matematiktir. - Galileo',
    'Matematik ne neden söz ettiğimizi, ne de söylediğimiz şeyin doğru olup olmadığını bilmediğimiz bir konudur. - Bertrand Russell',
    'Bir teoremin zerafeti onda görebildiğin fikirlerin sayısıyla doğru, o fikirleri görebilmek için harcadığın çabayla ters orantılıdır. - George Polya',
    'Geometri, yaratılış öncesi de vardı. - Plato',
    'Resim bir bilimdir ve tüm bilimler matematiğe dayanır. İnsanın ortaya koyduğu hiçbir şey matematikte yerini bulmaksızın bilim olamaz. - Leonardo Da Vinci',
    'Matematik düzen, simetri ve limitleri ortaya koyar ve bunlar güzelliğin en muhteşem formlarıdır. - Aristotle'
];
var ozluSozSoyle = function () {
    rasgele = Math.floor(Math.random() * sozler.length);
    ozluSoz.innerHTML = sozler[rasgele];
};


chatQuestionArea.disabled = false;
chatQuestionArea.readOnly = false;


function fetchRequest(question){
    fetch("https://chat.ibidi.com.tr/api/chat.php?question=" + encodeURIComponent(question))
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(data => {
    chatResponse.style.display = "block";
    if(data.reply=="Too many request created from this IP, please try again after an hour or bypass this obstacle by purchasing a one-time unlimited hercai key. https://hercai-shop.onrender.com/"){
        chatResponse.innerHTML = "Çok fazla istekte bulundunuz, yapay zekamızın doğru çalışması için bir kaç dakika sonra tekrardan deneyin.";
    }else{
        chatResponse.innerHTML = data.reply;
    }
    
    chatSubmit.disabled = false;
    indicator.style.display = "none";
    chatQuestionArea.value = "";
})
.catch(error => {
    console.error('There has been a problem with your fetch operation:', error);
});

}

chatSubmit.addEventListener("click", () => {
    let chatQuestion = chatQuestionArea.value;
    indicator.style.display = "block";
    chatResponse.style.display = "none";
    chatSubmit.disabled = true;
    if (chatQuestion === null) {
    } else {
       fetchRequest(chatQuestion);
}})


imageSubmit.addEventListener("click", () => {
    let imagePromptValue = imagePromptArea.value;
    if (imagePromptValue === null) {

    } else {
        imageSubmit.disabled = true;
        imageResponseC.innerHTML = "Görseliniz hazırlanıyor, lütfen bekleyin..."
        fetch("https://chat.ibidi.com.tr/api/image.php?prompt=" + imagePromptValue)
            .then(response => response.json())
            .then(data => {
                imageResponseC.innerHTML = "Aşağıda oluşturulan görsel her zaman doğru orantıda size çıktıyı vermeyebilir. Anlayışınız için teşekkür ederiz 😊"
                aiGenImage.src = data.url;
                imageSubmit.disabled = false;
                imagePromptArea.value = "";
            })
            .catch(error => {
                console.error(error);
            });
    }
});

navImage.addEventListener("click", () => {
    chatResponse.value = "Selam öğrenci! Ben Oğuzkaan Avcılar Koleji tarafından tasarlanmış bir yapay zekayım, bana bir şeyi çizmemi iste ve sonucu gör.";
});

navChat.addEventListener("click", () => {
    aiGenImage.src = "";
});