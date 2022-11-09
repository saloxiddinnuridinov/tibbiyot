<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'activateUser', 'resetPasswordVerify']]);
    }

    public function activateUser(Request $request)
    {
        $login = $request->phone;
        $verify  = $request->verify_code;
        $user = User::where('phone', $login)->first();
        if ($user) {
            if ($user->status == 'inactive') {
                if ($user->verify_code == $verify) {
                    $user->status = 'active';
                    $user->update();
                    $token = auth()->login($user);
                    $user = auth()->user();
                    return response()->json(['data' => $user, 'message' => 'success', 'authorization' => $this->respondWithToken($token)], 200);
                } else {
                    return response()->json(['data' => [], 'errors' => ['verify_code' => 'Verify code is wrong', 'verify' => $user->verify_code]], 400);
                }
            } else {
                return response()->json(['data' => $user, 'message' => 'This user already active'], 200);
            }
        } else {
            return response()->json(['data' => [], 'message' => 'User not found'], 404);
        }
    }
    /** 
     *     @OA\Post (
     *      path="/api/reset-password",
     *      tags={"Auth"},
     *      summary="reset Password",
     *      security={{"bearerAuth":{}}},
     *      description="Verification",
     *       @OA\RequestBody(
     *          required=true,
     *          description="Reset Password",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"password","new_password","new_password_confirmation"},
     *                  @OA\Property(property="password", type="string", format="text", example="admin123"),
     *                  @OA\Property(property="new_password", type="string", format="text", example="admin1234"),
     *                  @OA\Property(property="new_password_confirmation", type="string", format="text", example="admin1234"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="User created successfully"),
     *              @OA\Property(property="user", type="string", example="{name,surname . . .}"),
     *              @OA\Property(property="authorization", type="string", example="{token,type}"),
     *          ),
     *      )
     * )
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required'],
            'new_password' => ['required', 'confirmed'],
        ]);
        $user = auth()->user();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->update();
                return response()->json(['data' => [], 'success' => 'Password updated'], 200);
            } else {
                return response()->json(['data' => [], 'errors' => ['password' => 'Wrong password!']], 400);
            }
        } else {
            return response()->json(['data' => [], 'errors' => ['user' => 'User not found']], 404);
        }
    }
    /**
     *     @OA\Post (
     *      path="/api/reset-password-verify",
     *      tags={"Auth"},
     *      summary="reset Password Verify",     
     *      description="Reset Password Verification ",
*       @OA\RequestBody(
     *          required=true,
     *          description="Reset Password",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"phone","verify_code","password","password_confirmation"},
     *                  @OA\Property(property="phone", type="integer", format="number", example=998997775443),
     *                  @OA\Property(property="verify_code", type="integer", format="number", example=123456),
     *                  @OA\Property(property="password", type="string", format="text", example="admin123"),
     *                  @OA\Property(property="password_confirmation", type="string", format="text", example="admin123"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="User created successfully"),
     *              @OA\Property(property="user", type="string", example="{name,surname . . .}"),
     *              @OA\Property(property="authorization", type="string", example="{token,type}"),
     *          ),
     *      )
     * )
     */
    public function resetPasswordVerify(Request $request)
    {
        $request->validate([
            'phone' => ['required'],
            'verify_code' => ['required', 'numeric'],
            'password' => ['required', 'confirmed'],
        ]);
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if ($user) {
            if ($user->verify_code == $request->verify_code) {
                $user->password = Hash::make($request->password);
                $user->update();
                return response()->json(['data' => [], 'success' => 'Password updated'], 200);
            } else {
                return response()->json(['data' => [], 'errors' => ['verify' => 'Wrong verify code!']], 400);
            }
        } else {
            return response()->json(['errors' => ['user' => 'User not found']], 404);
        }
    }
    /**
    * @OA\Post (
     *      path="/api/verify",
     *      tags={"Auth"},
     *      summary="Verify",
     *      description="Verification",
     *       @OA\RequestBody(
     *          required=true,
     *          description="Verify",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"phone","verify_code"},
     *                  @OA\Property(property="phone", type="integer", format="number", example=998997775443),
     *                  @OA\Property(property="verify_code", type="integer", format="number", example=123456),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="User created successfully"),
     *              @OA\Property(property="user", type="string", example="{name,surname . . .}"),
     *              @OA\Property(property="authorization", type="string", example="{token,type}"),
     *          ),
     *      )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $email = request('email');
        $password = request('password');
        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                if ($token = auth()->attempt($credentials)) {
                    if ($user->status == 'active') {
                        $this->me($token);
                        $user = auth()->user();
                        return response()->json(['data' => $user, 'authorization' => $this->respondWithToken($token)], 200);
                    } else {
                        return response()->json(['data' => [], 'errors' => ['user' => 'User is not active']], 403);
                    }
                } else {
                    return response()->json(['data' => [], 'errors' => ['authorization' => 'Unauthorization']], 401);
                }
            } else {
                return response()->json(['data' => [], 'errors' => ['password' => 'Wrong password!']], 403);
            }
        } else {
            return response()->json(['data' => [], 'errors' => ['email' => 'User not found']], 404);
        }
    }
    /**  @OA\Post (
     *      path="/api/login",
     *      tags={"Auth"},
     *      summary="Login user",
     * security={{"bearerAuth":{}}},
     *      description="Authorization",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Login",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"email","password"},
     *                  @OA\Property(property="email", type="string", format="text", example="gibson.luz@example.com"),
     *                  @OA\Property(property="password", type="string", format="text", example="user"),
     
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error: Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid"),
     *              @OA\Property(property="errors", type="string", example="{error data}"),
     *          ),
     *      ),
     * )
     */

public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required','unique:users,email'],
            'phone' => ['required','unique:users,phone'],
            'password' => 'required|confirmed',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }else{
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        }
        
        $verify =  $this->sendVerify($user);
        return response()->json(['data' => $user, 'success' => 'Successfully registrated', 'verify' => $verify], 200);
    }
    /** 
     *  @OA\Post (
     *      path="/api/register",
     *      tags={"Auth"},
     *      summary="Register",
     *      description="Returns columns of cart belongs to User",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Register page",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"name","surname","phone","password","email","password_confirmation"},
     *                  @OA\Property(property="name", type="string",  example="John"),
     *                  @OA\Property(property="surname", type="string", example="Doe"),
     *                  @OA\Property(property="email", type="string", example="admin@gmail.com"),
     *                  @OA\Property(property="phone", type="integer", example="998997775443"),
     *                  @OA\Property(property="password", type="string", example="admin123"),
     * * @OA\Property(property="password_confirmation", type="string", format="text", example="admin123"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="User created successfully"),
     *              @OA\Property(property="user", type="string", example="{name,surname . . .}"),
     *              @OA\Property(property="authorization", type="string", example="{token,type}"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Error: Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid"),
     *              @OA\Property(property="errors", type="string", example="{error data}"),
     *          ),
     *      ),
     * ),
     */
    public function sendVerify($user)
    {
        $verify_code = rand(100000, 999999);
        $user->verify_code = $verify_code;
        $user->update();
        return response()->json(['data' => [], 'success' => 'Activation code sent', 'verify' => $verify_code], 200);
    }
    
    public function me()
    {
        return response()->json(auth()->user());
    }
    /** 
     * @OA\Post(
     *    path="/api/logout",
     *    tags={"Auth"},
     *    security={{"bearerAuth":{}}},
     *    summary="Log out",
     *    description="Returns columns of cart belongs to user",
     *    @OA\Response(response=200, description="Success"),
     *    @OA\Response(response=401, description="Returns when user is not authenticated"),
     * )
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['data' => [], 'success' => 'Successfully logged out']);
    }

    /**
     * @OA\Post(
     *    path="/api/refresh",
     *    tags={"Auth"},
     *    security={{"bearerAuth":{}}},
     *    summary="Refresh token",
     *    description="Returns columns of cart belongs to user",
     *    @OA\Response(response=200, description="Success"),
     *    @OA\Response(response=401, description="Returns when user is not authenticated"),
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
    ////
}