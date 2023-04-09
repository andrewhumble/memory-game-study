<?php

$file = '../emails/emails.csv';

$email = isset($_POST['email'])     ? (string) $_POST['email']     : 0;

if(!file_exists($file)) {
	file_put_contents($file, 'email');
}

$line = "\n" . implode(',', array($email));
file_put_contents($file, $line, FILE_APPEND);

?>