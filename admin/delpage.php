<?php include "inc/header.php";

if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL){
    header('Location: index.php');
}else{
    $id = $_GET['delpage'];
    $query = "DELETE FROM pages WHERE id = '$id'";
    $delete = $db->delete($query);
    if ($delete){

        header('Location: index.php');
        echo "<script>alert('Page deleted successfully');</script>";
    }else{
        header('Location: index.php');
    }
}