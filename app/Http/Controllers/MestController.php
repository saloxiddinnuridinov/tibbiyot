<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/term",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_index",
     *      tags={"Terms"},
     *      summary="All Terms",
     *      description="Hamma Terminlarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *        @OA\JsonContent(ref="#/components/schemas/Terms"),
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
       
    }


    public function create()
    {
        //
    }
    
    /**
     * @OA\Post(
     *      path="/api/term",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_store",
     *      tags={"Terms"},
     *      summary="new Trems add",
     *      description="Yangi Terms qoshish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson save",
     *           @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"keyword_latin", "keyword_ru", "keyword_uz", "description_uz", "description_ru"},
     *                  @OA\Property(property="keyword_latin", type="string", format="text", example="Harley"),
     *                   @OA\Property(property="keyword_ru", type="string", format="text", example="Augustus"),
     *                 @OA\Property(property="keyword_uz", type="string", format="text", example="2"),
     *                 @OA\Property(property="description_uz", type="string", format="text", example="2"),
     *                 @OA\Property(property="description_ru", type="string", format="text", example="2"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Terms"),
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
           
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
         
        }
    }
/**
 * @OA\Get(
 * path="/api/term/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show term",
 * description="bitta termda hamma malumotlarini ko'rsatadi",
 * operationId="term_show",
 * tags={"Terms"},
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
 *          @OA\JsonContent(ref="#/components/schemas/Terms"),
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
       
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }
    /**
     * @OA\Put(
     *      path="/api/term/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_update",
     *      tags={"Terms"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="term id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"keyword_latin", "keyword_ru", "keyword_uz", "description_uz", "description_ru"},
     *                  @OA\Property(property="keyword_latin", type="string", format="text", example="Harley"),
     *                   @OA\Property(property="keyword_ru", type="string", format="text", example="Augustus"),
     *                 @OA\Property(property="keyword_uz", type="string", format="text", example="2"),
     *                 @OA\Property(property="description_uz", type="string", format="text", example="2"),
     *                 @OA\Property(property="description_ru", type="string", format="text", example="2"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *              @OA\JsonContent(ref="#/components/schemas/Terms"),
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

    public function update(Request $request)
    {
        $rules = [
           
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
           
        }
    }
/**
     * @OA\Delete(
     *      path="/api/term/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_delete",
     *      tags={"Terms"},
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
     *         @OA\JsonContent(ref="#/components/schemas/Terms"),
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
       // $model = Term::find($id); // uncomment it
        $model = null; // remove it
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