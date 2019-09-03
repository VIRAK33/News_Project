<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>

<?php include 'lib/database.php';
$success = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="stylesheet" rel="all.css">
</head>
<body>
    <div class="container">
        <h1>User List</h1>
        <hr>
        <p>
            <a href="create-user.php" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Create
            </a>
            <a href="logout.php" class="btn btn-success btn-sm float-right"> <i class="fas fa-sign-out-alt"></i> Log Out</a>
        </p>
        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr>
                    <th>User_ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $tb_news = run_query("select * from tb_user"); ?>
                <?php foreach($tb_news as $p): ?>
                    <tr>
                        <td><?php echo $p['user_id']; ?></td>
                        <td><?php echo $p['username']; ?></td>
                        <td><?php echo $p['email']; ?></td>
                        <td><?php echo $p['password']; ?></td>
                        <td>
                            <a href="delete-user.php?user_id=<?php echo $p['user_id'];?>" 
                                class='text-danger' title="Delete" 
                                onclick="return confirm('You want to delete?')">
                                <i class="fa fa-trash"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="edit-user.php<?php echo"?user_id=".$p['user_id']; ?>" class="text-success" title="Edit" >
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                
            </tbody>
        </table>
<!-- //_Table-News__________________________________________________________________________________________________________ -->
        <h1>News List</h1>
        <hr>
        <p>
            <a href="create_news.php" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Create
            </a>
        </p>

        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr>
                    <th>Create By</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Short Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $tb_news = run_query("select news_id,username, name, title,
                                                 short_description, description, 
                                                 feartur_image, create_at from 
                                                 tb_user u join tb_category c join tb_news n
                                                    on u.user_id = n.user_id and 
                                                    c.category_id = n.category_id;"); ?>
                <?php foreach($tb_news as $p): ?>
                    <tr>
                        <td><?php echo $p['username']; ?></td>
                        <td><?php echo $p['name']; ?></td>
                        <td><?php echo $p['title']; ?></td>
                        <td><?php echo $p['short_description']; ?></td>
                        <td><?php echo $p['description']; ?></td>
                        <td> <img src="photos/<?php echo $p['feartur_image']?>" alt=""> </td>
                        <td><?php echo $p['create_at']; ?></td>
                        <td>
                            <a href="delete-news.php?news_id=<?php echo $p['news_id'];?>" 
                                class='text-danger' title="Delete" 
                                onclick="return confirm('You want to delete?')">
                                <i class="fa fa-trash"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="edit-news.php<?php echo"?news_id=".$p['news_id']; ?>" class="text-success" title="Edit" >
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                
            </tbody>
        </table>


    </div>
    
</body>
</html>