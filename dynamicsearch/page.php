<?php
get_header();
// page.php ->handles individual pages:
//echo get_the_ID();
    //dynamic banner choices for these pages
    // - if empty array params defaults from dashbord will populate
    pageBanner(array(
        'title' => '',
        'subtitle' => '',
        'bannerimage' => ''
    ));
    
    while (have_posts()) {
        the_post(); 
    ?>
   
  <div class="container container--narrow page-section">
<?php 
//check the ID of the page POST the the parent of this page post - for test
//echo get_the_ID();
//echo wp_get_post_parent_id(get_the_ID());
$theParent = wp_get_post_parent_id(get_the_ID());

if ( $theParent) :?>
      <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true">
      </i> <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
    <?php endif;?>
    
    
    <?php  
    
    $checkPageArray = get_pages(array(
        'child_of' => get_the_ID()
    ));
    
    if($theParent or $checkPageArray ) {?>
     <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?>">
    <?php echo get_the_title($theParent); ?></a></h2>
         <ul class="min-list">
    <?php 
    /* TERNARY if else  example:   
      if $theParent is true then $findChildrenOf = $theParent else $findChildrenOf = get_the_ID()
      i.e.
      if( $theParent ) {
      $findChildrenOf = $theParent;}  --> ID of this page is a "Parent"
      else {
      $findChildrenOf = get_the_ID(); --> ID of this page with is NOT a parent with NO child relationship
      }
      If $theParent is true set $findChildrenOf to $theParent, otherwise set it to get_the_ID() to retrieve the appropriate ID
      
      Let's do this in one line with ternary logic:
      $x = $valid ? 'yes' : 'no';
    */
            
      $findChildrenOf = $theParent ? $theParent : get_the_ID();
      
       wp_list_pages(array(
           'title_li' => NULL,
           'child_of' => $findChildrenOf,
           'sort_order' => 'menu_order'
       ));             
       ?>
       </ul>
    </div> 
<?php }?>

    <div class="generic-content">
     <?php the_content(); ?>

  </div>
    
    
<?php }
get_footer();

?>