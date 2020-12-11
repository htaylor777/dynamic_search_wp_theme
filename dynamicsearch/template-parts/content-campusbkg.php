<?php
switch (get_the_ID()) {
   
    case 236:
        $image = WEST_CAMPUS;
        break;
    case 237:
        $image = EAST_CAMPUS;
        break;
}

pageBanner(array(
    'title' => get_the_title(),
    'subtitle' => '',
    'bannerimage' => $image
));



?>
