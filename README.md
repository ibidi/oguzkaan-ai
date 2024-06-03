<p align="center"> <a href="#"> <img width=500 src="https://cdn.discordapp.com/attachments/1110972356798709861/1247085924865544275/oguzzzz-photoaidcom-cropped.png?ex=665ebec6&is=665d6d46&hm=02236dbe11f37e06f922b5b0e95c5f158d3c6be4328792d5953204c1695df0a9&"></a></p> 
<p align="center"><img src="https://img.shields.io/npm/v/ibidi?style=for-the-badge"> <img src="https://img.shields.io/github/repo-size/ibidi/oguzkaan-ai?style=for-the-badge"> <img src="https://img.shields.io/github/contributors/ibidi/oguzkaan-ai?style=for-the-badge"> <img src="https://img.shields.io/github/package-json/dependency-version/Bes-js/ibidi/oguzkaan-ai?style=for-the-badge"> <a href="https://discord.gg/ibidi" target="_blank"> <img alt="Discord" src="https://img.shields.io/badge/Support-Click%20here-7289d9?style=for-the-badge&logo=discord"> </a><a href="https://www.buymeacoffee.com/ibidi" target="_blank"></p>

# [Oguzkaan.Ai](https://discord.gg/ibidi)

> **A powerful library for interacting with the [Oguzkaan.Ai](https://discord.gg/ibidi) API.**

> **We Offer It To You For Free.**
> **[Oguzkaan.Ai](https://discord.gg/ibidi) Answers Your Question According To The Language, And It Supports All Languages.**
#
### ❔ [Support](https://discord.gg/ibidi)
### 📂 [Loading](https://npmjs.com/)
### 📖 [Document's](https://fivesobes.gitbook.io/hercai/)
### 📝 [Github](https://github.com/ibidi/Oguzkaan.Ai)

# Quick Example
 
 > **Question API; [https://chat.ibidi.com.tr/api/chat.php?question=](https://chat.ibidi.com.tr/api/chat.php?question=)**

**Example Question For JavaScript;**
```js
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
                }, 1000);
            }
        })
        .catch((err) => {
            appendMessage('bot', 'Hata: API Key kontrol edilmedi!');
        });
}
```
#
# Credits
 
**Made by [Arjen Adin Aldanmaz](https://github.com/makesikann) And [ibidi](https://github.com/ibidi)**
