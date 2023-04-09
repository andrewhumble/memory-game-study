<?php

$file = '../demographics/demographics.csv';

$id = isset($_POST['id'])     ? (string) $_POST['id']     : 0;
$group = isset($_POST['group'])     ? (string) $_POST['group']     : 0;
$age = isset($_POST['age'])     ? (string) $_POST['age']     : 0;
$occupation = isset($_POST['occupation'])     ? (string) $_POST['occupation']     : 0;
$competence = isset($_POST['competence'])     ? (string) $_POST['competence']     : 0;
$expectancy = isset($_POST['expectancy'])     ? (string) $_POST['expectancy']     : 0;
$useragent = isset($_POST['useragent'])     ? (string) $_POST['useragent']     : 0;

$female = isset($_POST['female'])     ? (string) $_POST['female']     : 0;
$male = isset($_POST['male'])     ? (string) $_POST['male']     : 0;
$other = isset($_POST['other'])     ? (string) $_POST['other']     : 0;
$none = isset($_POST['none'])     ? (string) $_POST['none']     : 0;

if(!file_exists($file)) {
	file_put_contents($file, 'id,group,age,occupation,female,male,other,none,competence,expectancy,useragent,,time');
}

$line = "\n" . implode(',', array($id, $group, $age, $occupation, $female, $male, $other, $none, $competence, $expectancy, $useragent, date("Y-m-d H:i:s")));
file_put_contents($file, $line, FILE_APPEND);

?>