<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
        DB::statement("PRAGMA foreign_keys=on");
        $this->withoutExceptionHandling();
    }

    protected function signIn($user = null)
    {
        $user = $user ? $user : create('App\User');

        $this->actingAs($user);

        return $this;
    }
}
