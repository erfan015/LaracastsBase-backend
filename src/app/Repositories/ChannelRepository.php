<?php

namespace App\Repositories;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{


    /**
     * show all channels
     */

    public function all()
    {
        return Channel::all();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        Channel::create([

            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
    }

    /**
     * update channel by id and name
     * @param Request $request
     * @return void
     */
    public function update(Request $request):void
    {
        Channel::find($request->id)->update([

            'name' => $request->name,
            'slug' =>Str::slug($request->name),

        ]);

    }

    /**
     * delete channel by id
     * @param Request $request
     * @return void
     *
     */

    public function delete(Request $request) : void
    {
        Channel::destroy($request->id);
    }
}
