<?php 

/*Template Name: Home */
 
get_header(); ?>

<?php $args_carrocel = array(
  'order' => 'ASC',
  'orderby' => 'meta_value_num',
  'meta_key' => 'carrocel',
  'post_type' => 'page',
  'post_status' => 'publish'
); 
$query_carrocel = new wp_query($args_carrocel); 
$count_carrocel = $query_carrocel->post_count;
$pages = $query_carrocel->get_posts();
?>

<div id="carousel-wp4net-fullwidth" class="carousel slide" data-ride="carousel"> <!-- CARROCEL -->
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php
    $indicator_active = "class='active'";
    for ($i=0; $i < $count_carrocel; $i++) { ?>
      <li data-target="#carousel-wp4net-fullwidth" data-slide-to="<?php echo $i.'"'.$indicator_active; ?>" ></li>
    <?php $indicator_active =''; } ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php $item_active=' active';
    foreach ($pages as $page) { 
      ?>
      <div class="item<?php echo $item_active; ?>">
        <?php echo get_the_post_thumbnail($page->ID); ?>
        <div class="carousel-caption">
          <h1><?php echo $page->post_title; ?></h1>
          <p><?php if ($page->post_excerpt) { echo $page->post_excerpt;} else {echo substr(strip_tags($page->post_content),0,240);} ?></p>
          <a href="#<?php echo $page->post_name; ?>" class="btn btn-warning">Saiba mais</a>
        </div>
      </div>

      
    <?php 
    $item_active=''; } ;
    ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-wp4net-fullwidth" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-wp4net-fullwidth" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> <!-- END CARROCEL -->
<?php 
foreach ($pages as $page) {
?>
  <section id='<?php echo $page->post_name;?>'>
  <div class='container'>
    <?php echo $page->post_content; ?>
  </div>
  </section>

<?php 
}
?>
<?php get_footer(); ?>
