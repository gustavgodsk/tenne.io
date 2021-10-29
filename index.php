<!DOCTYPE html>
<html translate="no">

<head>
  <link rel="stylesheet" href="styles.css">
  <meta charset="utf-8" lang="en">
  <meta name="google" content="notranslate">
</head>

<body>

  <div class="screen">
    <canvas></canvas>
    <img class="tenne" src="tenne.jpg">
    <img class="beer" src="zillertalpils.png">
    <input type="range" min="0" max="10" value="4" class="slider" id="myRange" onclick="this.blur()" step="0.1">
    <div class="score">
    <div class="scorediv">
    <p>Pils drukket:</p><p id="scoreP">0</p>
    </div>  
    </div>
  </div>

<?php

include "script.php";

?>


</body>
</html>