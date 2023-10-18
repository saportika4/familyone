<?php

include 'db.php';

if(isset($_POST['delete_id'])) {
    $did=$_POST['delete_id'];

    $sql2 = "SELECT * FROM events WHERE id=$did";
    $res2 = mysqli_query($conn,  $sql2);

    $row = mysqli_fetch_assoc($res2);

    $image = $row['img_url'];

    $sql="DELETE FROM events WHERE id=$did";
    $result=mysqli_query($conn,$sql);

    if($result) {

        if(file_exists("assets/uploads/events/".$image)) {
            unlink("assets/uploads/events/".$image);

            echo 200;

            // header("location: gallery-Images.php");
        }
        else {
            echo 500;
        }

    } else {
        die(mysqli_error($conn));
    }
}