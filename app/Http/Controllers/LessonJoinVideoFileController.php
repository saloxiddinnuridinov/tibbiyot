<?php

namespace App\Http\Controllers;

use App\Models\LessonJoinVideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LessonJoinVideoFileController extends Controller
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
     *      path="/api/lesson-join-video/file",
     * security={{"bearerAuth":{}}},
     *      operationId="lesson_join_video_file_index",
     *      tags={"Lesson_Join_Video_File"},
     *      summary="All lesson join video File",
     *      description="Hamma lesson join video filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="lesson_id", type="integer", example="5"),
     *               @OA\Property(property="video_file_id", type="integer", example="4")
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
        $model = LessonJoinVideoFile::get();
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
     *      path="/api/lesson-join-video/file",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_video_file_store",
     *      tags={"Lesson_Join_Video_File"},
     *      summary="lesson_join_video File add",
     *      description="lesson join video filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson join video file save",
     *          @OA\JsonContent(required={"lesson_id", "video_file_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="video_file_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="lesson_id", type="integer", example="Harley"),
     *               @OA\Property(property="video_file_id", type="integer", example="Harley")
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
            'video_file_id' => 'required',
        ];
        $validator = Validator ::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinVideo = new LessonJoinVideoFile();
            $lessonJoinVideo->lesson_id = $request->lesson_id;
            $lessonJoinVideo->video_file_id = $request->video_file_id;
            $lessonJoinVideo->save();
            return $lessonJoinVideo;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
 /**
 * @OA\Get(
 * path="/api/lesson-join-video/file/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show lesson join video file",
 * description="bitta lesson join video fileda hamma malumotlarini ko'rsatadi",
 * operationId="lesson_Join_video_File_show",
 * tags={"Lesson_Join_Video_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="lesson_join_video file id",
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
     *               @OA\Property(property="video_file_id", type="integer", example="Harley")
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
    public function show(LessonJoinVideoFile $lessonJoinVideoFile)
    {
        return $lessonJoinVideoFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinVideoFile $lessonJoinVideoFile)
    {
        return $lessonJoinVideoFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Put(
     *      path="/api/lesson-join-video/file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_video_file_update",
     *      tags={"Lesson_Join_Video_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="lesson_join_video file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"lesson_id", "video_file_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="video_file_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="lesson_id", type="integer", example="Harley"),
     *               @OA\Property(property="video_file_id", type="integer", example="Harley")
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
    public function update(Request $request, LessonJoinVideoFile $lessonJoinVideoFile)
    {
        $rules = [
            'lesson_id' => 'required',
            'video_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lessonJoinVideo = LessonJoinVideoFile::find($lessonJoinVideoFile->id);
            $lessonJoinVideo->lesson_id = $request->lesson_id;
            $lessonJoinVideo->video_file_id = $request->video_file_id;
            $lessonJoinVideo->save();
            return $lessonJoinVideo;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Delete(
     *      path="/api/lesson-join-video/file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_video_file_delete",
     *      tags={"Lesson_Join_Video_File"},
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
    public function destroy(LessonJoinVideoFile $lessonJoinVideoFile)
    {
        $lessonJoinVideoFile->delete();
        return LessonJoinVideoFile::all();
    }
}
