<?php
namespace Bigprimes\Pages;

use Gregwar\Captcha\CaptchaBuilder;

class Contact extends \Bigprimes\Pages{
    public function getContent(){

    $return = '';

    $captcha = new CaptchaBuilder;
    $captcha->build();

    $_POST['name']   = isset($_POST['name'])?filter_var($_POST['name'], FILTER_SANITIZE_STRING):'';
    $_POST['email']  = isset($_POST['email'])?filter_var($_POST['email'], FILTER_SANITIZE_EMAIL):'';
    $_POST['message']= isset($_POST['message'])?filter_var($_POST['message'], FILTER_SANITIZE_STRING):'';

    $contact = 'sent';
    if ($_POST['message'] != '' || $_POST['email'] != ''){
        if($_POST['email'] == ''){
                $return .= 'please fill in your e-mail address.';
                $contact = '';
        }elseif($_POST['message'] == ''){
                $return .= 'Please type in your message.';
                $contact = '';
        }elseif(!$captcha->testPhrase($userInput)){
                $return .= 'The reCAPTCHA wasn\'t entered correctly. Go back and try it again.';
                $contact = '';
        }else{
                $return .=
                "<a class=\"a\">Thank you for your message. We will get back to you as soon as we can.</a>";
                $message = "This email was generated via the BIGprimes contact page. It is from ".$_POST['name'].".<br /><br />\r\n\r\n".$_POST['message'];
                $headers = "From: ".$_POST['email']."\r\n".
                                   "Reply-To: ".$_POST['email']."\r\n".
                                   "MIME-version: 1.0\r\n".
                                   "Content-Transfer-Encoding: 7bit\r\n".
                                   "Content-Type: text/html; charset=\"us-ascii\"\r\n".
                                   "X-Mailer: PHP/".phpversion();
                mail('primes@bigprimes.net', 'BIGprimes - Contact Page', stripslashes($message), $headers);
        }
     }else{
         $contact = '';
     }

      if ($contact != 'sent'){
        $_SESSION['phrase'] = $captcha->getPhrase();
        $return .=
        '<h1>Contact Us</h1>'.
        '<form action="?send" method="post">'.
          '<table style="border:1px solid #000000">'.
            '<tr>'.
              '<td>'.
                '<table width="450" bgcolor="#E0FAED" border="0" cellspacing="0" cellpadding="4">'.
                  '<tr>'.
                     '<td valign="top" colspan="2" height="30">'.
                       '<font class="a">'.
                         'Please use this form for any feedback about the site. If you have any questions or problems with the site please don\'t hesitate to ask. We welcome any suggestions you may have.'.
                         '<br /><br />'.
                       '</font>'.
                     '</td>'.
                   '</tr>'.
                   '<tr>'.
                     '<td width="100" valign="top" height="30"><font class="a">Contact Name:</font></td>'.
                     '<td><input name="name" type="text" value="'.stripslashes($_POST['name']).'" /></td>'.
                   '</tr>'.
                   '<tr>'.
                     '<td valign="top" height="30"><font class="a">Email Address:</font></td>'.
                     '<td><input name="email" type="text" value="'.stripslashes($_POST['email']).'" /></td>'.
                   '</tr>'.
                   '<tr>'.
                     '<td valign="top"><font class="a">Message:</font></td>'.
                     '<td><textarea name="message" cols="40" rows="10">'.stripslashes($_POST['message']).'</textarea></td>'.
                   '</tr>'.
                   '<tr>'.
                     '<td valign="top"><font class="a">Captcha:</font></td>'.
                     '<td><img src='.$captcha->inline().' /></td>'.
                   '</tr>'.
                   '<tr>'.
                     '<td></td>'.
                     '<td align="right"><br /><input name="submit" type="submit" value="Send" /></td>'.
                   '</tr>'.
                 '</table>'.
              '</td>'.
            '</tr>'.
          '</table>'.
        '</form>';
      }

      return
      $return;
    }
}
