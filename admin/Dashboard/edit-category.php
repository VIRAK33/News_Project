<?php include('header.php') ?>
<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>
<?php
include 'lib/database.php';
$id = $_GET['category_id'];
$success = "";
$error = "";

//Get product to edit
$user = run_query("select * from tb_category where category_id=$id");
$pro = mysqli_fetch_assoc($user);

if (isset($_POST['name'])) {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    
    $update = "update tb_category set name = 
            '{$name}' 
            where category_id =$pid";

    $i = run_non_query($update);
    if ($i > 0) {
        $success = "Data has been saved!";
        $user = run_query("select * from tb_category where category_id=$pid");
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
                <a href="categories.php" class="btn btn-light btn-block">
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
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                        <input type="hidden" name="pid" value="<?php echo $id;?>">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" value="<?php echo $pro['name'] ?>" name="name">
                            </div>
                            
                            <div class="row">
                            <div class="form-group col-sm-6">
                                <button class="btn btn-success btn-block">
                                    <i class="fas fa-check"></i> Save Changes
                                </button>
                            </div>
                            <div class="form-group col-sm-6">
                                <a href="delete-category.php<?php echo"?category_id=".$pro['category_id']; ?>" class="btn btn-danger btn-block">
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