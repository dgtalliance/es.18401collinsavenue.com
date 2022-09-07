<?php get_header();
               $limit_in=0;
               $limit_fin=12;
             $pagina=$_GET['pag'];
             $varsearch=$_GET['search'];
             $filter_slug_data =[];
             $filter_slug ='';

             if (array_key_exists('condos',$_GET)) {
              $var_condos='"'.$_GET['condos'].'"';
              $filter_slug_data[]='condos='.$_GET['condos'];
              $query_condos="INNER JOIN {$wpdb->postmeta} relation_condos on relation_condos.post_id=post_prin.ID and relation_condos.meta_key='idx_news_building' and relation_condos.meta_value like '%".$var_condos."%'";
             }

             if (array_key_exists('neighborhood',$_GET)) {
              $filter_slug_data[]='neighborhood='.$_GET['neighborhood'];
              $var_neighborhood='"'.$_GET['neighborhood'].'"';
              $query_neighborhood="INNER JOIN {$wpdb->postmeta} relation_condos on relation_condos.post_id=post_prin.ID and relation_condos.meta_key='idx_news_neighborhood' and relation_condos.meta_value like '%".$var_neighborhood."%'";
             }             
             

             $search_query='';
             if ( array_key_exists('search', $_GET)) {
              if (!empty($varsearch)) {
                $filter_slug_data[]='search='.$varsearch;
               $search_query=' AND ( lower(post_prin.post_title) LIKE "%'.strtolower($varsearch).'%" or lower(post_prin.post_content) LIKE "%'.strtolower($varsearch).'%")  ';
              }
             }

             if (!empty($filter_slug_data) && is_array($filter_slug_data) && count($filter_slug_data)>0) {
              $filter_slug='&'.implode('&',$filter_slug_data);
             }
 ?> 
  <div class="r-overlay"></div>
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
            <input class="input-search" type="search" name="search" placeholder="'. esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' .$varsearch. '">
            <button class="clidxboost-icon-search" type="submit"> </button>
          </form>'; ?> 
            <ul id="list-news-cates" class="reset categories" style="display: none"><?php wp_list_categories(array('title_li' => '','exclude'=> '1')); ?></ul>
            </div>
        </div>
        <div id="blog-collection">
          <ul id="articles-blog">

             <?php 
             if(!empty($pagina)) {
              if ($pagina!='1')
                $limit_in=(intval($pagina)-1)*$limit_fin;                
             }else{
              $pagina=1;
             }

              $query_post_cred="SELECT post_prin.ID,post_prin.post_title,post_prin.post_name,post_prin.post_content,post_prin.post_excerpt,post_prin.post_date
                FROM {$wpdb->posts} post_prin
              ".$query_condos."
              ".$query_neighborhood."
            WHERE post_prin.post_type='post' and post_prin.post_status='publish' ".$search_query." order by post_prin.post_date desc limit {$limit_in},{$limit_fin} ;";
            
            $result_post = $wpdb->get_results($query_post_cred, ARRAY_A);
            $result_post_tot = $wpdb->get_results("SELECT COUNT(ID) AS num_item FROM {$wpdb->posts} post_prin ".$query_condos." ".$query_neighborhood." WHERE post_prin.post_type='post' and post_prin.post_status='publish' ".$search_query.";", ARRAY_A);
            $num_item=0; $num_pages_item=0;
            if (array_key_exists(0, $result_post_tot)) 
              $num_item=$result_post_tot[0]['num_item'];
                          
            $num_pages_item=($num_item/$limit_fin);
            foreach ($result_post as $index_post => $value_post) { 
              $post_thumbnail_id = get_post_thumbnail_id($value_post['ID']); 
              $image = wp_get_attachment_url($post_thumbnail_id); 

              if (empty($image) ) {
                $image= get_template_directory_uri().'/images/coming-soon_03.jpg';
              }
              ?>
            <li>  
              <div class="content-item" id="content-item-<?php echo $count_item;?>">
                <div class="img-content">
                  <img class="b-lazy" src="<?php echo $image; ?>" title=""  alt="<?php echo get_the_title(); ?>">
                </div>
                <div class="content-article">
                  <h3><?php echo $value_post['post_title']; ?></h3>
                  <p><?php echo $value_post['post_excerpt']; ?></p>
                  <time datetime="2017-05-24 20:00">
                    <span>
                      <?php 
                      $date_post = new DateTime($value_post['post_date']);
                      echo $date_post->format("M j, Y"); 
                      ?>
                    </span>
                  </time>
                </div><a class="readmore clidxboost-icon-arrowb" href="<?php echo get_site_url().'/'.$value_post['post_name']; ?>" title="Read More">Read more</a>
              </div>              
            </li>
            <?php  } ?>
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

<script type='text/javascript'> var  xcant=<?php echo $num_pages_item; ?>; </script>
    <script type='text/javascript'> 
      var urlpageante=0;
      var urlpage=1;
      var urlpagenext=1;
      if (xcant % 1 == 0) { xcant=xcant; } 
      else { 
        if(xcant>Math.round(xcant)) {
          xcant=Math.round(xcant)+1;
        }else{
          xcant=Math.round(xcant);
        }
      }
    (function ($) {
     $(document).ready(function () { var size_li = $('#articles-blog li').length;  var urlpage=1; if(size_li==0){  
      $('.paginator').hide(); 
    }  

var urlParamsblog;
(window.onpopstate = function () {
    var match,
        pl     = /\+/g,
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

    urlParamsblog = {};
    while (match = search.exec(query))
       urlParamsblog[decode(match[1])] = decode(match[2]);
})();
      
      if (urlParamsblog.pag != undefined ) {  
        var urlparci=window.location.href.substr(1).split('?')[1].split('=');  
        urlpage=urlParamsblog.pag; 
        $('.group-item-page').removeClass('active_item').addClass('inactive_item');  
        $('.group-item-'+urlParamsblog.pag).removeClass('inactive_item').addClass('active_item');  
      }else{ 
        urlpage=1; 
        $('.group-item-page').removeClass('active_item').addClass('inactive_item');  
        $('.group-item-'+urlpage).removeClass('inactive_item').addClass('active_item'); 
      } 

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
                    paginationHTML.push('<span id="indicator">Page ' + urlpage + ' of ' + xcant + '</span>');
                    if (urlpageante && xcant > 1) {
                        paginationHTML.push('<a href="?pag=1<?php echo $filter_slug; ?>" data-page="1" title="First Page" id="firstp" class="ad visible">');
                        paginationHTML.push('<span class="clidxboost-icon-arrow-select"></span>');
                        paginationHTML.push('<span class="clidxboost-icon-arrow-select"></span>');
                        paginationHTML.push('<span>First page</span>');
                        paginationHTML.push('</a>');
                    }
                    if (urlpageante) {
                        paginationHTML.push('<a href="?pag='+(parseInt(urlpage)-1)+'<?php echo $filter_slug; ?>" data-page="' + (parseInt(urlpage) - 1) + '" title="Prev Page" id="prevn" class="arrow clidxboost-icon-arrow-select prevn visible">');
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
                              paginationHTML.push('<li class="active"><a href="?pag='+loopPage+'<?php echo $filter_slug; ?>" data-page="' +loopPage+ '">' + loopPage+ '</a></li>');
                          } else {
                              paginationHTML.push('<li><a href="?pag='+loopPage+'<?php echo $filter_slug; ?>" data-page="' + loopPage + '">' + loopPage + '</a></li>');
                          }
                        }
                     }
                    }else{
                      for (var i = 0, l = 5 ; i <= l; i++) {
                        var loopPage = parseInt(urlpage)+i;
                          if (loopPage>0) {                        
                        if (parseInt(urlpage) === loopPage) {
                            paginationHTML.push('<li class="active"><a href="?pag='+loopPage+'<?php echo $filter_slug; ?>" data-page="' +loopPage+ '">' + loopPage+ '</a></li>');
                        } else {
                            paginationHTML.push('<li><a href="?pag='+loopPage+'<?php echo $filter_slug; ?>" data-page="' + loopPage + '">' + loopPage + '</a></li>');
                        }
                      }
                    }
                  }
                    paginationHTML.push('</ul>');
                    if (urlpagenext)  {
                        paginationHTML.push('<a href="?pag='+urlpagenext+'<?php echo $filter_slug; ?>" data-page="' + urlpagenext + '" title="Prev Page" id="nextn" class="arrow clidxboost-icon-arrow-select nextn visible">');
                        paginationHTML.push('<span>Next page</span>');
                        paginationHTML.push('</a>');
                    }
                      if (urlpagenext && xcant > 1) {
                        paginationHTML.push('<a href="?pag='+xcant+'<?php echo $filter_slug; ?>" data-page="' + xcant + '" title="End Page" id="lastp" class="ad visible">');
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



