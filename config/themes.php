<?php

    $bgVid = "bg_3.mp4";

    if($_COOKIE["theme"] == "dark") {
        $bgVid = "bg_2.mp4";
        $loadingBgVid = "loadingVideoImageDark.jpg";
        $wavesImage = "indexWavesDark.png";
    } else if($_COOKIE["theme"] == "light") {
        $bgVid = "bg_1.mp4";
    } 

?>