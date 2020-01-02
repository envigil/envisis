<?php require APPROOT . '/views/include/header.php';?>

<h1><?php echo $data['title'];?></h1>
<?php foreach($data['post']  as $post ) :  ?>
<ul>
    <li><?php    echo $post->post;?></li>
</ul>

<?php  endforeach;  ?>

<?php require APPROOT . '/views/include/footer.php';?>
