<?php

class Create_Courses {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('course', function($table){
            $table->increments('id');
            $table->string('name', 128);
            $table->string('code', 8);
            $table->string('campus', 128);
            $table->integer('coordinator_id');
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
        Schema::drop('course');
	}

}