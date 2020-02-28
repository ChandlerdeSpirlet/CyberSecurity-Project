<?php
    if ($_GET["uname"] != 'adminUser'){
        header("Location: index.php");
        die();
    }
    if ($_GET["uname"] == 'adminUser'){
        if ($_GET["pass"] != 'adminPass'){
            header("Location: index.php");
            die();
        }
    }
    $conn = pg_connect(getenv("DATABASE_URL"));
    if (!$conn){
        die("Connection failed");
    }
    $post_query = 'select * from checkcreds($1, $2)';
    $result = pg_query_params($conn, $post_query, [$_GET["uname"], $_GET["pass"]]);
    $boolRes = $row[0];
    if ($result != TRUE){
        header("Location: index.php");
        die();
    }
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
        p, h3, h4, h2 {
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
    <h2>Welcome, <?php echo $_GET["uname"]; ?>, the password you entered was: <?php echo $_GET["pass"]; ?></h2><br>
    <p style="font-style: italic;">Yes, I know this isn't secure, but I'm showing off my PHP skills</p>
    <p style="font-size: 14pt; "><i>Welcome to the Coding Discussion Board, where you can discuss anything CS related!</i></p>
    </div>
    <div>
        <?php
            $sql = 'select * from comment';
            $result = pg_query($conn, $sql);
            if (pg_numrows($result) > 0){
                while ($row = pg_fetch_row($result)){
                    "<table id=\"tableOfContent\">
                        <tr>
                            <th>Username</th>
                            <th>Comment</th>
                        </tr>
                        <tr>
                            <td>".$row["userID"]."</td>
                            <td>".$row["user_comment"]."</td>
                        </tr>
                    </table>";
                }
            } else {
                echo "<p> Nothing to see yet!</p>";
            }
            pg_close($conn);
        ?>
    </div>
        <br>
        <form name="Add Content" onsubmit="return addToTable()">
            <label>Enter your username: </label><input type="text" name="username"></input><br>
            <label>Enter your content: </label><input type="text" name="content"></input><br>
            <input type="submit" name="Submit" value="Submit"></input>
        </form>
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
            alert("Not a great password Bruv");
        }
    }
    function addToTable(){
        var table = document.getElementById("tableOfContent");
        var x = document.forms["Add Content"]["username"].value;
        var y = document.forms["Add Content"]["content"].value;
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = x;
        cell2.innerHTML = y;
    }
</script>