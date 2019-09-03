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
  $description = $_POST['editor1'];
  //$image = $_POST['image'];
  //echo "TITLE:".$title."<br>Cate_id:".$category_id."<br> User_id:".$user_id."<br> s_description:".$s_description."<br> description:".$description; 
  $insert_news = "insert into tb_news(user_id,category_id,title,short_description,description) values(
        '{$user_id}','{$category_id}','{$title}', '{$s_description}','{$description}'
        )";

        $i = insert_get_id($insert_news);
        if($i>0){
            $success = "Data has been saved!";
            //upload photo
            $file_name = $_FILES['photo']['name'];
            $arr = explode('.',$file_name);
            $ext = $arr[count($arr)-1];
            $n_name = md5($i).".".$ext;
            $t_name = $_FILES['photo']['tmp_name'];
            move_uploaded_file($t_name,"photos/" .$n_name);
            run_non_query("update tb_news set feartur_image ='{$n_name}' where news_id = $i;");
        }
        else{
            $err = "Error";
        }
  header('location:index.php');
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

        <form method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-12">
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
                <label for="image" class="col-sm-4">Image</label>
                <div class="col-sm-8 row">
                    <input type="file" class="form-control" id="photo" 
                    name="photo" accept="image/x-png,image/gif,image/jpeg">
                    <!-- <label for="image" class="custom-file-label">Choose File</label>    -->
                    <br>
                    
                </div>
                </div>
              </div>

            </div>
          </div>
          <div class="col-sm-4">Description</div><br>
                <textarea name="editor1" class="form-control col-sm-12 offset-8"></textarea>
           
          
          <div class="form-group row">
                <label class="col-sm-12 offset-10"></label>
                <div class="col-sm-10 offset-10">
                  <button class="btn btn-primary">Creat Post</button>
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

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>


<script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());

    CKEDITOR.replace('editor1');
</script>
<!-- insert image -->
<script>
        function preview(e){
            // var img = document.getElementById("img");
            var img = document.getElementById("img");
            // img.src = URL.createObjectURL(e.target.file[0]);
            img.src = URL.createObjectURL(e.target.file[0]);
        }
        
    </script>
<?php include('foot.php'); ?>