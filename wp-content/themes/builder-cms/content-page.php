<?php
$post_thumbnail_id = get_post_thumbnail_id(get_the_id());
$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
?> 

    <main id="flex-default-theme">     
      <div class="gwr gwr-breadcrumb">
        <div class="flex-breadcrumb">
          <ol>
            <li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
            <li><?php echo get_the_title(); ?></li>
          </ol>
        </div>
      </div>

      <div class="gwr c-flex">
        <article class="flex-block-description">
          <!-- TITULO PAGINA -->
          <h1 class="title-block"><? echo get_the_title(); ?></h1>
          <!-- TITULO PAGINA -->
          <!-- CONTENIDO -->
         <?php the_content(); ?>
          <!-- CONTENIDO -->
        </article>
        <!-- IMAGEN POR DEFECTO -->
        <?php if ($post_thumbnail_url) { ?>
          <div class="content-full-img"><img src="<?php echo $post_thumbnail_url;?>" title="About" alt="About"></div>
        <?php } ?>

      </div>
    </main>