<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function testUnauthenticatedUserMayNotAddReplies()
    {   
        $this->expectException('Illuminate\Auth\AuthenticationException');

        
        $this->post('/threads/1/replies', []);

    }

    /** @test */
    public function testAnAuthenticatedUserMayParticipateInForumThreads()
    {
        $this->be($user = factory('App\Models\User')->create());
        
        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
        ->assertSee($reply->body);
    }
}
