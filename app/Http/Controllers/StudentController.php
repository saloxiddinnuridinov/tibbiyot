<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/student",
     *      operationId="student_index",
     *      tags={"Student"},
     *      summary="All Students",
     *      description="Hamma studentlarni korish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name", type="string", example="Harley"),
     *                @OA\Property(property="surname", type="string", example="Augustus"),
     *               @OA\Property(property="email", type="string", example="gibson.luz/@example.com"),
     *               @OA\Property(property="email_varified_at", type="string", example="2022-10-19 12:45:53"),
     *               @OA\Property(property="status", type="enum", example="active"),
     *               @OA\Property(property="block_reason", type="string", example="At alias quae esse in ut. Distinctio et quos modi assumenda earum recusandae."),
     *               @OA\Property(property="is_blocked", type="number", example="0"),
     *               @OA\Property(property="balance", type="string", example="6275"),
     *               @OA\Property(property="birthday", type="datetime", example="1987-08-29"),
     *        )
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
        $model = Student::get();
        return $model;
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
     * Store a newly created resource n storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/student",
     *      security={{"bearerAuth":{}}},
     *      operationId="student_store",
     *      tags={"Student"},
     *      summary="new Student add",
     *      description="Yangi student qoshish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="user save",
     *          @OA\JsonContent(required={"name", "surname", "email", "status", "balance", "birthday"},
     *               @OA\Property(property="name", type="string", format="text", example="Harley"),
     *               @OA\Property(property="surname", type="string", format="text", example="Augustus"),
     *               @OA\Property(property="email", type="string", format="text", example="gibson.luz@example.com"),
     *               @OA\Property(property="status", type="enum", format="text", example="active"),
     *               @OA\Property(property="balance", type="string", format="number", example="6275"),
     *               @OA\Property(property="birthday", type="datetime", format="number", example="1987-08-29")
     *      ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name", type="string", example="Harley"),
     *               @OA\Property(property="surname", type="string", example="Augustus"),
     *               @OA\Property(property="email", type="string", example="gibson.luz/@example.com"),
     *               @OA\Property(property="email_varified_at", type="string", example="2022-10-19 12:45:53"),
     *               @OA\Property(property="status", type="enum", example="active"),
     *               @OA\Property(property="block_reason", type="string", example="At alias quae esse in ut. Distinctio et quos modi assumenda earum recusandae."),
     *               @OA\Property(property="is_blocked", type="number", example="0"),
     *               @OA\Property(property="balance", type="string", example="6275"),
     *               @OA\Property(property="birthday", type="datetime", example="1987-08-29"),
     *        )
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
        // return $request->all();

        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $student = new Student();
            $student->name = $request->name;
            $student->surname = $request->surname;
            $student->email = $request->email;
            $student->email_verified_at = $request->email_verified_at;
            $student->status = $request->status;
            $student->block_reason = $request->block_reason;
            $student->is_blocked = $request->is_blocked;
            $student->password = $request->password;
            $student->balance = $request->balance;
            $student->birthday = $request->birthday;
            $student->save();
            return $student;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
/**
 * @OA\Get(
 * path="/api/student/{id}",
 * summary="Show Student",
 * description="bitta studentni hamma malumotlarini ko'rsatadi",
 * operationId="student_show",
 * tags={"Student"},
 * @OA\Parameter(
 *    name="id",
 *    description="Student id",
 *    required=true,
 *    in="path",
 *    @OA\Schema(
 *    type="integer"
 *    )
 * ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *                   @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name", type="string", example="Harley"),
     *               @OA\Property(property="surname", type="string", example="Augustus"),
     *               @OA\Property(property="email", type="string", example="gibson.luz/@example.com"),
     *               @OA\Property(property="email_varified_at", type="string", example="2022-10-19 12:45:53"),
     *               @OA\Property(property="status", type="enum", example="active"),
     *               @OA\Property(property="block_reason", type="string", example="At alias quae esse in ut. Distinctio et quos modi assumenda earum recusandae."),
     *               @OA\Property(property="is_blocked", type="number", example="0"),
     *               @OA\Property(property="balance", type="string", example="6275"),
     *               @OA\Property(property="birthday", type="datetime", example="1987-08-29"),
     * )
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

    public function show(Student $student)
    {
        return $student;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return $student; 
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/student/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="student_update",
     *      tags={"Student"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="student id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="student update",
     *          @OA\JsonContent(required={"name", "surname", "email", "status", "balance", "birthday"},
     *               @OA\Property(property="name", type="string", format="text", example="Harley"),
     *               @OA\Property(property="surname", type="string", format="text", example="Augustus"),
     *               @OA\Property(property="email", type="string", format="text", example="gibson.luz@example.com"),
     *               @OA\Property(property="status", type="enum", format="text", example="active"),
     *               @OA\Property(property="balance", type="string", format="number", example="6275"),
     *               @OA\Property(property="birthday", type="datetime", format="number", example="1987-08-29")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name", type="string", example="Harley"),
     *               @OA\Property(property="surname", type="string", example="Augustus"),
     *               @OA\Property(property="email", type="string", example="gibson.luz/@example.com"),
     *               @OA\Property(property="email_varified_at", type="string", example="2022-10-19 12:45:53"),
     *               @OA\Property(property="status", type="enum", example="active"),
     *               @OA\Property(property="block_reason", type="string", example="At alias quae esse in ut. Distinctio et quos modi assumenda earum recusandae."),
     *               @OA\Property(property="is_blocked", type="number", example="0"),
     *               @OA\Property(property="balance", type="string", example="6275"),
     *               @OA\Property(property="birthday", type="datetime", example="1987-08-29"),
     *          )
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

    public function update(Request $request, Student $student)
    {
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json($validator);
    }else{
        
        $update_student = Student::find($student->id);
        $update_student->name = $request->name;
        $update_student->surname = $request->surname;
        $update_student->email = $request->email;
        $update_student->email_verified_at = $request->email_verified_at;
        $update_student->status = $request->status;
        $update_student->block_reason = $request->block_reason;
        $update_student->is_blocked = $request->is_blocked;
        $update_student->password = $request->password;
        $update_student->balance = $request->balance;
        $update_student->birthday = $request->birthday;
        $update_student->save();
        return $update_student;
    }
    }
    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/student/{id}",
     *  security={{"bearerAuth":{}}},
     *      operationId="student_delete",
     *      tags={"Student"},
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

    public function destroy(Student $student)
    {
        $student->delete();
        return Student::all();
    }
}
