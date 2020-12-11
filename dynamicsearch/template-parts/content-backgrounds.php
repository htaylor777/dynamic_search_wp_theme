<?php
switch (get_the_ID()) {
    case 125:
    case 134:    
        $image = WOODWINDS;
        break;
    case 124:
        $image = PIANO;
        break;
    case 123:
    case 212:
        $image = PERCUSSION;
        break;
    case 122:
        $image = BRASS;
        break;
    case 121:
    case 133:
        $image = BOWEDSTRINGS;
        break;
    case 235:
        $image = VOCALS;
        break;
    case 240:
        $image = GUITAR;
        break;
    case 241:
        $image = BASSGUITAR;
        break;
 }

pageBanner(array(
    'title' => get_the_title(),
    'subtitle' => 'Required for improving ability techniques and performance skills',
    'bannerimage' => $image
));



?>