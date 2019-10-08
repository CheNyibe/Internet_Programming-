<?php

session_start();

processPageRequest();

function authenticateUser($username, $password){
    $fp = fopen('data/credentials.db', 'r');
    clearstatcache(); // IMPORTANT
   if (filesize('data/credentials.db') == 0) {
       $credentials = [];
       fclose($fp);
   }else {
       $credentials = str_getcsv(fread($fp, filesize('data/credentials.db')));
       fclose($fp);
   }

   
   if(in_array(strtolower($username), $credentials, TRUE) and in_array($password, $credentials)){
        session_start();
       $_SESSION["display_name"] = $credentials[2];
       $_SESSION["email"] = $credentials[3];
       header('Location: index.php'); //Redirect the browser to the index.php page
       die();
   
   }else {
         
        displayLoginForm("The username or password you entered is invalid.");
   }
}  

function displayLoginForm($message=""){
    require_once('logon.php');
} 
function processPageRequest(){
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);

    if(count($_POST) != 0){
        authenticateUser($_POST["username"], $_POST["password"]);
    } else {
        displayLoginForm();
    }
}

if(isset($_POST['submit']) && !empty($_POST['submit'])){
    $password = $_POST['password'];
    $username = $_POST['username'];

    authenticateUser($username, $password);
    
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">

</head>
<body>
    <!-- <form action="/action_page.php">
        <label for="fname">Username</label>
        <input type="email" required id="fname" name="firstname" placeholder="Please insert your email">

        <label for="lname">Password</label>
        <input type="password" required id="lname" name="lastname" placeholder="Your last name..">

        <input type="reset" value="Clear"> <input type="button" value="Login">
        <p><a href="./CreateAccount.html" target="_self">Create Account</a></p>
        <p><a href="http://forgotPassword.html" target="_blank">Forgot Password</a></p>
        <p><a href=".//eportfolio.html" target="_self">E-Portfolio</a><</p>
        <input type="submit" value="Submit">
  </form> -->
   <form action="logon.php" onsubmit="return validateCreateAccountForm();" method="post">
        <table>
        <tr>
            <td><h1><strong>myMovie Xpress!</strong></h1>
            <p>Please enter a valid username and password</p></td>
        </tr>
        <tr>
        <td>Username<br>
        <input type="text" required name="username">
        <br>
        <br>Password<br>
        <input type="password" required name="password">
        <br>
        <br>
        <input type="reset" value="Clear"> <input type="submit" name='submit' value="Login">
        <br>
        <br>
        <td><a href="./CreateAccount.html" target="_self">Create Account</a><br></td>
        <br>
        <td><a href="http://forgotPassword.html" target="_blank">Forgot Password</a><br></td>
        </td></tr>
        <br>
        <td><a href=".//eportfolio.html" target="_self">E-Portfolio</a></td>
        </table>
        <br> 
    </form> 
</body>
</html>
