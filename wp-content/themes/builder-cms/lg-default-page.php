<?php
/**
 * Template Name: Lg Filter Page
 * Template Post Type: page
 */
get_header();
$post_thumbnail_id = get_post_thumbnail_id(get_the_id());
$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
while ( have_posts() ) : the_post(); ?> 

<main id="flex-default-theme" class="lg-default-filter">     
  <div class="gwr gwr-breadcrumb">
    <nav class="flex-breadcrumb" aria-label="breadcrumb">
      <ol>
        <li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
        <li aria-current="page"><?php echo get_the_title(); ?></li>
      </ol>
    </nav>
  </div>
  <section class="gwr c-flex">
    <h1 class="title-block"><? echo get_the_title(); ?></h1>
    <?php the_content(); ?>
    <!-- IMAGEN POR DEFECTO -->
    <?php //if ($post_thumbnail_url) { ?>
      <!-- <div class="content-full-img"><img src="<?php echo $post_thumbnail_url;?>" title="About" alt="About"></div>-->
    <?php //} ?>
  </section>
</main>
<?php endwhile; get_footer(); ?> 
