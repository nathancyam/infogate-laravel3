<?php

class Enrollment extends Eloquent {

	public function user()
	{
        return $this->belongs_to('User');
	}

	public function course()
	{
		return $this->belongs_to('Course');
	}

}
