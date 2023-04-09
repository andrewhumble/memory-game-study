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
    <style type="text/css"> 
      input,td, h2 { 
        font-family: verdana, arial; 
        font-size: 14px; 
      }
	
      h1 { 
          font-family: verdana, arial; 
          font-size: 32px; 
      } 

      table { 
          display: table;
          border-collapse: separate;
          border-spacing: 2px;
          border-color: lightgreen;
      }

      .loader {
        border: 0.5em solid #f3f3f3; /* Light grey */
        border-top: 0.5em solid #3498db; /* Blue */
        border-radius: 50%;
        width: 2em;
        height: 2em;
        animation: spin 2s linear infinite;
        margin-left: auto;
        margin-right: auto;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
	
    </style> 
  
    <script src="../js/papaparse.min.js" type="text/javascript"></script>
    <script language="JavaScript">

      var lastVal= 0;
      var next_a = 0;
      var next_b = 0;
      var aufgabeSmallBig = 1;
      var g_taskType = 0;
      var g_wordList = null;
      var g_numSelectedChars = 0;
      var g_currentWordSelection = "";
      var g_selectedWord = "";
      const g_numTrials = 19;
      var g_counterAddition = 0;
      var g_counterSubtraction = 0;
      var g_counterWordRiddle = 0;
      var g_group = "";
      var g_id = "";

      function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1) ) + min;
      }

      function redirectPost(url, data) {
          var form = document.createElement('form');
          document.body.appendChild(form);
          form.method = 'post';
          form.action = url;
          for (var name in data) {
              var input = document.createElement('input');
              input.type = 'hidden';
              input.name = name;
              input.value = data[name];
              form.appendChild(input);
          }
          form.submit();
      }

      function aufgabe()
      {
        // determine remaining task types
        var taskType = 0;
        var numTrialsPerCondition = g_numTrials;

        if (g_counterWordRiddle > numTrialsPerCondition) {
          // redirect to next page
          document.getElementById("FormWordRiddle").style.display = "none";
          document.getElementById("FormCalculator").style.display = "none";
          taskType = -1;
          window.location.href = "../tlx/tlx.html?id=" + g_id + "&group=" + g_group;
        }

        g_counterWordRiddle += 1;
        document.getElementById("FormWordRiddle").style.display = "inline";
        document.getElementById("FormCalculator").style.display = "none";
        wordRiddle();
      
        window.document.Calculator.aLine.value = "";

      }

      function addition() {
          var a = 0;
          var b = 0;

          a = getRandomInt(1, 10);
          b = getRandomInt(1, 10);

          window.document.Calculator.question.value =  a + " + " + b;

      }


      function subtraction() {

        var a = 0;
        var b = 0;

        a = parseInt(getRandomInt(2, 19));
        b = parseInt(getRandomInt(1, a - 1));

        window.document.Calculator.question.value =  a + " - " + b;

      }

      // helper method to shuffle strings correctly
      String.prototype.shuffle = function () {
        var a = this.split(""),
            n = a.length;

        for(var i = n - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var tmp = a[i];
            a[i] = a[j];
            a[j] = tmp;
        }
        return a.join("");
      }

      function parseWords() {
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "../words/words-international-short.csv", false);
        rawFile.onreadystatechange = function () {
          if(rawFile.readyState === 4) {
            if(rawFile.status === 200 || rawFile.status == 0) {
              var allText = rawFile.responseText;
              Papa.parse(allText, {
                complete: function(results) {
                  g_wordList = results;
                }
              });
            }
          }
        }
        rawFile.send(null);
      }


      function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
      }


      function wordRiddle() {

        // init global variables
        g_numSelectedChars = 0;
        g_currentWordSelection = "";
        var wordList = g_wordList.data[0];

        var wordId = getRandomInt(0, wordList.length - 2);
        var selectedWord = wordList[wordId].trim();
        g_wordList.data[0].splice(wordId, 1);

        g_selectedWord = selectedWord;
        var shuffledWord = selectedWord.shuffle();

        if (shuffledWord === selectedWord) {
          shuffledWord = selectedWord.shuffle();
        }

        var selectedWordLength = shuffledWord.length;
        window.document.WordRiddle.question.value = shuffledWord;
        var UIString = "";
        for (i = 0; i < selectedWordLength; i++) {
          UIString += "<td width=50 id=\"" + i + "\"><input name=B1 type=button value=\"" + shuffledWord[i] + "\" onClick=\"checkResultWord('" + shuffledWord[i] + "','" + selectedWord + "'," + i + ")\"></td>\n";
        }
        document.getElementById("wordRiddleInputField").innerHTML = UIString;

      }


      function drawMathTasks() {
        aufgabe();

        window.document.Calculator.B1.value = " " + 1 + "     ";
        window.document.Calculator.B2.value = " " + 2 + "     ";
        window.document.Calculator.B3.value = " " + 3 + "     ";
        window.document.Calculator.B4.value = " " + 4 + "     ";
        window.document.Calculator.B5.value = " " + 5 + "     ";
        window.document.Calculator.B6.value = " " + 6 + "     ";
        window.document.Calculator.B7.value = " " + 7 + "     ";
        window.document.Calculator.B8.value = " " + 8 + "     ";
        window.document.Calculator.B9.value = " " + 9 + "     ";
        window.document.Calculator.B10.value = " " + 10 + "   ";
        window.document.Calculator.B11.value = " " + 11 + "   ";
        window.document.Calculator.B12.value = " " + 12 + "   ";
        window.document.Calculator.B13.value = " " + 13 + "   ";
        window.document.Calculator.B14.value = " " + 14 + "   ";
        window.document.Calculator.B15.value = " " + 15 + "   ";
        window.document.Calculator.B16.value = " " + 16 + "   ";
        window.document.Calculator.B17.value = " " + 17 + "   ";
        window.document.Calculator.B18.value = " " + 18 + "   ";
        window.document.Calculator.B19.value = " " + 19 + "   ";
        window.document.Calculator.B20.value = " " + 20 + "   ";
      }
 

      function checkResultMath(Zeichen) {
        var erg=0;
        var x=0;
        erg=eval(window.document.Calculator.question.value);

        if(eval(Zeichen)==erg) {
          // Correct
          logData(g_id, g_group, new Date().getTime() + "," + g_taskType + "," + erg + "," + Zeichen + "," + "0");
        } else {
          // Wrong
          logData(g_id, g_group, new Date().getTime() + "," + g_taskType + "," + erg + "," + Zeichen + "," + "1");
        }

        aufgabe();   
      }
      
      function checkResultWord(Zeichen, selectedWord, currentIndex) {
        // Remove the character
        document.getElementById(currentIndex).style.display = "none";
        g_numSelectedChars += 1;
        g_currentWordSelection += Zeichen;
        if (g_currentWordSelection.length < selectedWord.length) {
          // Stub if we need to log what kind of chars were typed
        } else if (g_currentWordSelection.length === selectedWord.length) {
          if (g_currentWordSelection === selectedWord) { 
            // Correct
            logData(g_id, g_group, new Date().getTime() + "," + g_taskType + "," + selectedWord + "," + g_currentWordSelection + "," + "0");
          } else {
            // Wrong
            logData(g_id, g_group, new Date().getTime() + "," + g_taskType + "," + selectedWord + "," + g_currentWordSelection + "," + "1");
          }
          document.getElementById("progressBar").value = 0;
          setInterval(downloadTimer, 1000);
          timeleft = 45;
          aufgabe();
        }
      }


      function submitResult() { 
        if (g_currentWordSelection === g_selectedWord) {
          logData(g_id, g_group, new Date().getTime() + "," + g_taskType + "," + g_selectedWord + "," + g_currentWordSelection + "," + "0");
        }
        if (g_currentWordSelection != g_selectedWord) {
          logData(g_id, g_group, new Date().getTime() + "," + g_taskType + "," + g_selectedWord + "," + g_currentWordSelection + "," + "1")
        }
        
        document.getElementById("progressBar").value = 0;
        setInterval(downloadTimer, 1000);
        timeleft = 45;
        aufgabe();
      }

      function createLogFile(filename) {
        var data = new FormData();
        data.append("filename" , filename);
        var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
        xhr.open( 'post', 'create-log-file.php', true );
        xhr.send(data);
      }

      function logData(id, group, logmessage) {
        var data = new FormData();
        data.append("filename" , id + "-" + group);
        data.append("data", logmessage);
        var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
        xhr.open( 'post', 'log-data.php', true );
        xhr.send(data);
      }

      function startup()
      {
        
        document.getElementById("FormCalculator").style.display = "none";
        document.getElementById("FormWordRiddle").style.display = "none";

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const group = urlParams.get('group');
        const id = urlParams.get('id');

        g_group = group;
        g_id = id;
        createLogFile(id + "-" + group);


        if (g_group === "nothing") {
                document.getElementById("groupExplanation").innerHTML = "You are in the following group: <br>No adaption of task difficulty";
            }

            if (g_group === "performance") {
                document.getElementById("groupExplanation").innerHTML = "You are in the following group: <br>Adaption of task difficulty according to task performance";
            }

            if (g_group === "camera") {
                document.getElementById("groupExplanation").innerHTML = "You are in the following group: <br>Adjustment of task difficulty by AI-based analysis of the camera image";
            }

        

        if (group === "camera") {
          if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
              video.srcObject = stream;
              video.play();
            });
            document.getElementById("conditionSelector").style.display = "inline";
          }
        }
        parseWords();
        drawMathTasks()
      }

      function toggleVideo() {

        var displayStyle = document.getElementById("video").style.display;

        if (displayStyle === "inline") {
          document.getElementById("video").style.display = "none";
          document.getElementById("buttonVideoToggle").innerHTML = "Show camera picture";
        }

        if (displayStyle === "none") {
          document.getElementById("video").style.display = "inline";
          document.getElementById("buttonVideoToggle").innerHTML = "Hide camera picture";
        }
      }

      var timeleft = 45;
      var downloadTimer = setInterval(function(){
        if(timeleft < 0){
          document.getElementById("progressBar").value = 0;
          submitResult();
          setInterval(downloadTimer, 1000);
          timeleft = 45;
        }
        document.getElementById("progressBar").value = 45 - timeleft;
        document.getElementById("timeleft").innerHTML = timeleft;
        timeleft -= 1;
      }, 1000);

     </script>
     <h4 style="text-align: center" id="groupExplanation"></h4>
  </head>
  
  
  <body bgcolor=#FFFFFF text=#000000 link=#0000CC vlink=#000099 alink=#0000FF onload="startup()">

  <div style="text-align: center">
  <p id="timeleft" style="font-size: 20px"></p>
    <progress value="0" max="45" id="progressBar"></progress>
  </div>
    <!-- Calculator -->
    <form name="Calculator" id="FormCalculator" >
      <table>
        <tr>
            <td>&nbsp; &nbsp;</td>
        </tr>
        <tr>  
            <td>
            </td>
            <td>
            </td>
            <td>
                <input  name="aLine" id="messageLine" size=20 maxlength=20 value="" STYLE="font-family: Verdana; font-weight: bold; font-size: 16px;visibility: hidden; background-color: transparent; border: 0px solid;" readonly>
            </td>
        </tr>
      </table>

      <table border=10 cellpadding=10 style="border:1px solid black;margin-left:auto;margin-right:auto;">
        <tr>
          <td bgcolor=#C0C0C0> <input name="question" size=50 maxlength=50 value="" style="color: #FFFFFF; 
            font-family: Verdana; font-weight: bold; font-size: 20px; background-color: #72A4D2; text-align:center;" readonly></td> 
        </tr>
        <tr>
          <td>
            <table>
              <tr>
                <td width=50><input name=B1 type=button value="   1   " onClick="checkResultMath('1')"></td>   
                <td width=50><input name=B2 type=button value="   2   " onClick="checkResultMath('2')"></td>
                <td width=50><input name=B3 type=button value="   3   " onClick="checkResultMath('3')"></td>
                <td width=50><input name=B4 type=button value="   4   " onClick="checkResultMath('4')"></td>
                <td width=50><input name=B5 type=button value="   5   " onClick="checkResultMath('5')"></td>
              </tr>
              <tr>
                <td width=50><input name=B6 type=button value="   6   " onClick="checkResultMath('6')"></td>   
                <td width=50><input name=B7 type=button value="   7   " onClick="checkResultMath('7')"></td>
                <td width=50><input name=B8 type=button value="   8   " onClick="checkResultMath('8')"></td>
                <td width=50><input name=B9 type=button value="   9   " onClick="checkResultMath('9')"></td>
                <td width=50><input name=B10 type=button value="  10   " onClick="checkResultMath('10')"></td>
              </tr>
              <tr>
                <td width=50><input name=B11 type=button value="  11   " onClick="checkResultMath('11')"></td>   
                <td width=50><input name=B12 type=button value="  12   " onClick="checkResultMath('12')"></td>
                <td width=50><input name=B13 type=button value="  13   " onClick="checkResultMath('13')"></td>
                <td width=50><input name=B14 type=button value="  14   " onClick="checkResultMath('14')"></td>
                <td width=50><input name=B15 type=button value="  15   " onClick="checkResultMath('15')"></td>
              </tr>
              <tr>
                <td width=50><input name=B16 type=button value="  16   " onClick="checkResultMath('16')"></td>   
                <td width=50><input name=B17 type=button value="  17   " onClick="checkResultMath('17')"></td>
                <td width=50><input name=B18 type=button value="  18   " onClick="checkResultMath('18')"></td>
                <td width=50><input name=B19 type=button value="  19   " onClick="checkResultMath('19')"></td>
                <td width=50><input name=B20 type=button value="  20   " onClick="checkResultMath('20')"></td>
              </tr>
            </table>
      </table>
    </form>

    <!-- Word Riddle -->
    <form name="WordRiddle" id="FormWordRiddle">
      <table>
        <tr>
          <td>&nbsp; &nbsp;</td>
        </tr>
        <tr>  
          <td>
          </td>
          <td>
          </td>
          <td>
            <input  name="aLine" id="messageLine" size=50 maxlength=50 value="" STYLE="font-family: Verdana; font-weight: bold; font-size: 16px;visibility: hidden; background-color: transparent; border: 0px solid;" readonly>
          </td>
        </tr>
      </table>

      <table border=10 cellpadding=10 style="border:1px solid black;margin-left:auto;margin-right:auto; text-align:center;">
        <tr>
          <td bgcolor=#C0C0C0> <input name="question" size=50 maxlength=20 value="" style="color: #FFFFFF; 
            font-family: Verdana; font-weight: bold; font-size: 20px; background-color: #72A4D2; text-align:center;" readonly></td> 
        </tr>

        <tr>
          <td>
          <table>
            <tr id="wordRiddleInputField" style="text-align: center;">
            </tr>
          </table>
      </table>
    </form>
    

    <div id="conditionSelector" style="display: none">
      <div id="loading" style="display: inline">
        <br/><br/>
        <div class="loader">
        </div>
        <div id="analysis" style="text-align: center">
          Analysis<br><br>
          <button onclick="toggleVideo()" id="buttonVideoToggle" class="btn btn-default">Show camera picture</button>
          <br><br>
          <video id="video" width="640" height="480" autoplay style="display: none"></video>
        </div>
      </div>
    </div>
  </body>

</html>

 
