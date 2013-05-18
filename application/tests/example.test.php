<?php

class TestExample extends PHPUnit_Framework_TestCase {

    protected $user;

    public function setUp(){
        $this->user = new User(array(
            'username' => array('forename'=>'Test', 'surname'=>'Case'),
            'fName' => 'Test',
            'sName' => 'Case',
            'password' => 'password',
            'email' => 'testcase@test.com',
            'role' => 'student')
        );
    }

    public function testUsernameShouldbeMade(){
        $this->assertEquals('tecase', $this->user->username);
    }

    public function testPasswordShouldbeHashed(){
        $this->assertFalse('password' === $this->user->password);
    }
}
