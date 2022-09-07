<?php get_header(); 
$cat_id = get_queried_object_id();  ?>
    <main id="flex-blog-theme">
      <div class="gwr">
        <nav class="flex-breadcrumb" aria-label="breadcrumb">
          <ol>
            <li><a href="<?php echo site_url(); ?>" title="Home">Home</a></li>
            <li aria-current="page">Blog</li>
          </ol>
        </nav>
      </div>
      <div class="gwr">
        <div class="widget search">
          <h1 class="title">Search Articles</h1>    
          <div class="searchArea-container">
          <?php echo $form = '<form class="form-search" action="'.get_bloginfo('url').'" method="get" autocomplete="off">
            <input class="input-search" type="search" name="s" placeholder="'. esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '">
            <button class="clidxboost-icon-search" type="submit"> </button>
          </form>'; ?> 
            <ul id="list-news-cates" class="reset categories" style="display: none"><?php wp_list_categories(array('title_li' => '','exclude'=> '1')); ?></ul>
            </div>
        </div>
        <div id="blog-collection">
          <ul id="articles-blog">
            <?php  
             $args = array( 'post_type' => 'post', 'posts_per_page' => -1,'cat' => $cat_id,);
             $loop = new WP_Query($args); 
             $group_count=1;  $group_size=3;
             $group_count=1; 
             $group_size=9;
             $count_item = 0;
             while ( $loop->have_posts()): $loop->the_post(); 
              if($post->post_type != "post") continue;
              $post_thumbnail_id = get_post_thumbnail_id(get_the_id()); $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);  

              if (empty($post_thumbnail_url)) {
                $post_thumbnail_url= get_template_directory_uri().'/images/coming-soon_03.jpg';
              }

              $count_item++; ?>
              <li <?php if($count_item<=$group_size) {
                echo 'class="group-item-'.$group_count.' group-item-page"';
              }else{
                $group_count++;
                $count_item=1;
                echo 'class="group-item-'.$group_count.' group-item-page"';
              } 
              ?> >
              <div class="content-item" id="content-item-<?php echo $count_item;?>">
                <div class="img-content">
                  <img class="blazy" src="<?php echo $post_thumbnail_url; ?>" title="" alt="<?php echo get_the_title(); ?>">
                </div>
                <div class="content-article">
                  <h3><?php echo get_the_title(); ?></h3>
                  <p><?php echo the_excerpt_max_charlength(100); ?></p>
                  <time datetime="2017-05-24 20:00">
                    <span>
                      <?php 
                      $date_post = new DateTime($value_post['post_date']);
                      echo $date_post->format("M j, Y"); 
                      ?>
                    </span>
                  </time>
                </div><a class="readmore clidxboost-icon-arrowb" href="<?php echo get_the_permalink(); ?>" title="Read More">Read more</a>
              </div>
            </li>
          <?php endwhile;  ?>
          </ul>
        </div>

<section id="wrap-result" style="" class="flex-loading-ct view-grid">
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

      </div>
    </main>
<?php get_footer(); ?> 
