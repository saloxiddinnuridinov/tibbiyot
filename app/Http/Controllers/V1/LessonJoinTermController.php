<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonJoinTermResource;
use App\Models\LessonJoinTerm;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonJoinTermController extends Controller
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
     *      path="api/lesson-join-term",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_term_index",
     *      tags={"Lesson_Join_Term"},
     *      summary="All lesson join image File",
     *      description="Hamma lesson join Term filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/LessonJoinTerms"),
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
        return LessonJoinTermResource::collection(LessonJoinTerm::all());
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
     *      path="api/lesson-join-term",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_term_store",
     *      tags={"Lesson_Join_Term"},
     *      summary="lesson_join_image File add",
     *      description="lesson join image filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson join image file save",
     *          @OA\JsonContent(required={"lesson_id", "term_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="term_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LessonJoinTerms"),
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
            'term_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinTerm = new LessonJoinTerm();
            $lessonJoinTerm->lesson_id = $request->lesson_id;
            $lessonJoinTerm->term_id = $request->term_id;
            $lessonJoinTerm->save();
            return $lessonJoinTerm;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="api/lesson-join-term{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show lesson join image file",
 * description="bitta lesson join image fileda hamma malumotlarini ko'rsatadi",
 * operationId="lesson_Join_term_show",
 * tags={"Lesson_Join_Term"},
 * @OA\Parameter(
 *    name="id",
 *    description="lesson join image file id",
 *    required=true,
 *    in="path",
 *    @OA\Schema(
 *    type="integer"
 *    )
 * ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/LessonJoinTerms"),
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
        return new LessonJoinTermResource(LessonJoinTerm::find($id));
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinTerm $lessonJoinTerm)
    {
        return $lessonJoinTerm;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="api/lesson-join-term{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_term_update",
     *      tags={"Lesson_Join_Term"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="lesson join image file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"lesson_id", "term_id"},
     *               @OA\Property(property="lesson_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="term_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(ref="#/components/schemas/LessonJoinTerms"),
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
    public function update(Request $request, LessonJoinTerm $lessonJoinTerm)
    {
        $rules = [
            'lesson_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lessonJoinTerms = LessonJoinTerm::find($lessonJoinTerm->id);
            $lessonJoinTerms->lesson_id = $request->lesson_id;
            $lessonJoinTerms->term_id = $request->term_id;
            $lessonJoinTerms->save();
            return $lessonJoinTerms;
    }
}

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="api/lesson-join-term{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="lesson_join_term_delete",
     *      tags={"Lesson_Join_Term"},
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
        $model = LessonJoinTerm::find($id);
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
