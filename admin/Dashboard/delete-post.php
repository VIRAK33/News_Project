<?php
    include "lib/database.php";
?>
<?php
    session_start();
    if($_SESSION['news_id'] == null){
        header('location:login.php');
    }
?>
<?php
    
    $id = $_GET['news_id'];
    run_non_query("delete from tb_news where news_id={$id}");
    header('location: posts.php');
?>