<?php include('header.php')?>
<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>

<?php include 'lib/database.php';
$success = "";

?>
  
<header id="main-header" class="py-2 bg-success text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-folder"></i> Categories</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- SEARCH -->
  <section id="search" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Categories...">
            <div class="input-group-append">
              <button class="btn btn-success">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CATEGORIES -->
  <?php include('lastest-categories.php')?>


<?php include('foot.php')?>
