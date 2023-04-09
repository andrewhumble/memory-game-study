<?php

$file = 'tlx.csv';

$id = isset($_POST['id'])     ? (string) $_POST['id']     : 0;
$group = isset($_POST['group'])     ? (string) $_POST['group']     : 0;

// NASA-TLX
$tlx1 = isset($_POST['mental-demand'])   ? (int) $_POST['mental-demand']   : 0;
$tlx2 = isset($_POST['physical-demand']) ? (int) $_POST['physical-demand'] : 0;
$tlx3 = isset($_POST['temporal-demand']) ? (int) $_POST['temporal-demand'] : 0;
$tlx4 = isset($_POST['performance'])     ? (int) $_POST['performance']     : 0;
$tlx5 = isset($_POST['effort'])          ? (int) $_POST['effort']          : 0;
$tlx6 = isset($_POST['frustration'])     ? (int) $_POST['frustration']     : 0;


if(!file_exists($file)) {
	file_put_contents($file, 'id,group,mental-demand,physical-demand,temporal-demand,performance,effort,frustration,time');
}


$line = "\n" . implode(',', array($id, $group, $tlx1, $tlx2, $tlx3, $tlx4, $tlx5, $tlx6, date("Y-m-d H:i:s")));
file_put_contents($file, $line, FILE_APPEND);
?>