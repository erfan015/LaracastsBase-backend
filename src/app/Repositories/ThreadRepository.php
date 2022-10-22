<?php

namespace App\Repositories;

use App\Models\Thread;

class ThreadRepository
{
    public function getAllAvailablethreads()
    {
        Thread::whereFlag(1)->latest()->get();
    }

    public function getThreadBySlug($slug)
    {
        Thread::whereSlug($slug)->whereFlag(1)->first();
    }
}
