<?php
require_once("dbconnect.php");
session_start();
if(isset($_POST['signup'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname." ".$lname;
    $email = $_POST['email'];
    $password = $_POST["password"];

    $checksql = "SELECT * FROM `users` WHERE `email`='$email'";
    if($result = $conn->query($checksql)){
        if(mysqli_num_rows($result)>0){
            // user already exist
            header('location: ../admin/register.html?msg="User with this email already exist"');
        }
        else{
            // work
            $sql = "INSERT INTO `users`(`id`, `name`, `email`, `password`) VALUES(DEFAULT, '$name', '$email', '$password')";
            if($conn->query($sql)){
                header('location: ../admin/login.html?msg="You have been registered please login to continue"');
            }
            else{
                echo("Error: ".$conn->error);
            }
        }
    }
    else{
        echo("Error: ".$conn->error);
    }
}
if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $checkuser = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
    $result = $conn->query($checkuser);
    if(mysqli_num_rows($result) > 0){
        $row = $result->fetch_assoc();
        $_SESSION["login_user"] = $row["name"];
        $_SESSION["login_id"] = $row["id"];
        // echo $_SESSION["login_user"];
        header("Location: ../admin/index.php");
    }
    else{
        header('location: ../admin/login.html?msg="No user found with these credintials"');
    }
}
if(isset($_GET["logout"])){
    session_destroy();
    header("location: ../admin/login.html");
}
?>