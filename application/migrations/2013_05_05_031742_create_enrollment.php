<?php

class Create_Enrollment {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('enrollment', function($table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->timestamps();
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('enrollment');
	}

}