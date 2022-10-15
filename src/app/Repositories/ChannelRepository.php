<?php

namespace App\Repositories;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{
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
}
