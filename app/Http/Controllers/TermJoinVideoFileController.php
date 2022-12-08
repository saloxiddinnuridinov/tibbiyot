<?php

namespace App\Http\Controllers;

use App\Models\TermJoinVideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TermJoinVideoFileController extends Controller
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
     *      path="/api/term-join-video-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_video_file_index",
     *      tags={"Terms_Join_Video_File"},
     *      summary="All term join video File",
     *      description="Hamma term join video filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="term_id", type="integer", example="5"),
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
        $model = TermJoinVideoFile::get();
        return $model;
    }


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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/term-join-video-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_video_file_store",
     *      tags={"Terms_Join_Video_File"},
     *      summary="Term_join_video File add",
     *      description="term join video filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="term join video file save",
     *          @OA\JsonContent(required={"term_id", "video_file_id"},
     *               @OA\Property(property="term_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="video_file_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="term_id", type="integer", example="Harley"),
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
            'term_id' => 'required',
            'video_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termjoinvideo = new TermJoinVideoFile();
            $termjoinvideo->term_id = $request->term_id;
            $termjoinvideo->video_file_id = $request->video_file_id;
            $termjoinvideo->save();
            return $termjoinvideo;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="/api/term-join-video-file/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show term join video file",
 * description="bitta term join video fileda hamma malumotlarini ko'rsatadi",
 * operationId="Terms_Join_video_File_show",
 * tags={"Terms_Join_Video_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="term_join_video file id",
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
     *               @OA\Property(property="term_id", type="integer", example="Harley"),
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
    public function show(TermJoinVideoFile $termJoinVideoFile)
    {
        return $termJoinVideoFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TermJoinVideoFile $termJoinVideoFile)
    {
        return $termJoinVideoFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/term-join-video-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_video_file_update",
     *      tags={"Terms_Join_Video_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="term_join_video file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"term_id", "video_file_id"},
     *               @OA\Property(property="term_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="video_file_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="term_id", type="integer", example="Harley"),
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

    public function update(Request $request, TermJoinVideoFile $termJoinVideoFile)
    {
        $rules = [
            'term_id' => 'required',
            'video_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termjoinvideo = TermJoinVideoFile::find($termJoinVideoFile->id);
            $termjoinvideo->term_id = $request->term_id;
            $termjoinvideo->video_file_id = $request->video_file_id;
            $termjoinvideo->save();
            return $termjoinvideo;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/term-join-video-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="term_join_video_file_delete",
     *      tags={"Terms_Join_Video_File"},
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
    public function destroy(TermJoinVideoFile $termJoinVideoFile)
    {
        $termJoinVideoFile->delete();
        return TermJoinVideoFile::all();
    }
}
