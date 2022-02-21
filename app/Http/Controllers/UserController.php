<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @OA\Info(title="UserController", version="0.1")
     * @OA\Get(
     *      path="/blog/public/api/users",
     *      tags={"users"},
     *      summary="Get list of users",
     *      description="return list of user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     )
     */

    public function index()
    {
        $user =  User::all();

        return $user;
    }
}
