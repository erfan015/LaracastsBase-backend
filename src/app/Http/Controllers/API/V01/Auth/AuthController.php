<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    /**
     * @method Post
     * @param Request $request
     */
    public function register(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
           ]);

        resolve(UserRepository::class)->create($request);

        return response()->json([
            "message" => "user create successfully"
        ], '201');


    }


    /**
     * @method Get
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request):JsonResponse
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only(['email','password'])))
        {
            return response()->json(Auth::user(),'200');
        }

//        return response()->json(['faild'],400);

         throw ValidationException::withMessages([
             'email' => 'incorrect credential'
         ]);

    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'you logged out'
        ],200);
    }


}
