<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
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
     *      path="/api/auth/lesson",
     *      operationId="lesson_index",
     *      tags={"Lessons"},
     *      summary="All Lessons",
     *      description="Hamma Dars(Lesson)larrni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="title_uz", type="string", example="Harley"),
     *                @OA\Property(property="title_ru", type="string", example="Augustus"),
     *               @OA\Property(property="category_id", type="number", example="3"),
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
        $lesson = Lesson::all();
        return $lesson;
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
    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/auth/lesson",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_store",
     *      tags={"Lessons"},
     *      summary="new Lesson add",
     *      description="Yangi Lesson qoshish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson save",
     *          @OA\JsonContent(required={"title_uz", "title_ru", "category_id"},
     *               @OA\Property(property="title_uz", type="string", format="text", example="Harley"),
     *               @OA\Property(property="title_ru", type="string", format="text", example="Augustus"),
     *               @OA\Property(property="category_id", type="number", format="number", example="2"),
    *      ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="title_uz", type="string", example="Harley"),
     *               @OA\Property(property="title_ru", type="string", example="Augustus"),
     *               @OA\Property(property="catoegory_id", type="number", example="3"),
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
        $rules = [
            'title_uz' => 'required',
            'title_ru' => 'required',
            'category_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lesson = new Lesson();
            $lesson->title_ru = $request->title_ru;
            $lesson->title_uz = $request->title_uz;
            $lesson->category_id = $request->category_id;
            $lesson->save();
            return $lesson;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
/**
 * @OA\Get(
 * path="/api/auth/lesson/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show Lesson",
 * description="bitta Lessonni hamma malumotlarini ko'rsatadi",
 * operationId="lesson_show",
 * tags={"Lessons"},
 * @OA\Parameter(
 *    name="id",
 *    description="Lesson id",
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
     *               @OA\Property(property="title_uz", type="string", example="Harley"),
     *               @OA\Property(property="title_ru", type="string", example="Augustus"),
     *               @OA\Property(property="catoegory_id", type="number", example="3"),
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
    public function show(Lesson $lesson)
    {
        return $lesson;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return $lesson;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/auth/lesson/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_update",
     *      tags={"Lessons"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="lesson id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson update",
     *          @OA\JsonContent(required={"title_uz", "title_ru", "category_id"},
     *               @OA\Property(property="title_uz", type="string", format="text", example="Harley"),
     *               @OA\Property(property="title_ru", type="string", format="text", example="Augustus"),
     *               @OA\Property(property="category_id", type="number", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="title_uz", type="string", example="Harley"),
     *               @OA\Property(property="title_ru", type="string", example="Augustus"),
     *               @OA\Property(property="catoegory_id", type="number", example="3"),
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
    public function update(Request $request, Lesson $lesson)
    {
        $rules = [
            'title_uz' => 'required',
            'title_ru' => 'required',
            'category_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lesson_update = Lesson::find($lesson->id);
            $lesson_update->title_ru = $request->title_ru;
            $lesson_update->title_uz = $request->title_uz;
            $lesson_update->category_id = $request->category_id;
            $lesson_update->save();
            return $lesson_update;
    }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
/**
     * @OA\Delete(
     *      path="/api/auth/lesson/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_delete",
     *      tags={"Lessons"},
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
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return Lesson::all();
    }
}
