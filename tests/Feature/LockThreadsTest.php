<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LockThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function non_administrators_may_not_lock_threads()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread', [
            'user_id' => auth()->id()
        ]);

        $this->post(route('locked-threads.store', $thread))->assertStatus(403);

        $this->assertFalse((bool) $thread->fresh()->locked);
    }

    /** @test */
    function administrators_may_lock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $thread = create('App\Thread', [
            'user_id' => auth()->id()
        ]);

        $this->post(route('locked-threads.store', $thread));

        $this->assertTrue((bool) $thread->fresh()->locked, 'Failed asserting that thread was locked');
    }

    /** @test */
    function administrators_may_unlock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $thread = create('App\Thread', [
            'user_id' => auth()->id(),
            'locked'  => true
        ]);

        $this->delete(route('locked-threads.destroy', $thread));

        $this->assertFalse((bool) $thread->fresh()->locked, 'Failed asserting that thread was locked');
    }


    /** @test */
    function once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->signIn();

        $thread = create('App\Thread', ['locked' => true]);

        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => create('App\User')->id
        ])->assertStatus(422);
    }
}
