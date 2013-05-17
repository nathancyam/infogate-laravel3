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
        }
    }
}
