<?php

class Post extends Eloquent {

	public function user()
	{
		return $this->belongs_to('User','author_id');
	}
    public function topic(){
        return $this->belongs_to('Topic','topic_id');
    }

}
