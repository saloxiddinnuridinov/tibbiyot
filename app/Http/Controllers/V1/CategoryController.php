<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
 /**
 * @OA\Get(
 * path="/api/category",
 * security={{"bearerAuth":{}}},
 * summary="all categorys",
 * description="Categorys",
 * operationId="category_index",
 * tags={"Category"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(ref="#/components/schemas/Category"),
 * )
 * )
 */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function create()
    {
        //
    }
/**
 * @OA\Post(
 *  path="/api/category",
 *  security={{"bearerAuth":{}}},
 *  summary="add categorys",
 *  description="Category add",
 *  operationId="category_store",
 *  tags={"Category"},
 *  @OA\RequestBody(
     *          required=true,
     *          description="Register page",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"name_uz","name_ru","image","parent_id"},
    *          @OA\Property(property="name_uz",type="string",@OA\Schema(example="Tana")),
    *          @OA\Property(property="name_ru",type="string",@OA\Schema(example="body")),
    *          @OA\Property(property="parent_id",type="integer",@OA\Schema(example="1")),
    *          @OA\Property(property="image", type="string", format="binary")
     *              )
     *          )
     *      ),
 *  @OA\Response(
 *    response=200,
 *    description="success",
 *    @OA\JsonContent(ref="#/components/schemas/Category"),
 *  )
 * )
 */
    public function store(CategoryRequest $request)
    {
        $rules = [
            'name_uz' => 'required',
            'name_ru' => 'required',
            'parent_id' => 'required',
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator-> messages(), 400);
        }else{
        $image = $request->file('image');
        $date = date("d.m.Y");
        $name = time() . "_" . str_replace([" ", '"', "'"], ["", '', ''], $image->getClientOriginalName());
        $image->move(public_path("uploads/imges/$date/"), $name);
    
        $category = new Category();
        $category->name_uz = $request->name_uz;
        $category->name_ru = $request->name_ru;
        $category->image = asset("uploads/images/$date/$name.png");
        $category->parent_id=$request->parent_id;
        $category->save();
        return response()->json(new CategoryResource($category), 200);
        }
    }

    /**
     * @OA\Get(
     * path="/api/category/{id}",
     * summary="Show categorys",
     * description="Bitta idga tegishli categoriyalar ko'rinadi",
     * operationId="category_show",
     * tags={"Category"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *    name="id",
     *    description="Category id",
     *    required=true,
     *    in="path",
     *    @OA\Schema(
     *    type="integer"
     *    )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category"),
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
        return new CategoryResource(Category::find($id));
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Request $request)
    {
    //     $rules = [
    //         'name_uz' => 'required',
    //         'name_ru' => 'required',
    //         'parent_id' => 'required',
    //         'image' => 'required',
    //     ];
    //     $validator = Validator::make($request->all(), $rules);

    //     // ensure the request has a file before we attempt anything else.
    //     if ($request->hasFile('file')) {

    //         $request->validate([
    //             'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
    //         ]);

    //         // Save the file locally in the storage/public/ folder under a new folder named /product
    //         $request->file->store('product', 'public');

    //         // Store the record, using the new file hashname which will be it's new filename identity.
    //         $product = new Category([
    //             "name" => $request->get('name'),
    //             "file_path" => $request->file->hashName()
    //         ]);
    //         $product->save(); // Finally, save the record.
    //     }

    //     return view('products.create');
 }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
/**
     *  @OA\Put (
     *      path="/api/category/{id}",
     *      security={{"bearerAuth":{}}},
     *      tags={"Category"},
     *      operationId="category_update",
     *      summary="Update branch",
     *      @OA\Parameter (description="Branch ",in="path",name="id",required=true,example="1",@OA\Schema(type="integer")),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Add to cart",
     *          @OA\JsonContent(
     *          required={"name_uz"},
     *          @OA\Property(property="name_uz", type="string", format="text", example="Lorem"),
     *          @OA\Property(property="name_ru", type="string", format="text", example="Лорем"),
     *          @OA\Property(property="image", type="string", format="file", example="image/image.jpg"),
     *          @OA\Property(property="parent_id", type="integer", format="number", example="11"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/Category"),
     *      ),

     * )
     * 
     */

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required','unique:users,email'],
            'phone' => ['required','unique:users,phone'],
            'password' => 'required|confirmed',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }else{
            $image = $request->file('image');
            $category = new Category();
            $category->name_uz = $request->name_uz;
            $category->name_ru = $request->name_ru;
            $category->parent_id=$request->parent_id;
            $category->save();
        }
        return response()->json(['data' => $category, 'success' => 'Successfully registrated',], 200);

    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/category/{id}",
     *      operationId="deleteProject",
     *      security={{"bearerAuth":{}}},
     *      tags={"Category"},
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
        $model = Category::find($id);
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
