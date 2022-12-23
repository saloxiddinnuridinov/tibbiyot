<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    protected $dataError = 
    [
        'data' => [],
        'errors' => 'Not found'
    ];
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Get(
     *      path="/api/user",
     *      security={{"bearerAuth":{}}},
     *      operationId="user_index",
     *      tags={"User"},
     *      summary="All User",
     *      description="Hamma Userlarni korish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/User"),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/user",
     *      security={{"bearerAuth":{}}},
     *      operationId="user_store",
     *      tags={"User"},
     *      summary="new User add",
     *      description="Yangi student qoshish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="user save",
     *          @OA\JsonContent(required={"name", "surname", "email", "password", "phone", "status", "is_bloced"},
     *          @OA\Property(property="name", type="string", format="text", example="salohiddin"),
     *          @OA\Property(property="surname", type="string", format="text", example="Nuriddinov"),
     *          @OA\Property(property="email", type="string", format="text", example="lorenzo.emmerich@example.com"),
     *          @OA\Property(property="password", type="string", format="text", example="user"),
     *          @OA\Property(property="phone", type="string", format="text", example="+998911234567"),
     *          @OA\Property(property="status", type="string", format="text", example="active"),
     *          @OA\Property(property="is_bloced", type="number", format="number", example="1"),
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User"),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )

     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'required',
            'phone' =>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $user = new User;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->email_verified_at = $request->email_verified_at;
            $user->password = $request->password;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->is_bloced = $request->is_bloced;
            $user->save();
            return $user;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
   /**
 * @OA\Get(
 * path="/api/user/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show user",
 * description="bitta studentni hamma malumotlarini ko'rsatadi",
 * operationId="user_show",
 * tags={"User"},
 * @OA\Parameter(
 *    name="id",
 *    description="Project id",
 *    required=true,
 *    in="path",
 *    @OA\Schema(
 *    type="integer"
 *    )
 * ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *                  @OA\JsonContent(ref="#/components/schemas/User"),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(User $user)
    {
        return $user;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $user;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/user/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="user_update",
     *      tags={"User"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="user update",
     *          @OA\JsonContent(required={"name", "surname", "email", "password", "phone", "status", "is_bloced"},
     *          @OA\Property(property="name", type="string", format="text", example="salohiddin"),
     *          @OA\Property(property="surname", type="string", format="text", example="Nuriddinov"),
     *          @OA\Property(property="email", type="string", format="text", example="lorenzo.emmerich@example.com"),
     *          @OA\Property(property="password", type="string", format="text", example="user"),
     *          @OA\Property(property="phone", type="string", format="text", example="+998911234567"),
     *          @OA\Property(property="status", type="string", format="text", example="active"),
     *          @OA\Property(property="is_bloced", type="number", format="number", example="1")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(ref="#/components/schemas/User"),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * ),
     * ),
     * )
     */

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|exists:users,email',
            'password' =>'required',
            'phone' =>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $user_update = User::find($user->id);
            $user_update->name = $request->name;
            $user_update->surname = $request->surname;
            $user_update->email = $request->email;
            $user_update->email_verified_at = $request->email_verified_at;
            $user_update->password = $request->password;
            $user_update->phone = $request->phone;
            $user_update->status = $request->status;
            $user_update->is_bloced = $request->is_bloced;
            $user_update->save();
            return $user_update;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/user/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="user_delete",
     *      tags={"User"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        $model = User::find($id);
        if($model){
            try {
                $model->delete();
                return response()->json([
                    'message' => "O`chirildi", 
                    ],200);
                }catch (\Throwable $th) {
                    return response()->json([
                        "errors" =>["$th"],
                    ], 403);
                }
            }
            return response()->json(['errors' => ['Not found']], 404);
    }
}
