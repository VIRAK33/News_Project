<?php include('header.php') ?>

<?php
session_start();
if ($_SESSION['user_id'] == null) {
  header('location:login.php');
}
?>
<?php include "lib/database.php";
$success = '';
?>
<!-- Create Post -->
<?php
if (isset($_POST['title'])) {
  $title = $_POST['title'];
  $category_id = $_POST['category_id'];
  $user_id = $_POST['user_id'];
  $s_description = $_POST['short_description'];
  $description = $_POST['description'];
  $image = $_POST['image'];
  //echo "TITLE:".$title."<br>Cate_id:".$category_id."<br> User_id:".$user_id."<br> s_description:".$s_description."<br> description:".$description; 
  $insert_news = "insert into tb_news(user_id,category_id,title,short_description,description,feartur_image) values(
        '{$user_id}','{$category_id}','{$title}', '{$s_description}','{$description}','{$image}'
        )";

  $i = run_non_query($insert_news);
}
?>
<!-- Create User -->

<?php
if (isset($_POST['password'])) {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $insert = "insert into tb_user(username,email,password) values(
            '{$name}', '{$email}','{$password}'
        )";

  $i = run_non_query($insert);

  $success = "Data has been saved!";
}

?>

<!-- Create Category -->
<?php

if (isset($_POST['category'])) {
  $category = $_POST['category'];

  $insert = "insert into tb_category(name) values(
            '{$category}'
        )";

  $i = run_non_query($insert);

  $success = "Data has been saved!";
}

?>

<!-- HEADER -->
<header id="main-header" class="py-2 bg-primary text-white">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>
          <i class="fas fa-cog"></i> Dashboard</h1>
      </div>
    </div>
  </div>
</header>
<div class="container">
  <?php if ($success) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">

    <?php header('location:index.php'); ?>
    <?php echo $success; ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

  </div>
  <?php } ?>
</div>




<!-- ACTIONS -->
<section id="actions" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal">
          <i class="fas fa-plus"></i> Add Post
        </a>
      </div>
      <div class="col-md-3">
        <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
          <i class="fas fa-plus"></i> Add Category
        </a>
      </div>
      <div class="col-md-3">
        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#addUserModal">
          <i class="fas fa-plus"></i> Add User
        </a>
      </div>
    </div>
  </div>
</section>
<!-- POSTS -->
<?php include('lastest-posts.php') ?>





<!-- MODALS -->

<!-- ADD POST MODAL -->
<div class="modal fade" id="addPostModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add Post</h5>
        <button class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form method="POST">
          <div class="row">
            <div class="col-sm-9">
              <?php if ($success) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php } ?>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="category">Category:</label>
                </div>
                <div class="col-sm-8">
                  <select class="form-control" id="category" name="category_id">
                    <?php $tb_categ =run_query("select * from tb_category;")?>
                    <?php foreach ($tb_categ as $cate) : ?>
                    <option value="<?php echo $cate['category_id'];?>"><?php echo $cate['name']; ?></option>
                    <?php endforeach; ?>
                    

                  </select>
                </div>

              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="user">Create by:</label>
                </div>
                <div class="col-sm-8">
                  <select class="form-control" id="user" name="user_id">
                    <?php $tb_users =run_query("select * from tb_user;")?>
                    <?php foreach ($tb_users as $p) : ?>
                    <option value="<?php echo $p['user_id']; ?>"><?php echo $p['username']; ?></option>
                    <?php endforeach; ?>

                  </select>
                </div>

              </div>
              <div class="form-group row">
                <label for="title" class="col-sm-4">Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name='title' id='title' value='' placeholder="Title">
                </div>
              </div>

              <div class="form-group row">
                <label for="title" class="col-sm-4">Short description</label>
                <div class="col-sm-8">
                  <input type="short_description" class="form-control" name='short_description' id='short_description' value='' placeholder="Short Description">
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-4">Description</label>

                <div class="form-group col-sm-8">
                  <textarea class="form-control" name="description" id="description"></textarea>
                </div>

              </div>
              <div class="form-group row">
                <label for="image" class="col-sm-4">Image</label>
                <div class="col-sm-8">
                  <input type="file" name="image" id="img" accept="image/x-png,image/gif,image/jpeg">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4"></label>
                <div class="col-sm-8">
                  <button class="btn btn-primary btn-sm">Save</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>



    </div>
  </div>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Category</h5>
        <button class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="category">Title</label>
            <input type="text" class="form-control" name="category">
          </div>
          <div class="form-group row">
            <div class="modal-footer col-sm-12">
              <button class="btn btn-success text-light">Create</button>
            </div>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button class="btn btn-success" data-dismiss="modal">Save Changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- ADD USER MODAL -->

<div class="modal fade" id="addUserModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Add User</h5>
        <button class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="username">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <!-- <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input type="password" class="form-control">
          </div> -->
          <div class="form-group row">
            <div class="modal-footer col-sm-12">
              <button class=" btn btn-warning text-light">Create User</button>
            </div>
          </div>
        </form>
      </div>

      <!-- <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal">Save Changes</button>
      </div> -->
    </div>
  </div>
</div>


<?php include('foot.php'); ?>
<?php include('header.php');
      include('lib/database.php');
?>
<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>

<?php
$news_id = $_GET['news_id'];

?>
<?php
    $sql = 'select * from tb_user u join tb_category c join tb_news n
    on u.user_id = n.user_id and c.category_id = n.category_id
    where news_id ='.$news_id;
    $selection = run_query($sql);

?>



  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            Post One</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <form method="POST">
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="index.php" class="btn btn-light btn-block">
            <i class="fas fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
        <div class="col-md-3 ">
          <button class="form-control btn btn-success btn-block">
            <i class="fas fa-check"></i> Save Changes
          </button>
        </div>
        <div class="col-md-3">
          <a href="index.php" class="btn btn-danger btn-block">
            <i class="fas fa-trash"></i> Delete Post
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- DETAILS -->
  <section id="details">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Post</h4>
            </div>
            <div class="card-body">
              <!-- <form method="POST"> -->
                <div class="form-group">
                    
                    <?php foreach ($selection as $news) : ?>
                    <?php $title_news= $news['title']; ?>
                    <?php endforeach; ?>
                  <label for="title">Title</label>
                  <input type="text" class="form-control" value="<?php echo $title_news; ?>">
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <select class="form-control">
                    <!-- <option value="" selected>Web Development</option>
                    <option value="">Tech Gadgets</option>
                    <option value="">Business</option>
                    <option value="">Health & Wellness</option> -->
                    <?php $select_tb_cate = 'select * from tb_category';
                            $cate = run_query($select_tb_cate);?>
                    <?php foreach ($cate as $news) : ?>
                    <option value="<?php echo $news['category_id'];?>"><?php echo $news['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="body">Short Description</label>
                  <textarea name="sdescription" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="image">Upload Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image">
                    <label for="image" class="custom-file-label">Choose File</label>
                  </div>
                  <small class="form-text text-muted">Max Size 3mb</small>
                </div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="editor1" class="form-control">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat culpa nam cumque voluptatum. Possimus recusandae porro architecto officiis illo dignissimos ratione aut officia reprehenderit! Iure cum numquam fugit doloremque quis ullam illo odit, odio voluptates non quisquam laboriosam consectetur quasi perspiciatis! Sapiente minus aperiam nobis molestias autem ut praesentium laudantium?</textarea>
                </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </form>


  <!-- MODALS -->

  <!-- ADD POST MODAL -->
  <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add Post</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control">
                <option value="">Web Development</option>
                <option value="">Tech Gadgets</option>
                <option value="">Business</option>
                <option value="">Health & Wellness</option>
              </select>
            </div>
            <div class="form-group">
              <label for="image">Upload Image</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image">
                <label for="image" class="custom-file-label">Choose File</label>
              </div>
              <small class="form-text text-muted">Max Size 3mb</small>
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <textarea name="editor1" class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ADD CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Category</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ADD USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Add User</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="password2">Confirm Password</label>
              <input type="password" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
  
 include('header.php') ?>
<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>
<?php
include 'lib/database.php';

$id = $_GET['user_id'];
$success = "";
$error = "";

//Get product to edit
$user = run_query("select * from tb_user where user_id=$id");
$pro = mysqli_fetch_assoc($user);

if (isset($_POST['username'])) {
    $pid = $_POST['pid'];
    $name = $_POST['username'];
    $password = $_POST['password'];
    $pass = md5($password);
    $email = $_POST['email'];


    $update = "update tb_user set username = 
            '{$name}',email = '{$email}', 
            password = '{$pass}' 
            where user_id =$pid";

    $i = run_non_query($update);
    if ($i > 0) {
        $success = "Data has been saved!";
        $user = run_query("select * from tb_user where user_id=$pid");
        $pro = mysqli_fetch_assoc($user);
    } else {
        $error = "Fail to save";
    }
}

?>


<!-- HEADER -->
<header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Post One</h1>
            </div>
        </div>
    </div>
</header>

<!-- ACTIONS -->
<section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
        <div class="row">
            <div class=" col-md-3">
                <a href="users.php" class="btn btn-light btn-block">
                    <i class="fas fa-arrow-left"></i> Back To Dashboard
                </a>
            </div>

        </div>
    </div>
</section>

<!-- DETAILS -->
<section id="details">

    <div class="container">
        <div class="row">
            <div class="col">
                <?php if ($success) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Post</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                        <input type="hidden" name="pid" value="<?php echo $id;?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="<?php echo $pro['username'] ?>" name="username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $pro['email'] ?>" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="row">
                            <div class="form-group col-sm-6">
                                <button class="btn btn-success btn-block">
                                    <i class="fas fa-check"></i> Save Changes
                                </button>
                            </div>
                            <div class="form-group col-sm-6">
                                <a href="delete-user.php<?php echo"?user_id=".$pro['user_id']; ?>" class="btn btn-danger btn-block">
                                    <i class="fas fa-trash"></i> Delete Post
                            </a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- MODALS -->

<!-- ADD POST MODAL -->
<div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Post</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control">
                            <option value="">Web Development</option>
                            <option value="">Tech Gadgets</option>
                            <option value="">Business</option>
                            <option value="">Health & Wellness</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image">
                            <label for="image" class="custom-file-label">Choose File</label>
                        </div>
                        <small class="form-text text-muted">Max Size 3mb</small>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="editor1" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Category</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Add User</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>



<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>
<?php
include 'lib/database.php';

$id = $_GET['user_id'];
$success = "";
$error = "";

//Get product to edit
$user = run_query("select * from tb_user where user_id=$id");
$pro = mysqli_fetch_assoc($user);

if (isset($_POST['username'])) {
    $pid = $_POST['pid'];
    $name = $_POST['username'];
    $password = $_POST['password'];
    $pass = md5($password);
    $email = $_POST['email'];


    $update = "update tb_user set username = 
            '{$name}',email = '{$email}', 
            password = '{$pass}' 
            where user_id =$pid";

    $i = run_non_query($update);
    if ($i > 0) {
        $success = "Data has been saved!";
        $user = run_query("select * from tb_user where user_id=$pid");
        $pro = mysqli_fetch_assoc($user);
    } else {
        $error = "Fail to save";
    }
}

?>


<!-- HEADER -->
<header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Post One</h1>
            </div>
        </div>
    </div>
</header>

<!-- ACTIONS -->
<section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
        <div class="row">
            <div class=" col-md-3">
                <a href="users.php" class="btn btn-light btn-block">
                    <i class="fas fa-arrow-left"></i> Back To Dashboard
                </a>
            </div>

        </div>
    </div>
</section>

<!-- DETAILS -->
<section id="details">

    <div class="container">
        <div class="row">
            <div class="col">
                <?php if ($success) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Post</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                        <input type="hidden" name="pid" value="<?php echo $id;?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="<?php echo $pro['username'] ?>" name="username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $pro['email'] ?>" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="row">
                            <div class="form-group col-sm-6">
                                <button class="btn btn-success btn-block">
                                    <i class="fas fa-check"></i> Save Changes
                                </button>
                            </div>
                            <div class="form-group col-sm-6">
                                <a href="delete-user.php<?php echo"?user_id=".$pro['user_id']; ?>" class="btn btn-danger btn-block">
                                    <i class="fas fa-trash"></i> Delete Post
                            </a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- MODALS -->

<!-- ADD POST MODAL -->
<div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Post</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control">
                            <option value="">Web Development</option>
                            <option value="">Tech Gadgets</option>
                            <option value="">Business</option>
                            <option value="">Health & Wellness</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image">
                            <label for="image" class="custom-file-label">Choose File</label>
                        </div>
                        <small class="form-text text-muted">Max Size 3mb</small>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="editor1" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Category</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Add User</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());

    CKEDITOR.replace('editor1');
</script>
<?php include('foot.php') ?>