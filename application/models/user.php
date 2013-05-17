<?php

class User extends Eloquent {

    public function posts()
    {
        return $this->has_many('Post');
    }

    public function enrollment(){
        return $this->has_one('Enrollment');
    }

    public function set_username($names)
    {
        $newUsername = strtolower(substr($names['forename'],0,2) . substr($names['surname'],0,4));
        $this->set_attribute('username', $newUsername);
    }

    public function set_password($plaintext){
        $this->set_attribute('password', Hash::make($plaintext));
    }
}
