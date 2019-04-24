<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_cannot_favorite_anything()
    {
        $this->withExceptionHandling();
        $this->post('replies/1/favorites')
            ->assertRedirect('/login');

    }

    /** @test */
    function an_authenticated_user_can_favourite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        // If i post to a 'favourite' endpoint
        $this->post('replies/' . $reply->id . '/favorites');
        // It should be recorder in the database
        $this->assertCount(1, $reply->favorites);

    }

    /** @test */
    function an_authenticated_user_can_unfavorite_a_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post('replies/' . $reply->id . '/favorites');
        $this->delete('replies/' . $reply->id . '/favorites');
        $this->assertCount(0, $reply->favorites);

    }

    /** @test */
    function an_authenticated_user_may_only_favorite_a_reply_once()
    {

        $this->signIn();
        $reply = create('App\Reply');

        $this->post('replies/' . $reply->id . '/favorites');
        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);

    }

}
