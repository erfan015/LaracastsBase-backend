<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Repositories\ThreadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{
    public function index()
    {
       $threads= resolve(ThreadRepository::class)->getAllAvailablethreads();

        return response()->json($threads,Response::HTTP_OK);
    }

    public function show($slug)
    {
         $thread = resolve(ThreadRepository::class)->getThreadBySlug($slug);

         return  response()->json($thread,Response::HTTP_OK);
    }

    public function store(Request $request)
    {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'channel_id' => 'required'
            ]);


        resolve(ThreadRepository::class)->store($request);

            return \response()->json([
               'message' => 'thread create successfully'
            ],Response::HTTP_CREATED);
    }

    public function update(Request $request,Thread $thread)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'channel_id' => 'required'
        ]);


        resolve(ThreadRepository::class)->edit( $thread,$request);

        return response()->json([
            'message' => 'thread create successfully'
        ],Response::HTTP_OK);
    }
}
