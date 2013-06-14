<?php

class Post extends Eloquent {

    public function user()
    {
        return $this->belongs_to('User','author_id');
    }

    public function topic(){
        return $this->belongs_to('Topic','topic_id');
    }

    public function get_working_links(){
        $arrayLinks = array();
        $dbLinks = $this->get_attribute('links');
        $links = explode("\n", $dbLinks);
        if($dbLinks !== ""){
            foreach($links as $link){
                $formattedlink = "<a href=http://" . $link . ">" . $link . "</a>";
                array_push($arrayLinks, HTML::decode($formattedlink));
            }
            return $arrayLinks;
        } else {
            return false;
        }
    }

    public function get_formatted_body(){
        $rawBody = $this->get_attribute('body');
        return HTML::decode($rawBody);
    }

    public function get_form_body(){
        $rawBody = $this->get_attribute('body');
        $order = array("<br />");
        $replace = "\n";
        $newBody = str_replace($order, $replace, $rawBody);
        return $newBody;
    }

    public function set_body($body){
        $order   = array("\r\n", "\n", "\r");
        $replace = '<br />';
        $newBody = str_replace($order, $replace, $body);
        $this->set_attribute('body', $newBody);
    }
}
