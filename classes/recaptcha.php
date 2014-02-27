<?php
class recaptcha{
    private $publicKey  = '6LchlsQSAAAAAJ4ua32MYvSesoS9J7tato5onRGT';
    private $privateKey = '6LchlsQSAAAAAFoKAcuNHvH566F3_DY5mdWKlk8a';
    function __construct(){
        require_once('3rdparty/recaptcha-php-1.11/recaptchalib.php');
    }
    public function display(){
        return recaptcha_get_html('6LchlsQSAAAAAJ4ua32MYvSesoS9J7tato5onRGT');
    }
    public function verify(){
        $resp = recaptcha_check_answer ('6LchlsQSAAAAAFoKAcuNHvH566F3_DY5mdWKlk8a',
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            return false;
        } else {
            return true;
        }
    }
}
?>