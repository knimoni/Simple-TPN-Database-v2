<?php
    // include database connection file
    include_once("config.php");
    // Get id from URL to delete that data
    $id = $_GET['id'];
    // Delete data row from table based on given id
    $result = mysqli_query($link, "UPDATE observer SET is_delete=1 WHERE observer_id=$id");
    // After delete redirect to Home, so that latest user list will be displayed.
    header("Location:index.php");
?>
