<?php

class Format {
    public function dateFormat($date){
        return date('d-F-Y', strtotime($date));
    }

    public function textShorten($text, $limit = 400){
        $text = $text. "";

//        $text = substr($text, 0, $limit);
        $text = $text. '....';
        return $text;
    }
}