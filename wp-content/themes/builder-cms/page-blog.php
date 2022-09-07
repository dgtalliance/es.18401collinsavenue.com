<?php
get_header(); ?> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/dgt-mas.js"></script> 
    <main id="flex-blog-theme">
      <div class="gwr gwr-breadcrumb">
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
             <?php $args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => '-1', 'numberposts'=> -1, 'order' => 'DESC'); 
             $loop = new WP_Query($args); 
              $group_count=1; 
              $group_size=9;
              $count_item = 0;

              while ( $loop->have_posts()):$loop->the_post(); $post_thumbnail_id = get_post_thumbnail_id(get_the_id()); $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id); 

              $count_item++; ?>
              <li <?php if($count_item<=$group_size) {
                echo 'class="group-item-'.$group_count.' group-item-page inactive_item"';
              }else{
                $group_count++;
                $count_item=1;
                echo 'class="group-item-'.$group_count.' group-item-page inactive_item"';
              } 
              ?> >
              <div class="content-item" id="content-item-<?php echo $count_item;?>">
              	<div class="img-content">
              		<img class="blazy" src="<?php echo $post_thumbnail_url; ?>" title="" alt="<?php echo get_the_title(); ?>">
              	</div>
                <div class="content-article">
                  <h3><?php echo get_the_title(); ?></h3>
                  <p><?php echo the_excerpt_max_charlength(100); ?></p>
                  <time datetime="2017-05-24 20:00"><span><?php echo get_the_date(); ?></span></time>
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

<script type='text/javascript'> var  xcant=<?php echo $group_count; ?>; </script>
    <script type='text/javascript'> 
      var urlpageante=0;
      var urlpage=1;
      var urlpagenext=1;
    (function ($) {
     $(document).ready(function () { var size_li = $('#articles-blog li').length;  var urlpage=1; if(size_li==0){  $('.paginator').hide(); }  if (window.location.href.substr(1).split('?').length !== 1 ) {  var urlparci=window.location.href.substr(1).split('?')[1].split('=');  urlpage=urlparci[1]; $('.group-item-page').removeClass('active_item').addClass('inactive_item');  $('.group-item-'+urlparci[1]).removeClass('inactive_item').addClass('active_item');  }else{ urlpage=1; $('.group-item-page').removeClass('active_item').addClass('inactive_item');  $('.group-item-'+urlpage).removeClass('inactive_item').addClass('active_item'); } 

if(urlpage==1 || urlpage==0) {
    urlpageante=0;
}else{
    urlpageante=urlpage-1;
}

if(xcant==urlpage) {
  urlpagenext=0;
}else{
  urlpagenext=parseInt(urlpage)+1;
}

var paginationHTML=[];
                if (xcant > 1) {
                    paginationHTML.push('<span id="indicator">Pag ' + urlpage + ' of ' + xcant + '</span>');
                    if (urlpageante && xcant > 1) {
                        paginationHTML.push('<a href="?pag=1" data-page="1" title="First Page" id="firstp" class="ad visible">');
                        paginationHTML.push('<span class="clidxboost-icon-arrow-select"></span>');
                        paginationHTML.push('<span class="clidxboost-icon-arrow-select"></span>');
                        paginationHTML.push('<span>First page</span>');
                        paginationHTML.push('</a>');
                    }
                    if (urlpageante) {
                        paginationHTML.push('<a href="?pag='+(parseInt(urlpage)-1)+'" data-page="' + (parseInt(urlpage) - 1) + '" title="Prev Page" id="prevn" class="arrow clidxboost-icon-arrow-select prevn visible">');
                        paginationHTML.push('<span>Previous page</span>');
                        paginationHTML.push('</a>');
                    }
                    paginationHTML.push('<ul id="principal-nav">');
                    var variFil=5+parseInt(urlpage);
                      console.log(variFil);
                      console.log(xcant);
                    if (variFil > xcant)  {
                      console.log("debe retroceder desde el mayor");
                      for (var i = 0 , l = 5 ; i <= l; i++) {
                        var loopPage = (parseInt(xcant)-l)+i;
                        if (loopPage>0) {
                          if (parseInt(urlpage) === loopPage) {
                              paginationHTML.push('<li class="active"><a href="?pag='+loopPage+'" data-page="' +loopPage+ '">' + loopPage+ '</a></li>');
                          } else {
                              paginationHTML.push('<li><a href="?pag='+loopPage+'" data-page="' + loopPage + '">' + loopPage + '</a></li>');
                          }
                        }
                     }
                    }else{
                      for (var i = 0, l = 5 ; i <= l; i++) {
                        var loopPage = parseInt(urlpage)+i;
                          if (loopPage>0) {                        
                        if (parseInt(urlpage) === loopPage) {
                            paginationHTML.push('<li class="active"><a href="?pag='+loopPage+'" data-page="' +loopPage+ '">' + loopPage+ '</a></li>');
                        } else {
                            paginationHTML.push('<li><a href="?pag='+loopPage+'" data-page="' + loopPage + '">' + loopPage + '</a></li>');
                        }
                      }
                    }
                  }
                    paginationHTML.push('</ul>');
                    if (urlpagenext)  {
                        paginationHTML.push('<a href="?pag='+urlpagenext+'" data-page="' + urlpagenext + '" title="Prev Page" id="nextn" class="arrow clidxboost-icon-arrow-select nextn visible">');
                        paginationHTML.push('<span>Next page</span>');
                        paginationHTML.push('</a>');
                    }
                      if (urlpagenext && xcant > 1) {
                        paginationHTML.push('<a href="?pag='+xcant+'" data-page="' + xcant + '" title="End Page" id="lastp" class="ad visible">');
                        paginationHTML.push('<span class="clidxboost-icon-arrow-select"></span>');
                        paginationHTML.push('<span class="clidxboost-icon-arrow-select"></span>');
                        paginationHTML.push('<span>Last page</span>');
                        paginationHTML.push('</a>');
                    }
                }
                jQuery('#nav-results').html(paginationHTML.join(""));

    }); 
    
    })(jQuery);
     </script>
<?php get_footer(); ?> 
