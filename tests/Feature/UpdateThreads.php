<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->signIn();

    }


    /** @test */
    function a_thread_can_be_updated_by_its_creator()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body' => 'Changed body'
        ]);

        $this->assertEquals("Changed", $thread->fresh()->title);
        $this->assertEquals("Changed body", $thread->fresh()->body);
    }

    /** @test */
    public function a_thread_requires_title_and_body_to_be_updated()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed'
        ])->assertSessionHasErrors('body');


        $this->patch($thread->path(), [
            'body' => 'Changed'
        ])->assertSessionHasErrors('title');
    }


    /** @test */
    function unauthorized_user_may_not_update_threads()
    {
        $thread = create('App\Thread', ['user_id' => create(User::class)->id]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body' => 'Changed body'
        ])->assertStatus(403);
    }
}
