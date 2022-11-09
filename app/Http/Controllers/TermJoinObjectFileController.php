<?php

namespace App\Http\Controllers;

use App\Models\TermJoinObjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class TermJoinObjectFileController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/auth/term/join/object/file",
     *      operationId="term_join_object_file_index",
     *      tags={"Terms_Join_Object_File"},
     *      summary="All term join object File",
     *      description="Hamma term join object filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="term_id", type="integer", example="5"),
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
        $model = TermJoinObjectFile::get();
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
     *      path="/api/auth/term/join/object/file",
     *      operationId="term_join_object_file_store",
     *      tags={"Terms_Join_Object_File"},
     *      summary="Term_join_object File add",
     *      description="term join object filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="term join object file save",
     *          @OA\JsonContent(required={"term_id", "object_file_id"},
     *               @OA\Property(property="term_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="object_file_id", type="integer", format="number", example="2")
    * 
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="term_id", type="integer", example="Harley"),
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
            'term_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinObject = new TermJoinObjectFile();
            $termJoinObject->term_id = $request->term_id;
            $termJoinObject->object_file_id = $request->object_file_id;
            $termJoinObject->save();
            return $termJoinObject;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="/api/auth/term/join/object/file/{id}",
 * summary="Show term join object file",
 * description="bitta term join object fileda hamma malumotlarini ko'rsatadi",
 * operationId="Terms_Join_Object_File_show",
 * tags={"Terms_Join_Object_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="term_join_object file id",
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
    public function show(TermJoinObjectFile $termJoinObjectFile)
    {
        return $termJoinObjectFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TermJoinObjectFile $termJoinObjectFile)
    {
        return $termJoinObjectFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/auth/term/join/object/file/{id}",
     *      operationId="term_join_object_file_update",
     *      tags={"Terms_Join_Object_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="term_join_object file id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="term update",
     *          @OA\JsonContent(required={"term_id", "object_file_id"},
     *               @OA\Property(property="term_id", type="integer", format="number", example="6"),
    *               @OA\Property(property="object_file_id", type="integer", format="number", example="2")
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="term_id", type="integer", example="Harley"),
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
    public function update(Request $request, TermJoinObjectFile $termJoinObjectFile)
    {
        $rules = [
            'term_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinObject = TermJoinObjectFile::find($termJoinObjectFile->id);
            $termJoinObject->term_id = $request->term_id;
            $termJoinObject->image_file_id = $request->image_file_id;
            $termJoinObject->save();
            return $termJoinObject;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/auth/term/join/object/file/{id}",
     *      operationId="term_join_object_file_delete",
     *      tags={"Terms_Join_Object_File"},
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
    public function destroy(TermJoinObjectFile $termJoinObjectFile)
    {
        $termJoinObjectFile->delete();
        return TermJoinObjectFile::all();
    }
}
