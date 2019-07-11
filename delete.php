<?php//including the database connection file
include("config.php");
 
//getting id of the data from url
$id = intval($_GET['id']);
 echo $id;
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");
 
if ($result){
    header("Location:index.php");
}
else{
    header("Location:edit.php");
}
//redirecting to the display page (index.php in our case)
?>