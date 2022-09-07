<?php
/**
 * Template Name: Page Buy/Sell/Rent
 * Template Post Type: page
 */

get_header(); 

$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true)[0];

while ( have_posts() ) : the_post(); 
?>

<section id="main-wrap" data-url="<?php echo $thumb_url; ?>">
  <?php the_content(); ?>
</section>

<?php endwhile; ?> 

<?php get_footer(); ?> 

<script type="text/javascript">
  (function() {
    var wrapper = document.getElementById( 'main-wrap' );
    var image = document.querySelector( '.ib-form-bg' );
    var imageSrc = wrapper.getAttribute('data-url');

    if (image && imageSrc) {
      image.setAttribute('src', imageSrc); 
    }
  })();	
</script>