<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Boş kullanıcı adı.";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Boş şifre.";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "İki şifre birbiri ile uyuşmuyo.r";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Şifre minimum 6 karakter olmalı.";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Kullanıcı adı 2 karakterden kısa, 64 karakterden uzun olamaz.";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Kullanıcı adı şartlara uymuyor. Sadece harfler ve sayılar kullanılabilir.";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email kısmı boş olamaz.";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email 64 karakterden uzun olamaz.";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email adresin doğru formatta değil";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Üzgünüz, bu kullanıcı adı zaten alındı. Lütfen başka bir kulanıcı adını dene";
                } else {
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) {
                        $this->messages[] = "Hesabın başarıyla oluşturuldu, şimdi başarıyla giriş yapabilirsin";
                    } else {
                        $this->errors[] = "Üzgünüz, kayıt işleminde bir hata ile karşılaşıldı. Lütfen tekrar dene. Bir hata olduğunu düşünüyorsan bir yönetici ile iletişime geç.";
                    }
                }
            } else {
                $this->errors[] = "Özür dileriz, veri tabanı ile ilgili bir hata oluştu. Lütfen bir yönetici ile iletişime geç.";
            }
        } else {
            $this->errors[] = "Bilinmeyen bir hata oluştu.";
        }
    }
}
