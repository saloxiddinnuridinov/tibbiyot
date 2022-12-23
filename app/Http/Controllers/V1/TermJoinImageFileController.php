<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TermJoinImageFileResource;
use App\Models\TermJoinImageFile;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TermJoinImageFileController extends Controller
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
     *      path="/api/term-join-image-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_image_file_index",
     *      tags={"Terms_Join_Image_File"},
     *      summary="All term join image File",
     *      description="Hamma term join image filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/TermJoinImageFile"),
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
        return TermJoinImageFileResource::collection(TermJoinImageFile::all());
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
     *      path="/api/term-join-image-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_image_file_store",
     *      tags={"Terms_Join_Image_File"},
     *      summary="Term_join_image File add",
     *      description="term join image filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="term join image file save",
     *          @OA\JsonContent(required={"term_id", "image_file_id"},
     *               @OA\Property(property="term_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="image_file_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TermJoinImageFile"),
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
            'term_id' => 'required',
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinImage = new TermJoinImageFile();
            $termJoinImage->term_id = $request->term_id;
            $termJoinImage->image_file_id = $request->image_file_id;
            $termJoinImage->save();
            return $termJoinImage;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="/api/term-join-image-file/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show term join image file",
 * description="bitta term join image fileda hamma malumotlarini ko'rsatadi",
 * operationId="Terms_Join_Image_File_show",
 * tags={"Terms_Join_Image_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="term_join_image file id",
 *    required=true,
 *    in="path",
 *    @OA\Schema(
 *    type="integer"
 *    )
 * ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/TermJoinImageFile"),
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
    public function show(TermJoinImageFile $termJoinImageFile)
    {
        return $termJoinImageFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TermJoinImageFile $termJoinImageFile)
    {
        return $termJoinImageFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/term-join-image-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_image_file_update",
     *      tags={"Terms_Join_Image_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="term_join_image file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"term_id", "image_file_id"},
     *               @OA\Property(property="term_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="image_file_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(ref="#/components/schemas/TermJoinImageFile"),
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
    public function update(Request $request, TermJoinImageFile $termJoinImageFile)
    {
        $rules = [
            'term_id' => 'required',
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinImage = TermJoinImageFile::find($termJoinImageFile->id);
            $termJoinImage->term_id = $request->term_id;
            $termJoinImage->image_file_id = $request->image_file_id;
            $termJoinImage->save();
            return $termJoinImage;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/term-join-image-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_image_file_delete",
     *      tags={"Terms_Join_Image_File"},
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
        $model = TermJoinImageFile::find($id);
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
