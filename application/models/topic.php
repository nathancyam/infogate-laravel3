<?php

class Topic extends Eloquent {

    public function subject()
    {
        return $this->belongs_to('Subject');
    }
    public function posts()
    {
        return $this->has_many('Posts');
    }

}
