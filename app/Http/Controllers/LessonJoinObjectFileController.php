<?php

namespace App\Http\Controllers;

use App\Models\LessonJoinObjectFile;
use App\Models\ObjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\ObjectType;

class LessonJoinObjectFileController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/auth/lesson/join/object/file",
     *      operationId="lesson_join_object_file_index",
     *      tags={"Lesson_Join_Object_File"},
     *      summary="All lesson join object File",
     *      description="Hamma lesson join object filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="lesson_id", type="integer", example="5"),
     *               @OA\Property(property="object_file_id", type="integer", example="4")
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
        $model = LessonJoinObjectFile::get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/auth/lesson/join/object/file",
     *      operationId="lesson_join_object_file_store",
     *      tags={"Lesson_Join_Object_File"},
     *      summary="lesson_join_object File add",
     *      description="lesson join object filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson join object file save",
     *          @OA\JsonContent(required={"lesson_id", "object_file_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="object_file_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="lesson_id", type="integer", example="Harley"),
     *               @OA\Property(property="object_file_id", type="integer", example="Harley")
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
            'lesson_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinObject = new LessonJoinObjectFile();
            $lessonJoinObject->lesson_id = $request->lesson_id;
            $lessonJoinObject->object_file_id = $request->object_file_id;
            $lessonJoinObject->save();
            return $lessonJoinObject;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
 /**
 * @OA\Get(
 * path="/api/auth/lesson/join/object/file/{id}",
 * summary="Show lesson join object file",
 * description="bitta lesson join object fileda hamma malumotlarini ko'rsatadi",
 * operationId="lesson_Join_Object_File_show",
 * tags={"Lesson_Join_Object_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="lesson_join_object file id",
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
     *               @OA\Property(property="lesson_id", type="integer", example="Harley"),
     *               @OA\Property(property="object_file_id", type="integer", example="Harley")
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
    public function show(LessonJoinObjectFile $lessonJoinObjectFile)
    {
        return $lessonJoinObjectFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinObjectFile $lessonJoinObjectFile)
    {
        return $lessonJoinObjectFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Put(
     *      path="/api/auth/lesson/join/object/file/{id}",
     *      operationId="lesson_join_object_file_update",
     *      tags={"Lesson_Join_Object_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="lesson_join_object file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"lesson_id", "object_file_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="object_file_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="lesson_id", type="integer", example="Harley"),
     *               @OA\Property(property="object_file_id", type="integer", example="Harley")
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
    public function update(Request $request, LessonJoinObjectFile $lessonJoinObjectFile)
    {
        $rules = [
            'lesson_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lessonJoinObject = LessonJoinObjectFile::find($lessonJoinObjectFile->id);
            $lessonJoinObject->lesson_id = $request->lesson_id;
            $lessonJoinObject->object_file_id = $request->object_file_id;
            $lessonJoinObject->save();
            return $lessonJoinObject;
    }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Delete(
     *      path="/api/auth/lesson/join/object/file/{id}",
     *      operationId="lesson_join_object_file_delete",
     *      tags={"Lesson_Join_Object_File"},
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
    public function destroy(LessonJoinObjectFile $lessonJoinObjectFile)
    {
        $lessonJoinObjectFile->delete();
        return LessonJoinObjectFile::all();
    }
}
