
<?php

?>
<section id="users">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Latest Categories</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;?>
                <?php $tb_news = run_query("select * from tb_category"); ?>
                <?php foreach($tb_news as $p): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $p['name']; ?></td>
                        <td><?php echo $p['time']; ?></td>
                        
                        <td>
                            <a href="edit-category.php?category_id=<?php echo $p['category_id'];?>" class="btn btn-secondary">
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