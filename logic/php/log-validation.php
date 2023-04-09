<?php

$file = '../validation/validation.csv';

$id = isset($_POST['id'])     ? (string) $_POST['id']     : 0;
$group = isset($_POST['group'])     ? (string) $_POST['group']     : 0;

// validation block one
$q1_a1 = isset($_POST['q1-a1'])     ? (string) $_POST['q1-a1']     : 0;
$q1_a2 = isset($_POST['q1-a2'])     ? (string) $_POST['q1-a2']     : 0;
$q1_a3 = isset($_POST['q1-a3'])     ? (string) $_POST['q1-a3']     : 0;

// validation block two
$q2_a1 = isset($_POST['q2-a1'])     ? (string) $_POST['q2-a1']     : 0;
$q2_a2 = isset($_POST['q2-a2'])     ? (string) $_POST['q2-a2']     : 0;
$q2_a3 = isset($_POST['q2-a3'])     ? (string) $_POST['q2-a3']     : 0;

// validation block three
$q3_a1 = isset($_POST['q3-a1'])     ? (string) $_POST['q3-a1']     : 0;
$q3_a2 = isset($_POST['q3-a2'])     ? (string) $_POST['q3-a2']     : 0;
$q3_a3 = isset($_POST['q3-a3'])     ? (string) $_POST['q3-a3']     : 0;


if(!file_exists($file)) {
	file_put_contents($file, 'id,group,q1-a1,q1-a2,q1-a3,q2-a1,q2-a2,q2-a3,q3-a1,q3-a2,q3-a3,time');
}

$line = "\n" . implode(',', array($id, $group, $q1_a1,$q1_a2,$q1_a3,$q2_a1,$q2_a2,$q2_a3,$q3_a1,$q3_a2,$q3_a3, date("Y-m-d H:i:s")));
file_put_contents($file, $line, FILE_APPEND);

?>