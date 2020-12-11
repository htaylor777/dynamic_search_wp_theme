<?php
//Blog main page
get_header();

//dynamic banner choices for these pages
// - if empty array params defaults from dashbord will populate
pageBanner(array(
    'title' => 'Search Results',
    'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;',
    'bannerimage' => '',
));
?>

<div class="container container--narrow page-section">
    <?php
// gets formats from each query found  in content-templat directory
// Search results are then displayed in search.php page:
while (have_posts()) {
    the_post();
    get_template_part('template-parts/content', get_post_type());
    ?>


    <?php }
echo paginate_links();?>
</div>

<?php get_footer();
?>