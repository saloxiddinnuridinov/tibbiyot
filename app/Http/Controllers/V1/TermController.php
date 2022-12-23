<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReturnTermResource;
use App\Http\Resources\TermResource;
use App\Models\ImageFile;
use App\Models\ObjectFile;
use App\Models\TermJoinImageFile;
use App\Models\Term;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class TermController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show','getImage','getTerms','getVideo','getObject']]);
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
        return TermResource::collection(Term::all());
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
            'keyword_latin' => 'required',
            'keyword_ru' => 'required',
            'keyword_uz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $term = new Term();
            $term->keyword_latin = $request->keyword_latin;
            $term->keyword_ru = $request->keyword_ru;
            $term->keyword_uz = $request->keyword_uz;
            $term->description_uz = $request->description_uz;
            $term->description_ru = $request->description_ru;
            $term->save();
            return $term;
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
        return new TermResource(Term::find($id));
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
       //echo $term->keyword_latin; die();
        $rules = [
            'keyword_latin' => 'required',
            'keyword_ru' => 'required',
            'keyword_uz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            echo "salom";
            $model = Term::find($request->id);
            if ($model){
                $model->update([
                    'keyword_latin' => $request->keyword_latin,
                    'keyword_ru' => $request->keyword_ru,
                    'keyword_uz' => $request->keyword_uz,
                    'description_uz' => $request->description_uz,
                    'description_ru' => $request->description_ru,
                ]);
                return response()->json(
                    new TermResource($model), 
                    200);
            }else{
                return response()->json($this->dataError, 404);
            }
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
        $model = Term::find($id);
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
   
    /**
     * @OA\Get(
     * path="/api/get-term/{term}/{from}",
     * security={{"bearerAuth":{}}},
     * summary="Get Term term",
     * description="bitta termda hamma malumotlarini ko'rsatadi",
     * operationId="term_getTerm",
     * tags={"Terms"},
     * @OA\Parameter(
     *    name="term",
     *    description="Term name",
     *    required=true,
     *    in="path",
     *    @OA\Schema(
     *    type="string"
     *    )
     * ),
     * @OA\Parameter(
     *    name="from",
     *    description="from name",
     *    required=true,
     *    in="path",
     *    @OA\Schema(
     *    type="string",
     *     enum={"keyword_latin", "keyword_ru","keyword_uz"},
     *    )
     * ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
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
     *      )
     * )
     */
    public function getTerms($term, $from){
         $result = Term::select("*")
        //  ->join("terms_join_image_files", "terms_join_image_files.term_id", "=", "terms.id")
        //  ->join("terms_join_object_files", "terms_join_object_files.term_id", "=", "terms.id")
        //  ->join("terms_join_video_files", "terms_join_video_files.term_id", "=", "terms.id")
         ->where($from, 'LIKE', "%$term%")
         //->select($to, "term_id", "image_file_id", "object_file_id","video_file_id")
         ->get();
        return ReturnTermResource::collection($result);
    }
    /**
     * @OA\Get(
     * path="/api/get-image/{term_id}/",
     * security={{"bearerAuth":{}}},
     * summary="Show term",
     * description="Imageni olish",
     * operationId="Image_term",
     * tags={"Terms"},
     * @OA\Parameter(
     *    name="term_id",
     *    description="image id",
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
    public function getImage($id){
        $result = ImageFile::select("*")
        ->join("term_join_image_files", "term_join_image_files.image_file_id", "=", "image_files.id")
        ->where("term_join_image_files.term_id", $id)
        ->get();
        return ReturnTermResource::collection($result);
    }
    /**
     * @OA\Get(
     * path="/api/get-video/{term_id}/",
     * security={{"bearerAuth":{}}},
     * summary="Show term",
     * description="Videoni olish",
     * operationId="Video_term",
     * tags={"Terms"},
     * @OA\Parameter(
     *    name="term_id",
     *    description="image id",
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
    public function getVideo($id){
        $result = VideoFile::select("*")
        ->join("term_join_video_files", "term_join_video_files.video_file_id", "=", "video_files.id")
        ->where("term_join_video_files.term_id", $id)
        ->get();
        return ReturnTermResource::collection($result);
    }
    /**
     * @OA\Get(
     * path="/api/get-object/{term_id}/",
     * security={{"bearerAuth":{}}},
     * summary="Show term object",
     * description="Objectni olish",
     * operationId="Object_term",
     * tags={"Terms"},
     * @OA\Parameter(
     *    name="term_id",
     *    description="image id",
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
    public function getObject($id){
        $result = ObjectFile::select("*")
        ->join("term_join_object_files", "term_join_object_files.object_file_id", "=", "object_files.id")
        ->where("term_join_object_files.term_id", $id)
        ->get();
        return ReturnTermResource::collection($result);
    }
}