<?php 
$base = new \Imagick("/var/www/mch/env/images/mcb/bar_no_design.png");
$layout = new \Imagick("/var/www/mch/env/configurator/files/clipArts/Angels/ang1.png");
$wrapperbase = new \Imagick("/var/www/mch/env/images/mcb/default-wrapper.png");
$mask = new \Imagick("/var/www/mch/env/images/mcb/wrapper.png");
$mlayout = new \Imagick("/var/www/mch/env/configurator/files/clipArts/Angels/ang1.png");
$img = "/var/www/mch/env/images/mcb/bar_no_design.png";
$wrapper = "/var/www/mch/env/images/mcb/default-wrapper.png";
$size = getimagesize($img);
$wsize = getimagesize($wrapper);
//print_r($size);
// $h = ($size[0])/3;
// $w = ($size[1])/3;
$h = 100;
$w = 100;
// $base->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
// $base->setImageArtifact('compose:args', "1,0,-0.5,0.5");
$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
$base->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, 100, 30);
$base->writeImage("/var/www/mch/env/html5_configurator/img/design/output.png");
echo "<img src='/env/html5_configurator/img/design/output.png'>";
$wrapperbase->resizeImage(1020, 210, Imagick::INTERPOLATE_BICUBIC, 1);
$mlayout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
$mask->compositeImage($mlayout, Imagick::COMPOSITE_OVERLAY, 70, 50);
// $mask->writeImage("/var/www/mch/env/html5_configurator/img/design/output2.png");
$wrapperbase->compositeImage($mask, Imagick::COMPOSITE_OVERLAY, 400, 0);
$wrapperbase->writeImage("/var/www/mch/env/html5_configurator/img/design/output2.png");
echo "<div style='position:relative; width:1020px; height:210px;'><img src='/env/html5_configurator/img/design/output2.png'></div><div class='clear large-space'></div>";
