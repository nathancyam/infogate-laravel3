<?php

class Topic extends Eloquent {

    public function subject()
    {
        return $this->belongs_to('Subject','subject_id');
    }
    
    public function posts()
    {
        return $this->has_many('Post');
    }

    public function get_formatted_content(){
        $rawContent = $this->get_attribute('content');
        return HTML::decode($rawContent);
    }

    public function get_form_content(){
        $rawContent = $this->get_attribute('content');
        $order = array("<br />");
        $replace = "\n";
        $newContent = str_replace($order, $replace, $rawContent);
        return $newContent;
    }

    public function set_content($content){
        $order   = array("\r\n", "\n", "\r");
        $replace = '<br />';
        $newContent = str_replace($order, $replace, $content);
        $this->set_attribute('content', $newContent);
    }
}
