<?php
require_once('../config.php');
// Load Classes
C::loadClass('Imaging');
class Thumbnail extends Imaging {
    private $image;
    private $width;
    private $height;

    function __construct($image,$width,$height) {
parent::set_img($image);
parent::set_quality(80);
parent::set_size($width,$height);
            $this->thumbnail= pathinfo($image, PATHINFO_DIRNAME).pathinfo($image, PATHINFO_FILENAME).'_tn.'.pathinfo($image, PATHINFO_EXTENSION);
parent::save_img($this->thumbnail);
parent::clear_cache();
        }
    function __toString() {
            return $this->thumbnail;
    }
}
