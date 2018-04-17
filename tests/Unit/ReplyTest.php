<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function testItHasAnOwner()
    {
       $reply = factory('App\Reply')->create();

       $this->assertInstanceOf('App\Models\User', $reply->owner);
    }
}
