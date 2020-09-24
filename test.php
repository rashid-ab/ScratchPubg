<?php

$to      = 'bilal.appcrates@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: sultan@appcrates.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
echo "Done";
?>