<?php
require_once("dbconnect.php");
session_start();
if(isset($_POST['addcat'])){
    $category = $_POST["category"];
    $sql = "INSERT INTO `categories`(`id`, `name`) VALUES(DEFAULT, '$category')";
    if($conn->query($sql)){
        header('location: ../admin/index.php?msg="Category added successfully"');
    }
    else{
        header('location: ../admin/index.php?msg="Cannot add category now"');
    }

}
if(isset($_POST["addmovie"])){
    $title = $_POST['movie'];
    $rdate = $_POST['rdate'];
    $genres = $_POST['genres'];
    $ratings = $_POST['ratings'];

    $userid = $_SESSION["login_id"];

    $name = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];

    // print_r (@getimagesize($_FILES['image']['tmp_name']));
    $image = (@getimagesize($_FILES['image']['tmp_name']));
    if($image == false){
        header('location: ../admin/index.php?msg="Please select a valid image format"');
    }else{
        if($_FILES['image']['size'] < 100000){
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $newname = "images/".round(microtime(true)).$userid.".".$extension;
            if(move_uploaded_file($tmpname, '../'.$newname)){
                $sql = "INSERT INTO `movies`(`id`,`title`, `date`, `cat_id`,`ratings` ,`image`) VALUES(DEFAULT, '$title', '$rdate', $genres, $ratings, '$newname')";
                if($conn->query($sql)){
                    header('location: ../admin/movies.php?msg="Movie added successfully"');
                }
                else{
                    echo "Error in connection: ".$conn->error;
                }
            }
            else{
                echo "Error in connection: ".$conn->error;
                // header('location: ../admin/movies.php?msg="File Cannot be uploaded"');
            }

            }
            else{
                header('location: ../admin/movies.php?msg="File size is too large"');
            }
    }

}

if(isset($_POST["updatecat"])){
    $id = $_POST['cat_id'];
    $cat = $_POST['category'];

    $editsql = "UPDATE `categories` SET `name`='$cat' WHERE `id`=$id";
    if($conn->query($editsql)){
        header("location: ../admin/index.php?msg=Category Updated");
    }

}

if(isset($_POST["updatemovie"])){
    $id = $_POST['id'];
    $title = $_POST['movie'];
    $rdate = $_POST['rdate'];
    $genres = $_POST['genres'];
    $ratings = $_POST['ratings'];

    $userid = $_SESSION["login_id"];

    $name = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];

    // print_r (@getimagesize($_FILES['image']['tmp_name']));
    $image = (@getimagesize($_FILES['image']['tmp_name']));
    if($image == false){
        header('location: ../admin/index.php?msg="Please select a valid image format"');
    }else{
        if($_FILES['image']['size'] < 100000){
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $newname = "images/".round(microtime(true)).$userid.".".$extension;
            if(move_uploaded_file($tmpname, '../'.$newname)){
                $sql = "UPDATE `movies` SET `title`='$title', `date`='$rdate', `cat_id`=$genres,`ratings`=$ratings ,`image`='$newname' WHERE `id`=$id";
                if($conn->query($sql)){
                    header('location: ../admin/movies.php?msg="Movie updated successfully"');
                }
                else{
                    echo "Error in connection: ".$conn->error;
                }
            }
            else{
                echo "Error in connection: ".$conn->error;
                // header('location: ../admin/movies.php?msg="File Cannot be uploaded"');
            }

            }
            else{
                header('location: ../admin/movies.php?msg="File size is too large"');
            }
    }

}


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delsql = "DELETE FROM `movies` WHERE `id`=$id";
    if($conn->query($delsql)){
        header("location: ../admin/movies.php?msg=Movie deleted");
    }
}
?>