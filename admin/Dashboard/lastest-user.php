

<section id="users">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Latest Users</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;?>
                <?php $tb_news = run_query("select * from tb_user"); ?>
                <?php foreach($tb_news as $p): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $p['username']; ?></td>
                        <td><?php echo $p['email']; ?></td>
                        <td><?php echo $p['password']; ?></td>
                        
                        <td>
                            <a href="edit-user.php?user_id=<?php echo $p['user_id'];?>" class="btn btn-secondary">
                                <i class="fas fa-angle-double-right"></i> Details
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>