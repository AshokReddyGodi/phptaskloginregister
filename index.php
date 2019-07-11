<?php
//including the database connection file
include_once("config.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id ASC"); // using mysqli_query instead
?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>
     <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td>UserName</td>
            <td>Email</td>
            <td>Name</td>
            <td>Mobile Number</td>
            <td>Gender</td>
            <td>Hobbies</td>
        </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['username']."</td>";
            echo "<td>".$res['email']."</td>";
            echo "<td>".$res['name']."</td>";   
            echo "<td>".$res['mobilenumber']."</td>";  
            echo "<td>".$res['gender']."</td>"; 
            echo "<td>".$res['hobbies']."</td>"; 
            echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
        }
        ?>
    </table>
</body>
</html>