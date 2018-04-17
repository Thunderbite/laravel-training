<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    } 

    /** @test */ 
    public function testaUserCanBrowseThreads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function testaUserCanReadOneThread()
    {
        $this->get($this->thread->path())
        ->assertSee($this->thread->title);
    }

    /** @test */
    public function testAUserCanReadRepliesThatAreAssociatedWithAThread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
        ->assertSee($reply->body);
    }
}
