<?php

class Create_Subjects {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects',function($table){
            $table->increments('id');
            $table->string('name', 128);
            $table->string('code', 8);
            $table->text('description');
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
        Schema::drop('subjects');
    }

}
