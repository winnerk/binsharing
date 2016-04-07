<?php
/**
 * Created by PhpStorm.
 * User: christinemo91
 * Date: 3/21/16
 * Time: 4:46 PM
 */
require('connection.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['email'])){
    $username = $_POST['email'];
    $password = $_POST['password'];
    $username = stripslashes($username);
    $username = mysql_real_escape_string($username);
    $password = stripslashes($password);
    $password = mysql_real_escape_string($password);
    //Checking is user existing in the database or not
    $query = "SELECT * FROM `user` WHERE email='$username' and passwd='".md5($password)."'";
    $result = mysql_query($query) or die(mysql_error());
    $rows = mysql_num_rows($result);
    if($rows==1){
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect user to index.php
    }else{
        echo "<div class='form'><h3>E-mail/password is incorrect.</h3></div>";
    }
}
?>