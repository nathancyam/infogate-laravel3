<?php

class Course extends Eloquent {

    public function user()
    {
        return $this->belongs_to('User','coordinator_id');
    }
}
