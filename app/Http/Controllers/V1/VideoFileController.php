<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoFileResource;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VideoFileController extends Controller
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
     *      path="/video-file",
     *      operationId="video_file_index",
     *      tags={"Video_File"},
     *      summary="All video File",
     *      description="Hamma video filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/VideoFile"),
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
        return VideoFileResource::collection(VideoFile::all());
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
     *      path="/video-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="video_file_store",
     *      tags={"Video_File"},
     *      summary="video File add",
     *      description="video filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="video file save",
     *          @OA\JsonContent(required={"name_ru", "name_uz", "url", "image"},
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/VideoFile"),
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
            'name_ru' => 'required',
            'name_uz' => 'required',
            'url' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $video = new VideoFile();
            $video->name_ru = $request->name_ru;
            $video->name_uz = $request->name_uz;
            $video->url = $request->url;
            $video->save();
            return $video;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
 /**
 * @OA\Get(
 * path="/api/video-file/{id}",
 * summary="Show video file",
 * description="bitta video fileda hamma malumotlarini ko'rsatadi",
 * operationId="video_file_show",
 * tags={"Video_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="video file id",
 *    required=true,
 *    in="path",
 *    @OA\Schema(
 *    type="integer"
 *    )
 * ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/VideoFile"),
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

    public function show(VideoFile $videoFile)
    {
        return $videoFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoFile $videoFile)
    {
        return $videoFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/video-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="video_file_update",
     *      tags={"Video_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="video file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"name_ru", "name_uz", "url", "image"},
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(ref="#/components/schemas/VideoFile"),
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
    public function update(Request $request, VideoFile $videoFile)
    {
        $rules = [
            'name_ru' => 'required',
            'name_uz' => 'required',
            'url' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $video = VideoFile::find($videoFile->id);
            $video->name_ru = $request->name_ru;
            $video->name_uz = $request->name_uz;
            $video->url = $request->url;
            $video->save();
            return $video;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
        /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\videoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/video-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="video_file_delete",
     *      tags={"Video_File"},
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
        $model = VideoFile::find($id);
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
