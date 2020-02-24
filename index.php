<?php
  session_start();
  $conn = pg_connect(getenv("DATABASE_URL"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coding Discussion Board</title>
    <style>
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td {
        border: 1px solid lightblue;
        text-align: center;
        padding: 8px;
        color: black;
      }
      
      tr:nth-child(even) {
        background-color: darkgray;
      }
      tr:nth-child(odd) {
        background-color: lightgrey;;
      }

      h1 {
        color: blue;
        text-align: center;
      }
      body {
        background-color: black;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
      }
      th {
        border: 1px solid lightblue;
        text-align: center;
        padding: 8px;
        color: blue;
      }
      p, h3, h4 {
        color: white;
      }
      input[type=text], select {
        width: 25%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 3px solid blue;
        border-radius: 4px;
        box-sizing: border-box;
      }
      input[type=password], select {
        width: 25%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 3px solid blue;
        border-radius: 4px;
        box-sizing: border-box;
      }
      input[type=submit] {
        width: 15%;
        background-color: blue;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type=submit]:hover {
        background-color:lightblue;
      }
      label {
        color: white;
      }
      </style>
</head>

<body>
  <div>
  <h1>Coding Discussion Board</h1>
    <p style="font-size: 14pt; "><i>Welcome to the Coding Discussion Board, where you can discuss anything CS related!</i></p>
  </div>

  <div>
    <h4>Don't forget to login so we know who you are.</h4>
    <form name="loginForm" onsubmit="return validateForm()" action="homepage.php" method="get">
      <label>Username: </label> <input type="text" name="uname"></input><br>
      <label>Password: </label> <input type="password" name="pass"></input><br>
      <input type="submit" name="Submit" value="Submit"></input>
    </form>
  </div>

  <div>
    <div>
      <h1 style="color: blue;">Unmodderated Content</h1>
      <br>
      <table id="tableOfContent">
        <tr>
          <th>Username</th>
          <th>Discussions</th>
        </tr>
        <tr>
          <td>H4CK3R M4N</td>
          <td>Everyone knows that DOS was the best... and still is. #IOnlyUseFloppyDisks #UnHackable</td>
        </tr>
        <tr>
          <td>DAEMON HUNTER</td>
          <td>Hey guys, new to computing, do I need drivers for my drivers?</td>
        </tr>
        <tr>
          <td>Linux is for Winners</td>
          <td>I think that everyone should use Linux since it's the best. #FACTS</td>
        </tr>
      </table>
</body>
</html>
<script>
  function validateForm() {
    var x = document.forms["loginForm"]["uname"].value;
    if (x == "") {
      alert("Username cannot be blank.");
      return false;
    }
    var y = document.forms["loginForm"]["pass"].value;
    if (y == "") {
      alert("Password cannot be blank.");
    }
    if (y == "password"){
      alert("Not a great password, Bruv!");
    }
  }
</script>