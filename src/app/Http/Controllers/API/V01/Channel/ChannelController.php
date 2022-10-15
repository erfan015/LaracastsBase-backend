<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function getAllChannelsList()
    {
        return response()->json(Channel::all(),'200');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createNewChannel(Request $request) : JsonResponse
    {
        $request->validate([

            'name' => ['required']
        ]);


        // insert channel to database
        resolve(ChannelRepository::class)->create($request);

        return response()->json([
            "channel create successfully"
        ],'201');
    }


}
