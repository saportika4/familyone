<?php
    $toEmail = "admin@phppot_samples.com";
    $mailHeaders = "From: " . $_POST["Name"] . "<". $_POST["Email"] .">\r\n";
    if(mail($toEmail, $_POST["Message"], $_POST["content"], $mailHeaders)) {
        print "<p class='success'>Mail Sent.</p>";
    } else {
        print "<p class='Error'>Problem in Sending Mail.</p>";
    }
?>