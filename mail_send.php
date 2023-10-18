<?php

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

if (isset($_POST['submit'])) {
    
    if(isset($_POST['address']) && !empty($_POST['address'])) {
        die();
    }

        $name = $_POST['name'];
        // $number = $_POST['number'];
        $message = $_POST['message'];
        $from = $_POST['email'];

        $mailHeaders = "Name: " . $name . "\r\nMail: " . $from . "\r\nMessage: " . $message ;

        $to = "hashmvhashmuhammed007@gmail.com";
        
        $subject = 'familyone.com';
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

        $headers .= "From:" . $from  . "\r\n" .
        "Reply-To: formsbuilders.com" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

        if(mail($to,$subject,$mailHeaders,$headers)) {
        
            header("Location: index.php?success=Send successfully#success");
            exit();
        }

}

else {
    echo "The email was not sent.";
}

?>

