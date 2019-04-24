<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Trending;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Trending $trending)
    {


        if(request()->expectsJson()) {
            $search = request('q');

            $threads =  Thread::search($search)->paginate(25);

            return $threads;
        }

        return view('threads.search', [
            'trending' => $trending->get()
        ]);
    }
}
