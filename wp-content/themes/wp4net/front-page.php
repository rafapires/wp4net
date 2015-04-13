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

<div class="container">

<span id="filosofia-da-colaboratividade">
    <h1>Filosofia da Colaboratividade (nossos valores)</h1>
    <ul>
      <li>O conhecimento de um ajuda o desenvolvimento de todos</li>
      <li>Quanto mais colaborativo é a WP4NET mais barato fica para todos</li>
      <li>Quanto mais colaborativo mais amplo e rápido é o FLUXO de conhecimento garantindo eficiência, agilidade e OPORTUNIDADES INOVADORAS</li>
    </ul>
    <a href="#" class="btn btn-block">Mais informações</a>
</span>
<span id="hospedagem">
    <h1>Hospedagem só para WordPress</h1>
    <ul>
      <li>Configuração do servidor 100% compatível com as diretrizes do WordPress</li>
      <li>Mais segurança e velocidade</li>
      <li>Maior compatibilidade com plugins</li>
      <li>Erros encontrados em um site de um associado é automáticamente compartilhado com todos os outros, aumentando a confiabilidade do site e minimizando custos</li>
      <li>Backups Diários e atualizações constantes garantem segurança e a utilização do que há de mais novo no WordPress</li>
    </ul>
    <a href="#" class="btn btn-block">Mais informações</a>
<span id="transparencia">
    <h1>Transparência</h1>
    <ul>
      <li>Gestão</li>
      <ul>
        <li>Demonstrativo do plano de ação</li>
        <li>Chamada de associados para tomada de decisões e prioridade de ações</li>
        <li>Livre participação de associados em comitês de interesse</li>
      </ul>
      <li>Financeiro</li>
      <ul>
        <li>Transparência total dos custos</li>
        <li>Participação livre de associados na análise e auditoria</li>
        <li>Definição de preços pelo plano de ação de gestão, quanto mais colaborativo mais justo</li>
      </ul>
    </ul>
    <a href="#" class="btn btn-block">Mais informações</a>
</span>
</div>

<?php get_footer(); ?>
