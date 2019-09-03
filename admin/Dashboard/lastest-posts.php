<?php include('count.php')?>
<section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
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
              <?php $tb_news = run_query("select title,username, name, news_id,
                                                  short_description, description, 
                                                  feartur_image, create_at from 
                                                  tb_user u join tb_category c join tb_news n
                                                  on u.user_id = n.user_id and 
                                                  c.category_id = n.category_id;"); 
                                                    
                    
                                                    ?>
                <?php foreach($tb_news as $pro): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $pro['title']; ?></td>
                        <td><?php echo $pro['name']; ?></td>
                        <td><?php echo $pro['username']; ?></td>
                        <td><?php echo $pro['create_at']; ?></td>
                        
                        
                        <td>
                            <a href="edit-post.php?news_id=<?php echo $pro['news_id'];?>" class="btn btn-secondary">
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
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <h3>Posts</h3>
              <h4 class="display-4">
                <i class="fas fa-pencil-alt"></i>
                <?php echo $nb_news;?>

              </h4>
              <a href="posts.php" class="btn btn-outline-light btn-sm">View</a>
            </div>
          </div>

          <div class="card text-center bg-success text-white mb-3">
            <div class="card-body">
              <h3>Categories</h3>
              <h4 class="display-4">
                <i class="fas fa-folder"></i> 
                <?php echo $nb_cate;?>

              </h4>
              <a href="categories.php" class="btn btn-outline-light btn-sm">View</a>
            </div>
          </div>
          <div class="card text-center bg-warning text-white mb-3">
            <div class="card-body">
              <h3>Users</h3>
              <h4 class="display-4">
                <i class="fas fa-users"></i> 
                <?php echo $nb_user;?>

              </h4>
              <a href="users.php" class="btn btn-outline-light btn-sm">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>