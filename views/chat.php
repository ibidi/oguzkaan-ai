<!DOCTYPE html>
<html lang="tr-TR">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title>Oğuzkaan AI</title>
	<meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://assets.website-files.com/650dd800f863ae34fe15a3af/css/flip-menu-9932e0.webflow.f67a71690.css"
        rel="stylesheet" type="text/css" />
    <script
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    <link href="https://chat.ibidi.com.tr/oguzkaan.png" rel="shortcut icon" type="image/x-icon" />
	<style>
    @import url(https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&display=swap);#ozluSoz,.t2s-btn{left:50%;transform:translateX(-50%)}#aiGenImage{height:400px}#ozluSoz{position:fixed;bottom:0;font-size:1em;text-align:center;text-shadow:2px 2px 4px rgba(0,0,0,.5)}@keyframes scroll{0%{trans:translateY(0)}100%{transform:translateY(-100%)}}body,html{height:75%}a{color:currentColor}.nav_contain{pointer-events:none}.nav_contain>*{pointer-events:auto}*{box-sizing:border-box;padding:0;margin:0;font-family:Syne,sans-serif}.navbar{background-color:#f8f9fa;border-bottom:1px solid #dee2e6}.navbar-brand img{height:50px}.navbar-nav{margin-left:auto}.nav-item{list-style:none;display:inline;margin-right:20px}.nav-link{text-decoration:none;color:#343a40;font-weight:500}.nav-link:hover{color:#007bff}.containerx{margin-top:100px}input["type"=text]{color:#000;height:50px}.container-text2speech{margin-top:100px;text-align:center;position:relative}.textarea-t2s{width:500px;height:150px;border-radius:10px;resize:none;outline:0;border:2px solid #ccc;padding:10px;font-size:16px;font-family:Arial,sans-serif;color:#333;background-color:#f9f9f9;margin-bottom:10px}.t2s-btn{position:absolute;bottom:-35px}
    .popup{
        backgorund-image : url("https://chat.ibidi.com.tr/afis.png") !important
    }
    .response{
        width:50%;
    }
	</style>
</head>
<body>
<nav class="nav_wrap">
        <div class="nav_contain"><a href="#" class="nav_link_wrap w-inline-block">
                <div class="nav_link_svg w-embed"><img src="oguzkaan.png" style="height:85px"></img></div>
            </a><a href="#" class="nav_hamburger_wrap w-inline-block">
                <div class="nav_hamburger_base"></div>
                <div class="nav_hamburger_line"></div>
                <div class="nav_hamburger_line"></div>
            </a></div>
        <div class="menu_wrap">
            <div class="menu_base"></div>
            <div class="menu_contain"><a href="#" class="menu_link" id="navChat">Chat</a><a href="#" class="menu_link" id="navImage">Image</a><a
                    href="#" class="menu_link navT2S" id="navT2S">Text2Speech</a><a href="index.php?logout" class="menu_link">Logout</a></div>
        </div>
    </nav>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=650dd800f863ae34fe15a3af"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="https://assets.website-files.com/650dd800f863ae34fe15a3af/js/webflow.24a563ff7.js"
        type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Flip.min.js"></script>
    <script>
        $(".nav_wrap").each(function () {
            let hamburgerEl = $(this).find(".nav_hamburger_wrap");
            let navLineEl = $(this).find(".nav_hamburger_line");
            let menuContainEl = $(this).find(".menu_contain");
            let flipItemEl = $(this).find(".nav_hamburger_base");
            let menuWrapEl = $(this).find(".menu_wrap");
            let menuBaseEl = $(this).find(".menu_base");
            let menuLinkEl = $(this).find(".menu_link");

            let flipDuration = 0.6;

            function flip(forwards) {
                let state = Flip.getState(flipItemEl);
                if (forwards) {
                    flipItemEl.appendTo(menuContainEl);
                } else {
                    flipItemEl.appendTo(hamburgerEl);
                }
                Flip.from(state, { duration: flipDuration });
            }

            let tl = gsap.timeline({ paused: true });
            tl.set(menuWrapEl, { display: "flex" });
            tl.from(menuBaseEl, {
                opacity: 0,
                duration: flipDuration,
                ease: "none",
                onStart: () => {
                    flip(true);
                }
            });
            tl.to(navLineEl.eq(0), { y: 4, rotate: 45, duration: flipDuration }, "<");
            tl.to(navLineEl.eq(1), { y: -4, rotate: -45, duration: flipDuration }, "<");
            tl.from(menuLinkEl, {
                opacity: 0,
                yPercent: 50,
                duration: 0.2,
                stagger: { amount: 0.2 },
                onReverseComplete: () => {
                    flip(false);
                }
            });

            function openMenu(open) {
                if (!tl.isActive()) {
                    if (open) {
                        tl.play();
                        hamburgerEl.addClass("nav-open");
                    } else {
                        tl.reverse();
                        hamburgerEl.removeClass("nav-open");
                    }
                }
            }

            hamburgerEl.on("click", function () {
                if ($(this).hasClass("nav-open")) {
                    openMenu(false);
                } else {
                    openMenu(true);
                }
            });

            menuBaseEl.on("mouseenter", function () {
                openMenu(false);
            });
            menuBaseEl.on("click", function () {
                openMenu(false);
            });

            $(document).on("keydown", function (e) {
                if (e.key === "Escape") {
                    openMenu(false);
                }
            });
        });
    </script>
</body>
</html>

<!--</div>
				<form id="search-form" action="#" method="get" class="hidden-xs">
                    <img src="https://chat.ibidi.com.tr/user.png" alt="" width="30px" class="alt-bosluk-img">
                    <p>Hoş geldin, <?php
                    echo $_SESSION['user_name'];
                    ?></p>
                    <a href="index.php?logout" class="sol-bosluk-a">Çıkış Yap</a>
				</form>
			</div>
-->

<div class="containerx" id="container-chat">
    <center>
        <div class="care-div">
            <div class="input-container">
                <input style="color:black;" type="text" name="question" id="questionArea" required="" autocomplete="off"/>
            </div>
            <button class="button btn btn-dark" type="submit" id="chatSubmit" style="margin-top:10px">Gönder</button>
        </div>
        <div class="response">
            <br>
            <p id="response-content">
                Selam! Ben Oğuzkaan AI, bana istediğin her soruyu sorabilirsin. Ben bu soruları senin için cevaplarım.
                <br>
                Bugünden itibaren Oğuzkaan Stem Yarışmaları ve TEKNOFEST için özenle eğitildim.
            </p>
            <div id="writing-indicator" style="display: none;">
                <p>Codfy AI: Yazıyor...</p>
            </div>
        </div>
    </center>
</div>


<div class="containerx" id="container-image">
        <center>
            <div class="care-div">
                <div class="input-container">
                <input style="color:black;" type="text" name="prompt" id="imagePrompt" required="" autocomplete="off"/>
                </div>
                <button class="button btn btn-dark" id="imageSubmit">Gönder</button>
            </div>
            <div class="response">
                <br>
                <p id="response-content-image">
                    Selam! Ben Oğuzkaan AI tarafından tasarlanmış bir yapay zekayım, bana bir şeyi çizmemi iste ve sonucu gör.
                </p>
                <img id="aiGenImage" src="">
                <div id="writing-indicator" style="display: none;">
                    <p>Codfy AI: Çiziyor...</p>
                </div>
                
            </div>
        </center>
</div>

<div class="container-text2speech" id="container-text2speech">
     <textarea placeholder="Enter text" class="textarea-t2s"></textarea>
      <button class="btn btn-dark t2s-btn">Dönüştür</button>
</div>

<center><strong><p id="ozluSoz"></p></strong></center>
<script src="scripts/script.js"></script>
<script src="scripts/t2s.js"defer></script>
</body>
</html>