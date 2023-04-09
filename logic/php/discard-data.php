<?php

$id = isset($_POST['id'])     ? (string) $_POST['id']     : 0;
$file = '../discard-data/' . $id;

if(!file_exists($file)) {
	file_put_contents($file, 'destroy data!');
}

?>