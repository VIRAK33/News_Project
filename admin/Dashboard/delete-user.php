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
    
    $id = $_GET['user_id'];
    run_non_query("delete from tb_user where user_id={$id}");
    header('location: users.php');
?>