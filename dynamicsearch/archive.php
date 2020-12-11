<?php
// archive.php
//Handles all Blogs(POSTS) authors page from the metabox authors link in blogs pages
get_header();

pageBanner(array(
    'title' =>  '',
    'subtitle' => get_the_archive_description(),
    'bannerimage' => ''
));

?>
  
 <div class="container container--narrow page-section">
 <?php 
  while(have_posts()){
      the_post(); ?>
      
 <div class="post-item">
 <h2><a class="headline headline--medium headline--post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
 
 <div class="metabox">
 <p>Posted by: <?php the_author_posts_link();?> on <?php the_time('F j, Y');?> in <?php echo get_the_category_list(', '); ?></p> 
 </div>
 
 <div class="generic-content">
 <?php the_excerpt(); ?>
 <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
 </div>
 </div>
 <?php } 
 echo paginate_links(); ?> 
 
 </div>

<?php get_footer();
?>