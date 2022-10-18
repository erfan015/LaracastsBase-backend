<?php

namespace App\Http\Controllers\API\v1\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use DeepCopy\Filter\ReplaceFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    public function getAllChannelsList()
    {

        $channellists=resolve(ChannelRepository::class)->all(); // dependency injection

        return response()->json($channellists,Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createNewChannel(Request $request): JsonResponse
    {
        $request->validate([

            'name' => ['required']
        ]);


        // insert channel to database
        resolve(ChannelRepository::class)->create($request);

        return response()->json([
            "channel create successfully"
        ], Response::HTTP_CREATED);
    }


    public function updateChannel(Request $request)
    {
        $request->validate([

            'name' => ['required']
        ]);

        resolve(ChannelRepository::class)->update($request); // dependency inject

        return response()->json([
            'edit successfully'
        ],Response::HTTP_OK);
    }


    public function deleteChannel(Request $request)
    {
        $request->validate([

            'id' => ['required']
        ]);

        resolve(ChannelRepository::class)->delete($request);

        return response()->json([

            'message' => 'deleted successfully'
        ],Response::HTTP_OK);

    }

}
