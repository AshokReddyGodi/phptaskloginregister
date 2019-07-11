<?php
// including the database connection file
include_once("config.php");
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $username=$_POST['username'];
    $email=$_POST['email'];
    $name=$_POST['name']; 
    $mobilenumber=$_POST['mobilenumber'];    
    $gender=$_POST['gender']; 
    $hobbies=$_POST['hobbies']; 

    
    // checking empty fields
    if(empty($username) || empty($email) || empty($name) || empty($mobilenumber) || empty($gender) || empty($hobbies)) {            
        if(empty($username)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>email field is empty.</font><br/>";
        }
        
        if(empty($name)) {
            echo "<font color='red'>name field is empty.</font><br/>";
        }    
        if(empty($mobilenumber)) {
            echo "<font color='red'>mobilenumber field is empty.</font><br/>";
        }     
        if(empty($gender)) {
            echo "<font color='red'>gender field is empty.</font><br/>";
        } 
        if(empty($hobbies)) {
            echo "<font color='red'>hobbies field is empty.</font><br/>";
        } 
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE users SET username='$username',email='$email',name='$name',mobilenumber='$mobilenumber',gender='$gender',hobbies='$hobbies' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $username = $res['username'];
    $email = $res['email'];
    $name = $res['name'];
    $mobilenumber = $res['mobilenumber'];
    $gender = $res['gender'];
    $hobbies = $res['hobbies'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $username;?>"></td>
            </tr>
            <tr> 
                <td>Email</td>
                <td><input type="email" name="email" value="<?php echo $email;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>