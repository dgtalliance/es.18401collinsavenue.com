<?php get_header(); ?>

<main id="flex-blog-theme">

  <div class="gwr">
    <nav class="flex-breadcrumb" aria-label="breadcrumb">
      <ol>
        <li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
        <li aria-current="page">Blog</li>
      </ol>
    </nav>
  </div><!-- .gwr -->

  <div class="gwr">

    <div class="widget search">
      <h1 class="title">Search Articles</h1>
      
      <div class="searchArea-container">
        <?php 
          echo $form = '<form class="form-search" action="'.get_bloginfo('url').'" method="get" autocomplete="off">
          <input class="input-search" type="search" name="s" placeholder="'. esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '">
          <button class="clidxboost-icon-search" type="submit"> </button>
          </form>'; 
        ?>
      
        <ul id="list-news-cates" class="reset categories" style="display: none">
          <?php wp_list_categories(array('title_li' => '','exclude'=> '1')); ?>
        </ul>
      </div>
    </div>

    <div id="blog-collection">
      <ul id="articles-blog">
        <?php if ( have_posts() ) : ?>
          <?php 
            $group_count=1; 
            $group_size=9;
            $count_item = 0;
          
            while ( have_posts() ) : the_post();  
            $post_thumbnail_id = get_post_thumbnail_id(get_the_id()); 
            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);   
            $count_item++; 
          ?>
            <li <?php if ($count_item <= $group_size) {
              echo 'class="group-item-'.$group_count.' group-item-page"';
            } else {
              $group_count++;
              $count_item = 1;
              echo 'class="group-item-'.$group_count.' group-item-page"';
            } 
            ?> >
            <div class="content-item" id="content-item-<?php echo $count_item;?>">
              <div class="img-content">
                <img class="blazy" src="<?php echo $post_thumbnail_url; ?>" title="" alt="<?php echo get_the_title(); ?>">
              </div>

              <div class="content-article">
                <h3><?php echo get_the_title(); ?></h3>
                <p>
                  <?php 
                    $excerpt = get_the_excerpt(get_the_id());
                    $excerpt = $excerpt != "" ? $excerpt : mb_strimwidth(wp_trim_excerpt('', get_the_id()), 0, 100, '...');
                    $excerpt = str_replace('[&hellip;]', '...', $excerpt);
                    echo $excerpt;
                  ?>
                </p>
                <time datetime="2017-05-24 20:00">
                  <span>
                    <?php 
                      $date_post = new DateTime($value_post['post_date']);
                      echo $date_post->format("M j, Y"); 
                    ?>
                  </span>
                </time>
              </div>

              <a class="readmore clidxboost-icon-arrowb" 
                href="<?php echo get_the_permalink(); ?>" 
                title="Read More">
                Read more
              </a>
            </div>
            </li>
          <?php endwhile;  ?>
        <?php else: ?>
          <div class="content-not-found">Not found any post</div>
        <?php endif; ?>
      </ul>
    </div>

    <section class="flex-loading-ct view-grid" id="wrap-result" style="">
      <div id="paginator-cnt" class="gwr">
        <nav id="nav-results" class="idx_color_second"></nav>
      </div>
    </section>

    <div class="paginator" id="wrap-result">
      <nav id="nav-results">
        <ul id="principal-nav">
          
        </ul>
      </nav>
    </div>

  </div><!-- .gwr -->

</main>

<?php get_footer(); ?> 
