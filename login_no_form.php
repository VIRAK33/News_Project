<?php
// session_start();
include 'admin/User_table/lib/database.php';
$sms = "";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = run_query("select * from tb_user
                        where username ='{$username}'");
    $user = mysqli_fetch_assoc($user);
    if ($username != $user['username']) {
        $sms = "Invalid Username or Password!";
    } else {
        if ($user['password'] != md5($password)) {
            $sms = "Invalid Username or Password!";
        } else {
            $_SESSION['user_id'] = $user['user_id'];
            header('location:admin/User_table/User_table.php');
            // echo '<a href="admin/User_table/User_table.php" target="_blank" rel="noopener noreferrer"></a>';
        }
    }
}
?>