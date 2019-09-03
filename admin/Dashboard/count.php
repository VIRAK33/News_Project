<?php $tb_users = run_query("select * from tb_user"); $nb_user=0; ?>
<?php foreach($tb_users as $p): ?>
<?php $nb_user++;?>
<?php endforeach; ?>

<?php $tb_category = run_query("select * from tb_category"); $nb_cate=0; ?>
<?php foreach($tb_category as $p): ?>
<?php $nb_cate++;?>
<?php endforeach; ?>

<?php $tb_news = run_query("select * from tb_news"); $nb_news=0; ?>
<?php foreach($tb_news as $p): ?>
<?php $nb_news++;?>
<?php endforeach; ?>