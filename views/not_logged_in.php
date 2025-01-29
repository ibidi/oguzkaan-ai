<?php
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo "<script>alert('$error')</script>";
        }
    }
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT COUNT(*) FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$user_count = $row["COUNT(*)"];
	} else {
		$user_count = 0;
	}

	$conn->close();
?>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="oguzkaan.png">
    <title>Oğuzkaan AI</title>
    <link rel="stylesheet" href="style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button, .container input[type="submit"]{
    background-color: #512da8;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
    background-color:#DF0C18;
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
    background-color:#DF0C18;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
        background-color:#DF0C18;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
        background-color:#DF0C18;
    }
}

.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
    background-color:#DF0C18;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
    background-color:#DF0C18;
}

.toggle{
    height: 100%;
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
    background-color:#DF0C18;
}

.container.active .toggle{
    transform: translateX(50%);
    background-color:#DF0C18;
}

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
    background-color:#DF0C18;
}

.toggle-left{
    transform: translateX(-200%);
    background-color:#DF0C18;
}

.container.active .toggle-left{
    transform: translateX(0);
    background-color:#DF0C18;
}

.toggle-right{
    right: 0;
    transform: translateX(0);
    background-color:#DF0C18;
}

.container.active .toggle-right{
    transform: translateX(200%);
    background-color:#DF0C18;
}

.container img{
    height:100px;
    margin-bottom:10px;
}

.active div{
    
}


input[type="submit"], .container input[type="submit"], .button-red {
    background-color: red;
}
</style>
</head>

<body>
    

<div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" action="register.php" name="registerform">
                <h1>Hesap Oluştur</h1>
                <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Kullanıcı Adı" required />
                <input id="login_input_email" class="login_input" type="email" name="user_email" placeholder="Email" required />        
                <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Şifre (En az 6 karakter)" />
                <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Şifre Tekrar" />         
                <input class="button-red" type="submit"  name="register" value="Kayıt Ol" />
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" action="index.php" name="loginform">
                <img src="oguzkaan.png" alt="">
                <h1>Giriş Yap</h1>
                <input id="login_input_username" class="login_input" type="text" name="user_name" placeholder="Kullanıcı Adı" autocomplete="off" required/>
                <input id="login_input_password" class="login_input" type="password" name="user_password" placeholder="Şifre" autocomplete="off" required />
                <input class="button-red" type="submit" name="login" value="Giriş Yap"/>
                <p id="userP"></p>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Hoş Geldin !</h1>
                    <p>Giriş bilgilerini kullanarak uygulamamıza erişebilirsin.</p>
                    <button class="hidden" id="login">Giriş Yap</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Selam !</h1>
                    <p>Kayıt olarak uygulamamızın bütün özelliklerine erişebilirsiniz.</p>
                    <button class="hidden" id="register">Kayıt Ol</button>
                </div>
            </div>
        </div>
    </div>

    <script>
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const userP = document.getElementById('userP');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

var user_count = <?php echo $user_count;?>;
userP.innerHTML = "Kayıtlı kullanıcı sayısı <strong>" + user_count + "</strong>";

</script>

</body>
</html>