<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonJoinImageFileResource;
use App\Models\LessonJoinImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonJoinImageFileController extends Controller
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
     *      path="/api/lesson-join-image-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_image_file_index",
     *      tags={"Lesson_Join_Image_File"},
     *      summary="All lesson join image File",
     *      description="Hamma lesson join image filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/LessonJoinImageFile"),
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
        return LessonJoinImageFileResource::collection(LessonJoinImageFile::all());
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
     *      path="/api/lesson-join-image-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_image_file_store",
     *      tags={"Lesson_Join_Image_File"},
     *      summary="lesson_join_image File add",
     *      description="lesson join image filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson join image file save",
     *          @OA\JsonContent(required={"lesson_id", "image_file_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="image_file_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LessonJoinImageFile"),
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
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinImage = new LessonJoinImageFile();
            $lessonJoinImage->lesson_id = $request->lesson_id;
            $lessonJoinImage->image_file_id = $request->image_file_id;
            $lessonJoinImage->save();
            return $lessonJoinImage;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
     /**
 * @OA\Get(
 * path="/api/lesson-join-image-file/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show lesson join image file",
 * description="bitta lesson join image fileda hamma malumotlarini ko'rsatadi",
 * operationId="lesson_Join_Image_File_show",
 * tags={"Lesson_Join_Image_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="lesson_join_image file id",
 *    required=true,
 *    in="path",
 *    @OA\Schema(
 *    type="integer"
 *    )
 * ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/LessonJoinImageFile"),
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

    public function show($id)
    {
        return new LessonJoinImageFileResource(LessonJoinImageFile::find($id));
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinImageFile $lessonJoinImageFile)
    {
        return $lessonJoinImageFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
         /**
     * @OA\Put(
     *      path="/api/lesson-join-image-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_image_file_update",
     *      tags={"Lesson_Join_Image_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="lesson_join_image file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"lesson_id", "image_file_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="image_file_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(ref="#/components/schemas/LessonJoinImageFile"),
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
    public function update(Request $request, LessonJoinImageFile $lessonJoinImageFile)
    {
        $rules = [
            'lesson_id' => 'required',
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json($validator);
    }else{
        $lessonJoinImage = LessonJoinImageFile::find($lessonJoinImageFile->id);
        $lessonJoinImage->lesson_id = $request->lesson_id;
        $lessonJoinImage->image_file_id = $request->image_file_id;
        $lessonJoinImage->save();
        return $lessonJoinImage;
    }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Delete(
     *      path="/api/lesson-join-image-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_image_file_delete",
     *      tags={"Lesson_Join_Image_File"},
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
        $model = LessonJoinImageFile::find($id);
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
