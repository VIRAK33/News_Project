<?php include('header.php');
  include('lib/database.php');
?>
<?php
    session_start();
    if($_SESSION['user_id'] == null){
        header('location:login.php');
    }
?>


  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-pencil-alt"></i> Posts</h1>
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
            <input type="text" class="form-control" placeholder="Search Posts...">
            <div class="input-group-append">
              <button class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Latest Posts</h4>
            </div>
            
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Create By</th>
                  <th>Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 1;?>
              <?php $tb_news = run_query("select *
                                          from tb_user u join tb_category c join tb_news n
                                          on u.user_id = n.user_id and c.category_id = n.category_id
                                          ;"); ?>
                <?php foreach($tb_news as $p): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $p['title']; ?></td>
                        <td><?php echo $p['name']; ?></td>
                        <td><?php echo $p['username']; ?></td>
                        <td><?php echo $p['create_at']; ?></td>
                        
                        
                        <td>
                            <a href="edit-post.php?news_id=<?php echo $p['news_id'];?>" class="btn btn-secondary">
                                <i class="fas fa-angle-double-right"></i> Details
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          

            <!-- PAGINATION -->
            <nav class="ml-4">
              <ul class="pagination">
                <li class="page-item disabled">
                  <a href="#" class="page-link">Previous</a>
                </li>
                <li class="page-item active">
                  <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">3</a>
                </li>
                <li class="page-item">
                  <a href="#" class="page-link">Next</a>
                </li>
              </ul>
            </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php include('foot.php')?>