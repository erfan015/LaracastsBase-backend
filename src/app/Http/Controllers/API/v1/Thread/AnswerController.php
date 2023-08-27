<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Thread;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{

    public function index()
    {
          $threads= resolve(AnswerRepository::class)->getAllAnswers();

          return response()->json($threads,Response::HTTP_OK);
    }


    public function store(Request $request)
    {
       $request->validate([
           'content' => 'required',
           'thread_id' => 'required'
       ]);

       resolve(AnswerRepository::class)->store($request);

       return response()->json([
           'message' => 'answer for '.$request->thread_id.' create successfully'
       ],Response::HTTP_CREATED);
    }




    public function update(Request $request,Answer $answer)
    {
           $request->validate([
               'content' => 'required',

           ]);

        resolve(AnswerRepository::class)->update( $answer,$request); \\ repository design pattern


        return response()->json([
            'message' => 'update successfully'
        ],Response::HTTP_OK);


    }


    public function destroy(Answer $answer)
    {
        //
    }
}
