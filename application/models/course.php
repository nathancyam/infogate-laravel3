<?php

class Course extends Eloquent {

    public function user()
    {
        return $this->has_one('User');
    }

    public function enrollment()
    {
        return $this->has_one('Enrollment');
    }

    public function subjects()
    {
        return $this->has_many('Subject');
    }

    public function set_code($courseCode){
        return $this->set_attribute('code', strtolower($courseCode));
    }
}
