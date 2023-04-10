<?php
header('Content-Type: text/html');
header('Content-Disposition: inline; filename="assertion.php"');

?>
<html>
    <head>
         <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../tlx/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .container {
                max-width: 768px;
            }

            .text-left {
                text-align: left;
            }

            .text-center {
                text-align: center;
                font-weight: bold;
                color: #ccc;
            }

            .text-right {
                text-align: right;
            }

            .scale {
                width: 100%;
                margin-bottom: 5px;
                border: 2px solid #333;
                background-color: #fff;
                border-collapse: collapse;
            }

            .scale td {
                height: 18px;
            }

            .scale .tick {
                border-right: 2px solid #333;
            }

            .highlighted {
                background-color: #ccc;
            }

            .selected {
                background-color: #f00;
            }
        </style>

        <script language="JavaScript">
            var g_id = "";
            var g_group = "";

            const g_nothing = 'Welcome to the experiment. In this experiment you will solve the previously described word puzzles. <br><br><b>You have been selected for the following condition: The difficulty of the word puzzles is not adapted. The word puzzles are presented with a random level of difficulty.</b><br><br> Please click on "Specify demographic data" button to get started.  After the experiment you will be asked to provide some more information. In total the experiment takes about 20 minutes.'

            const g_performance = 'Welcome to the experiment. In this experiment you will solve the previously described word puzzles. <b>You have been selected for the following condition: The difficulty of the word puzzles will be adjusted by a non-intelligent assistant utilizing an adaptive algorithm that takes your task performance into account. This means that the difficulty of the word puzzles are based on your solution efficiency.</b><br><br> Please click on "Specify demographic data" button to get started.  After the experiment you will be asked to provide some more information. In total the experiment takes about 20 minutes.'

            const g_camera = 'Welcome to the experiment. In this experiment you will solve the previously described word puzzles. <b>You have been selected for the following condition: The difficulty of the word puzzles will be adjusted by an assistant utilizing a self-developed innovative artificial intelligence that analyzes your webcam video and then selects the optimal task difficulty for you. Specifically, a neural network is used to determine the stress level. If the stress level is high, the difficulty of the task is reduced. With a low stress level, the task difficulty is increased. <br>The camera image is not recorded and sent. The processing of the camera image is exclusively done on your device!</b><br><br> Please click on "Specify demographic data" button to get started. After the experiment you will be asked to provide some more information. In total the experiment takes about 20 minutes.'

            function getRandomInt(min, max) {
                return Math.floor(Math.random() * (max - min + 1) ) + min;
            }

            function generateUserID() {
                return Math.random().toString(36).substr(2, 9);
            }

            function selectGroup() {
                var group = "";
                if (true) {
                    success();
                } else {
                    error();
                }
            }

            function success() {
                var group = "";
                var experimentGroup = getRandomInt(0, 2);
                // No adjustments
                if (experimentGroup % 3 === 0) {
                    document.getElementById("groupText").innerHTML = g_nothing;
                    group = "nothing";
                }

                // Adjustments based on performance
                if (experimentGroup % 3 === 1) {
                    document.getElementById("groupText").innerHTML = g_performance;
                    group = "performance";
                }

                // Adjustments based on camera picture
                if (experimentGroup % 3 === 2) {
                    document.getElementById("groupText").innerHTML = g_camera;
                    group = "camera";
                }
                // hardcoded
                g_group = group;
                document.getElementById("startExperimentButton").style.display = "inline";
            }

            function error() {
                document.getElementById("groupText").innerHTML = "You have either no webcam connected to your PC or you blocked the webcam access through your browser. Please enable the webcam access in your browser settings and refresh this page.<br><br>The camera access can be typically activated by clicking on the camera symbol (usually located right side in the URL bar). Refresh the web page afterward.";
            }
            

            function startDemographics() {
                // Grab elements and create settings
                window.location.href = "../demographics.html?id=" + g_id + "&group=" + g_group;
            }

            function startup() {
                g_id = generateUserID();
                selectGroup();
                
            }
        </script>
        <h1>Group Allocation</h1>
    </head>


    <body onload="startup()" class="container pull-left" style="position: relative; top: 10em">
        <p id="groupText">You will be divided into one of the experiment groups. Please be patient for a moment. If your browser asks you to activate the camera, please confirm. <b>No data will be recorded or sent via the camera!</b></p>
        <input id="startExperimentButton" type="submit" value="Specify demographic data" onclick="startDemographics()" class="btn btn-default pull-left" style="display:none"/>
    </body>
</html>