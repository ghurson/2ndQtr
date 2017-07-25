<?php

class Display {

    static function content(){

        wp_reset_query();
        if (in_array(get_the_ID(), array(85, 31, 18), true)) return false;
        the_content();
    }

    static function blog(){
        if(get_the_ID() != 85) return false;
        get_template_part("parts/blog/archive");
    }

    static function resources(){
        if(get_the_ID() != 31) return false;
        get_template_part("parts/resource/archive");
    }

    static function engage(){
        if(get_the_ID() != 18) return false;
        get_template_part("parts/engage/archive");
    }

    static function testimonials(){
        if(get_the_ID() != 2) return false;
        get_template_part("parts/testimonials");
    }


}