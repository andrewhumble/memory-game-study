<html>

<?php
    if(!empty($_POST['filename'])){
        $filename = $_POST['filename'];
        $fname = $filename . ".csv";
        $data = $_POST['data'] . "," . time();

        $file = fopen("../userlogs/" . $fname, 'a');

        fwrite($file, $data . "\n");
        fclose($file);
    }
?>

</html>
