<html>

<?php
    if(!empty($_POST['filename'])) {
        $header = "Timestamp," . "Tasktype (0=addition 1=subtraction 2=word riddle," . "Solution," . "Answer," . "Error," . "Timestamp-Server\n";
        $filename = $_POST['filename'];
        $fname = $filename . ".csv";

        $file = fopen("../userlogs/" .$fname, 'a');
        fwrite($file, $header);
        fclose($file);
    }
?>

</html>
