<?php

$file = 'questionnaires.csv';

$id = isset($_POST['id'])     ? (string) $_POST['id']     : 0;
$group = isset($_POST['group'])     ? (string) $_POST['group']     : 0;

// Custom questions
$c1 = isset($_POST['c1'])   ? (int) $_POST['c1']   : 0;
$c2 = isset($_POST['c2'])     ? (int) $_POST['c2']     : 0;
$c3 = isset($_POST['c3'])     ? (int) $_POST['c3']     : 0;
$c4 = isset($_POST['c4'])     ? (int) $_POST['c4']     : 0;
$c5 = isset($_POST['c5'])     ? (int) $_POST['c5']     : 0;

$c6 = isset($_POST['c6'])     ? (int) $_POST['c6']     : 0;
$c7 = isset($_POST['c7'])     ? (int) $_POST['c7']     : 0;
$c8 = isset($_POST['c8'])     ? (int) $_POST['c8']     : 0;
$c9 = isset($_POST['c9'])     ? (int) $_POST['c9']     : 0;
$c10 = isset($_POST['c10'])     ? (int) $_POST['c10']     : 0;
$c11 = isset($_POST['c11'])     ? (int) $_POST['c11']     : 0;
$c12 = isset($_POST['c12'])     ? (int) $_POST['c12']     : 0;
$c13 = isset($_POST['c13'])     ? (int) $_POST['c13']     : 0;
$c14 = isset($_POST['c14'])     ? (int) $_POST['c14']     : 0;
$c15 = isset($_POST['c15'])     ? (int) $_POST['c15']     : 0;

// Questions from paper
$pi1 = isset($_POST['pi1'])   ? (int) $_POST['pi1']   : 0;
$pi2 = isset($_POST['pi2'])     ? (int) $_POST['pi2']     : 0;
$pi3 = isset($_POST['pi3'])     ? (int) $_POST['pi3']     : 0;

$nv1 = isset($_POST['nv1'])   ? (int) $_POST['nv1']   : 0;
$nv2 = isset($_POST['nv2'])     ? (int) $_POST['nv2']     : 0;
$nv3 = isset($_POST['nv3'])     ? (int) $_POST['nv3']     : 0;

$att1 = isset($_POST['att1'])   ? (int) $_POST['att1']   : 0;
$att2 = isset($_POST['att2'])     ? (int) $_POST['att2']     : 0;
$att3 = isset($_POST['att3'])     ? (int) $_POST['att3']     : 0;

$ovrw1 = isset($_POST['ovrw1'])   ? (int) $_POST['ovrw1']   : 0;
$ovrw2 = isset($_POST['ovrw2'])     ? (int) $_POST['ovrw2']     : 0;
$ovrw3 = isset($_POST['ovrw3'])     ? (int) $_POST['ovrw3']     : 0;

$bin1 = isset($_POST['bin1'])   ? (int) $_POST['bin1']   : 0;
$bin2 = isset($_POST['bin2'])     ? (int) $_POST['bin2']     : 0;
$bin3 = isset($_POST['bin3'])     ? (int) $_POST['bin3']     : 0;

$ovr1 = isset($_POST['ovr1'])   ? (int) $_POST['ovr1']   : 0;
$ovr2 = isset($_POST['ovr2'])     ? (int) $_POST['ovr2']     : 0;
$ovr3 = isset($_POST['ovr3'])     ? (int) $_POST['ovr3']     : 0;

$pe1 = isset($_POST['pe1'])   ? (int) $_POST['pe1']   : 0;
$pe2 = isset($_POST['pe2'])     ? (int) $_POST['pe2']     : 0;
$pe3 = isset($_POST['pe3'])     ? (int) $_POST['pe3']     : 0;
$pe4 = isset($_POST['pe4'])     ? (int) $_POST['pe4']     : 0;

$ee1 = isset($_POST['ee1'])   ? (int) $_POST['ee1']   : 0;
$ee2 = isset($_POST['ee2'])     ? (int) $_POST['ee2']     : 0;
$ee3 = isset($_POST['ee3'])     ? (int) $_POST['ee3']     : 0;
$ee4 = isset($_POST['ee4'])     ? (int) $_POST['ee4']     : 0;

$hm1 = isset($_POST['hm1'])   ? (int) $_POST['hm1']   : 0;
$hm2 = isset($_POST['hm2'])     ? (int) $_POST['hm2']     : 0;
$hm3 = isset($_POST['hm3'])     ? (int) $_POST['hm3']     : 0;


if(!file_exists($file)) {
	file_put_contents($file, 'id,group,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,pi1,pi2,pi3,nv1,nv2,nv3,att1,att2,att3,ovrw1,ovrw2,ovrw3,bin1,bin2,bin3,ovr1,ovr2,ovr3,pe1,pe2,pe3,pe4,ee1,ee2,ee3,ee4,hm1,hm2,hm3,time');
}


$line = "\n" . implode(',', array($id, $group, $c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $c13, $c14, $c15, $pi1, $pi2, $pi3, $nv1, $nv2, $nv3, $att1, $att2, $att3, $ovrw1, $ovrw2, $ovrw3, $bin1, $bin2, $bin3, $ovr1, $ovr2, $ovr3, $pe1, $pe2, $pe3, $pe4, $ee1, $ee2, $ee3, $ee4, $hm1, $hm2, $hm3, date("Y-m-d H:i:s")));
file_put_contents($file, $line, FILE_APPEND);
?>