<?php

namespace App\Http\Controllers;

use App\Models\ObjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ObjectFileController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/auth/object/file",
     *      operationId="object_file_index",
     *      tags={"Object_File"},
     *      summary="All Object File",
     *      description="Hamma Object filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
     *               @OA\Property(property="image", type="string", example="Augustus"),
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
        $object = ObjectFile::all();
        return $object;
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
     *      path="/auth/object/file",
     *      operationId="object_file_store",
     *      tags={"Object_File"},
     *      summary="Object File add",
     *      description="Object filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object file save",
     *          @OA\JsonContent(required={"name_ru", "name_uz", "url", "image"},
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
     *               @OA\Property(property="image", type="string", example="Augustus"),
    *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
     *               @OA\Property(property="image", type="string", example="Augustus"),
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
            'name_ru' => 'required',
            'name_uz' => 'required',
            'url' => 'required',
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $object_file = new ObjectFile();
            $object_file->name_ru = $request->name_ru;
            $object_file->name_uz = $request->name_uz;
            $object_file->url = $request->url;
            $object_file->image = $request->image;
            $object_file->save();
            return $object_file;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
 /**
 * @OA\Get(
 * path="/api/auth/object/file/{id}",
 * summary="Show object file",
 * description="bitta object fileda hamma malumotlarini ko'rsatadi",
 * operationId="object_file_show",
 * tags={"Object_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="object file id",
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
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
     *               @OA\Property(property="image", type="string", example="Augustus"),
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
    public function show(ObjectFile $objectFile)
    {
        return $objectFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    public function edit(ObjectFile $objectFile)
    {
        return $objectFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/auth/object/file/{id}",
     *      operationId="object_file_update",
     *      tags={"Object_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="object file id",
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
     *               @OA\Property(property="image", type="string", example="Augustus"),
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
     *               @OA\Property(property="image", type="string", example="Augustus"),
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
    public function update(Request $request, ObjectFile $objectFile)
    {
        $rules = [
            'name_ru' => 'required',
            'name_uz' => 'required',
            'url' => 'required',
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $object_file = ObjectFile::find($objectFile->id);
            $object_file->name_ru = $request->name_ru;
            $object_file->name_uz = $request->name_uz;
            $object_file->url = $request->url;
            $object_file->image = $request->image;
            $object_file->save();
            return $object_file;
        }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/auth/object/file/{id}",
     *      operationId="object_file_delete",
     *      tags={"Object_File"},
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
    public function destroy(ObjectFile $objectFile)
    {
        $objectFile->delete();
        return ObjectFile::all();
    }
}
