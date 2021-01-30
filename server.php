<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'demo');
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $mobilenumber = mysqli_real_escape_string($db, $_POST['mobilenumber']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $hobbies = mysqli_real_escape_string($db, $_POST['hobbies']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($mobilenumber)) { array_push($errors, "mobilenumber is required"); }
  if (empty($gender)) { array_push($errors, "gender is required"); }
  if (empty($hobbies)) { array_push($errors, "hobbies is required"); }
  if($gender != "male" || $gender != "female") { array_push($errors, "Invalid gender type"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database
  	$query = "INSERT INTO users (username, email, password, name, mobilenumber, gender, hobbies) 
  			  VALUES(?, ?, ?, ?, ?, ?, ?)";
	if($stmt = mysqli_prepare($db, $query) {
		mysqli_stmt_bind_param($stmt, "sssssss", $username, $email, $password, $name, $mobilenumber, $gender, $hobbies);
		mysqli_stmt_execute($stmt);
	}
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
        mysqli_stmt_close($stmt);
	mysqli_close($db);
  }
}
// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
	$hashedpass = "SELECT 'password' FROM `users` WHERE username=?";
	if($stmt = mysqli_prepare($db, $hashedpass) {
		mysqli_stmt_bind_param($stmt, "s", $username;
		mysqli_stmt_execute($stmt);
	}
        $password = password_verify($password, $hashedpass);
        $query = "SELECT * FROM users WHERE username=? AND password=?";
        if($stmt = mysqli_prepare($db, $query) {
		mysqli_stmt_bind_param($stmt, "ss", $username, $password);
		mysqli_stmt_execute($stmt);
	}
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        mysqli_stmt_close($stmt);
	mysqli_close($db);
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }

  
  ?>
