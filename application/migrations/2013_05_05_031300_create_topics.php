<?php

class Create_Topics {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('topic', function($table){
            $table->increments('id');
            $table->string('name', 255);
            $table->text('content');
            $table->integer('subject_id');
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
		Schema::drop('topic');
	}

}