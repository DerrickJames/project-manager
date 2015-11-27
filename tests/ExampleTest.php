<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
  //      $this->visit('/')
        //           ->see('Laravel 5');
        
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }

    /**
     * Another basic functional text example.
     *
     * @return void
     */
    public function testAnotherBasicExample()
    {
        $this->visit('/')->see('Project Manager');

 //       $this->assertResponseOk();
    }
}
