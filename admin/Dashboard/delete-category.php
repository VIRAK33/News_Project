<?php
    include "lib/database.php";
?>
<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>
<?php
    
    $id = $_GET['category_id'];
    run_non_query("delete from tb_category where category_id={$id}");
    header('location: categories.php');
?>