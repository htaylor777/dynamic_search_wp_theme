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
            <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong>CoffeeMakers</strong>
                    CHILD
                    TEST for Search</a></h1>

            <i class="site-header__menu-trigger" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <nav class="main-navigation">
                    <div class="inline">
                        <ul>
                            <li><a href="#">Our Coffees</a></li>
                            <li><a href="#">Our Growers</a></li>
                            <li> <a href="<?php echo esc_url(site_url('/search')); ?>"
                                    class="search-trigger js-search-trigger">
                                    <i class="fa fa-search" aria-hidden="true"></i>Search</a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>