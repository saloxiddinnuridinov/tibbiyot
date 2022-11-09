<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TermsController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/auth/term",
     *      operationId="term_index",
     *      tags={"Terms"},
     *      summary="All Terms",
     *      description="Hamma Terminlarlarni ko'rish",
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *         @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="keyword_latin", type="string", example="Harley"),
     *               @OA\Property(property="keyword_ru", type="string", example="Harley"),
     *               @OA\Property(property="keyword_uz", type="string", example="Harley"),
     *               @OA\Property(property="description_uz", type="string", example="Augustus"),
     *               @OA\Property(property="description_ru", type="string", example="Augustus"),
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
        $model = Terms::get();
        return $model;
    }


    public function create()
    {
        //
    }
    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/auth/term",
     *      operationId="term_store",
     *      tags={"Terms"},
     *      summary="new Trems add",
     *      description="Yangi Terms qoshish",
     *      @OA\RequestBody(
     *          required=true,
     *          description="lesson save",
     *          @OA\JsonContent(required={"keyword_latin", "keyword_ru", "keyword_uz", "description_uz", "description_ru"},
     *               @OA\Property(property="keyword_latin", type="string", format="text", example="Harley"),
     *               @OA\Property(property="keyword_ru", type="string", format="text", example="Augustus"),
     *               @OA\Property(property="keyword_uz", type="string", format="text", example="2"),
     *               @OA\Property(property="description_uz", type="string", format="text", example="2"),
     *               @OA\Property(property="description_ru", type="string", format="text", example="2"),
    *      ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="keyword_latin", type="string", example="Harley"),
     *               @OA\Property(property="keyword_ru", type="string", example="Harley"),
     *               @OA\Property(property="keyword_uz", type="string", example="Harley"),
     *               @OA\Property(property="description_uz", type="string", example="Augustus"),
     *               @OA\Property(property="description_ru", type="string", example="Augustus"),
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
            $term = new Terms();
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
 * path="/api/auth/term/{id}",
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
 *          @OA\JsonContent(
 *                   @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="keyword_latin", type="string", example="Harley"),
     *               @OA\Property(property="keyword_ru", type="string", example="Harley"),
     *               @OA\Property(property="keyword_uz", type="string", example="Harley"),
     *               @OA\Property(property="description_uz", type="string", example="Augustus"),
     *               @OA\Property(property="description_ru", type="string", example="Augustus"),
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
 
    public function show(Terms $term)
    {
        return $term;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Terms $term)
    {
        return $term;
    }
    /**
     * @OA\Put(
     *      path="/api/auth/term/{id}",
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
     *          @OA\JsonContent(required={"keyword_latin", "keyword_ru", "keyword_uz", "description_uz", "description_ru"},
     *               @OA\Property(property="keyword_latin", type="string", format="text", example="Harley"),
     *               @OA\Property(property="keyword_ru", type="string", format="text", example="Augustus"),
     *               @OA\Property(property="keyword_uz", type="string", format="text", example="2"),
     *               @OA\Property(property="description_uz", type="string", format="text", example="2"),
     *               @OA\Property(property="description_ru", type="string", format="text", example="2"),
     *      )
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *               @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="keyword_latin", type="string", example="Harley"),
     *               @OA\Property(property="keyword_ru", type="string", example="Harley"),
     *               @OA\Property(property="keyword_uz", type="string", example="Harley"),
     *               @OA\Property(property="description_uz", type="string", example="Augustus"),
     *               @OA\Property(property="description_ru", type="string", example="Augustus"),
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

    public function update(Request $request, Terms $term)
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
            $term = Terms::find($term->id);
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
     * @OA\Delete(
     *      path="/api/auth/term/{id}",
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
    public function destroy(Terms $term)
    {
        $term->delete();
        return Terms::all();
    }
}