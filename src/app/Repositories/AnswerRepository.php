<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Request;


class AnswerRepository
{

    public function getAllAnswers()
    {
      return Answer::query()->latest()->get();
    }


    public function store(Request $request) :void
    {
       Thread::find($request->thread_id)->answers()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
       ]);
    }

    public function update( Answer $answer , Request $request)
    {
        $answer->update([
            'content' => $request->input('content'),
        ]);
    }
}
