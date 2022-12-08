<?php

namespace App\Http\Controllers;

use App\Models\ImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageFileController extends Controller
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
     *      path="/auth/image-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="image_file_index",
     *      tags={"Image_File"},
     *      summary="All image File",
     *      description="Hamma image filelarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
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
        $image = ImageFile::get();
        return $image;
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
     *      path="/auth/image-file",
     *      security={{"bearerAuth":{}}},
     *      operationId="image_file_store",
     *      tags={"Image_File"},
     *      summary="image File add",
     *      description="image filelarlar qo'shish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="image file save",
     *          @OA\JsonContent(required={"name_ru", "name_uz", "url", "image"},
     *               @OA\Property(property="name_ru", type="string", format="text", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", format="text", example="Harley"),
     *               @OA\Property(property="url", type="string", format="text", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $image = new ImageFile();
            $image->name_ru = $request->name_ru;
            $image->name_uz = $request->name_uz;
            $image->url = $request->url;
            $image->save();
            return $image;
        }
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */
 /**
 * @OA\Get(
 * path="/api/auth/image-file/{id}",
 * security={{"bearerAuth":{}}},
 * summary="Show image file",
 * description="bitta image fileda hamma malumotlarini ko'rsatadi",
 * operationId="image_file_show",
 * tags={"Image_File"},
 * @OA\Parameter(
 *    name="id",
 *    description="image file id",
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
    public function show(ImageFile $imageFile)
    {
        return $imageFile;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageFile $imageFile)
    {
        return $imageFile;
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Put(
     *      path="/api/auth/image-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="image_file_update",
     *      tags={"Image_File"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="image file id",
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
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name_ru", type="string", example="Harley"),
     *               @OA\Property(property="name_uz", type="string", example="Harley"),
     *               @OA\Property(property="url", type="string", example="https://www.quigley.info/magnam-accusantium-non-aliquid-ad"),
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
    public function update(Request $request, ImageFile $imageFile)
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
        $image = ImageFile::find($imageFile->id);
        $image->name_ru = $request->name_ru;
        $image->name_uz = $request->name_uz;
        $image->url = $request->url;
        $image->save();
        return $image;
    }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageFile  $imageFile
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/auth/image-file/{id}",
     *      security={{"bearerAuth":{}}},
     *      operationId="image_file_delete",
     *      tags={"Image_File"},
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
    public function destroy(ImageFile $imageFile)
    {
        $imageFile->delete();
        return ImageFile::all();
    }
}
