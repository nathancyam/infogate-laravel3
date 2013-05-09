<?php

class User extends Eloquent {

    public function posts()
    {
        return $this->has_many('Post');
    }

    public function set_username($forename, $surname){
        $this->set_attribute('username', strtolower(substr($forename,0,2) . substr($surname,0,4)));
    }

    public function set_password($plaintext){
        $this->set_attribute('hashed',Hash::make($plaintext));
    }

}
