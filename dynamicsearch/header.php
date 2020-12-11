<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head();?>

</head>

<body <?php body_class();?>>
    <header class="site-header">
        <div class="container">
            <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong>Dynamic</strong>
                    TEST for Search</a></h1>

            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <nav class="main-navigation">

                    <ul>
                        <li><a href="#">Item 1</a></li>
                        <li><a href="#">Item 2</a></li>
                        <li><a href="#">Item 3</a></li>
                        <li><a href="#">Item 4</a></li>

                        <li <?php if (is_page('admission') or wp_get_post_parent_id(0) == 15) {
    echo 'class="current-menu-item"';
}
?>>
                        <li><a href="#">Item 4</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Sign Up</a></li>
                        <li><a href="<?php echo esc_url(site_url('/search')); ?>"
                                class="search-trigger js-search-trigger"><i class="fa fa-search"
                                    aria-hidden="true"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>