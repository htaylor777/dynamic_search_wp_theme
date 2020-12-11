<?php
// single.php ->handles individual Blog posts from index.php (Blog Home)
get_header();
//echo get_the_ID();
while(have_posts()){
    the_post(); 
    //dynamic banner choices for these pages
    // - if empty array params defaults from dashbord will populate
    pageBanner(array(
        'title' => '',
        'subtitle' => '',
        'bannerimage' => ''
    ));
    ?>

   
  <div class="container containera--narrow page-section">
  
  <!-- metabox will go here -->
  <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('/blog');?>">
      <i class="fa fa-home" aria-hidden="true"></i> Blog home </a>
      <span class="metabox__main"> Posted by: 
      <?php the_author_posts_link();?> on <?php the_time('F j, Y');?> in <?php echo get_the_category_list(', '); ?>
      </span></p>
    </div>
 
  <!-- get dynamic  -->
  <div class="generic-content"><?php the_content();?></div>
  </div>      
   
<?php } 
 
get_footer();
?> 