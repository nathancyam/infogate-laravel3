<?php

class Create_Users {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table){
            $table->increments('id');
            $table->string('username', 128);
            $table->string('password', 64);
            $table->string('role', 64);
            $table->string('fName', 128);
            $table->string('sName', 128);
            $table->timestamps();
        });
        DB::table('users')->insert(array(
            'username'=>'admin',
            'password'=>Hash::make('password'),
            'role'=>'admin',
            'fName'=>'John',
            'sName'=>'Smith'
        ));
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('users');
    }
}
