<?php

class Subject extends Eloquent {

    public function course()
    {
        return $this->belongs_to('Course','course_id');
    }

    public function topics()
    {
        return $this->has_many('Topic');
    }

    public function set_code($subjectCode){
        return $this->set_attribute('code', strtolower($subjectCode));
    }
}
