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

if (isset($_POST['sdescription'])) {
    $pid = $_POST['pid'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $s_description = $_POST['sdescription'];
    $description = $_POST['editor1'];


    $update = "update tb_news set title = 
            '{$title}',category_id = '{$category}', 
            description = '{$description}' 
            where news_id =$pid";

            $i = insert_get_id($update);
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
    //echo "pid:".$pid."<br>title:".$title."<br> category :".$category."<br>Short Desc:".$s_description."<br>Description:".$description;
    
}


?>
<?php
    $sql = 'select * from tb_user u join tb_category c join tb_news n
    on u.user_id = n.user_id and c.category_id = n.category_id
    where news_id ='.$news_id;
    $selection = run_query($sql);
?>
<?php foreach ($selection as $news_title) : ?>
<?php $news_id = $news_title['news_id'];?>
<?php endforeach; ?>


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
  <form method="POST" enctype="multipart/form-data">
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
          <a href="delete-post.php<?php echo"?news_id=".$news_id; ?>" class="btn btn-danger btn-block">
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
              
              <input type="hidden" name="pid" value="<?php echo $news_id;?>">
                <div class="form-group">
                    
                <?php
                $sql_title = 'select title from tb_user u join tb_category c join tb_news n
                on u.user_id = n.user_id and c.category_id = n.category_id
                where news_id ='.$news_id;
                $select_title = run_query($sql_title);
                $title = '';
                ?>
                <?php foreach ($select_title as $news_title) : ?>
                <?php $title = $news_title['title'];?>
                <?php endforeach; ?>
                  <label for="title">Title</label>
                  <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <select class="form-control" name="category">
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
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="image">
                    <label for="image" class="custom-file-label">Choose File</label>
                  </div>
                  
                  <div class="col-sm-2" style="padding-left:0px;">
                  <?php foreach ($selection as $img) : ?>
                  <img src="photos/<?php  echo $img['feartur_image']?>" accept="image/x-png,image/gif,image/jpeg" class="form-control" width="10%" alt="">
                  <?php endforeach; ?>
                  </div>
                  <small class="form-text text-muted">Max Size 3mb</small>
                </div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="editor1" class="form-control"></div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </form>



  <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"></h5>
          <button class="close" data-dismiss="modal">
            <span></span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title"></label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="category"></label>
              <select class="form-control">
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
              </select>
            </div>
            <div class="form-group">
              <label for="image"></label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image">
                <label for="image" class="custom-file-label"></label>
              </div>
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="body"></label>
              <textarea name="editor1" class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Save Change</button>
        </div>
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
   <script>
        function preview(e){
            var img = document.getElementById("photo");
            img.src = URL.createObjectURL(e.target.file[0]);
        }
    </script>
<?php include('foot.php')?>