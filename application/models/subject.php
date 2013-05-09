<?php

class Subject extends Eloquent {

    public function course()
    {
        return $this->belongs_to('Course','course_id');
    }

}
