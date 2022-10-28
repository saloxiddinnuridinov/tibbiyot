<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 * path="/api/category",
 * summary="all categorys",
 * description="Categorys",
 * operationId="category_index",
 * tags={"Category"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name_uz", type="string", example="Harley Tromp"),
 *       @OA\Property(property="name_ru", type="string", example="Augustus  Kassulke"),
 *       @OA\Property(property="image", type="string", example="Dickinson"),
 *       @OA\Property(property="parent_id", type="integer", example="7"),
 *       @OA\Property(property="created_at", type="string", example="2022-10-19T12:46:55.000000Z"),
 *       @OA\Property(property="updated_at", type="string", example="2022-10-19T12:46:55.000000Z"),
 *        )
 *     )
 * )
 */
    public function index()
    {
        $model = Category::get();
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
 * path="/api/category",
 * summary="add categorys",
 * description="Category add",
 * operationId="category_store",
 * tags={"Category"},
 * @OA\RequestBody(
 *    required= true ,
 *    description="category save",
 *    @OA\JsonContent(
 *       required={"name_uz","name_ru", "image", "parent_id",},
 *       @OA\Property(property="name_uz", type="string", format="text", example="salohiddin"),
 *       @OA\Property(property="name_ru", type="string", format="text", example="салохиддин"),
 *       @OA\Property(property="image", type="string", format="text", example="image/image.jpg"),
 *       @OA\Property(property="perrent_id", type="number", format="number", example="1"),
 *    ),
 * ),
 * @OA\Response(
 *    response=200,
 *    description="cucsses",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Success, Catrgoryiya qo'shildi")
 *        )
 *     )
 * )
 */
    public function store(CategoryRequest $request)
    {
        
            $category = new Category();
            $category->name_uz = $request->name_uz;
            $category->name_ru = $request->name_ru;
            $category->image = $request->image;
            $category->parent_id=$request->parent_id;
            $category->save();
            return $category;//response()->json(new CategoryResource($category), 200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
/**
 * @OA\Get(
 * path="/api/category/{category}",
 * summary="Show categorys",
 * description="Bitta idga tegishli categoriyalar ko'rinadi",
 * operationId="category_show",
 * tags={"Category"},
 * @OA\Response(
 *    response=200,
 *    description="cuccess",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name_uz", type="string", example="masalan"),
 *       @OA\Property(property="name_ru", type="string", example="например"),
 *       @OA\Property(property="image", type="string", example="image/image.jpg"),
 *       @OA\Property(property="parrent_id", type="integer", example="12"),
 *        )
 *     )
 * )
 */
    public function show(Category $category)
    {
        $categor = Category::find($category);
        if($categor){
            return response()->json($categor, 200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return $category;
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
     *          @OA\JsonContent(
     *              @OA\Property(property="name_uz", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Branch created successfully"),
     *          ),
     *      ),

     * )
     * 
     */

    public function update(Request $request, Category $category)
    {
        $category_update = Category::find($category->id);
        $category_update->name_uz = $request->name_uz ?? $category_update->name_uz;
        $category_update->name_ru = $request->name_ru ?? $category_update->name_ru;
        $category_update->image = $request->image ?? $category_update->image;
        $category_update->parent_id=$request->parent_id ?? $category_update->parent_id;
        $category_update->save();
        return $category_update;
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
     *          response=204,
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

    public function destroy(Category $category)
    {   
        $category->delete();
        return Category::all();
    }
}
