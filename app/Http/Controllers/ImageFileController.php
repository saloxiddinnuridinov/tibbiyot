<?php

namespace App\Http\Controllers;

use App\Models\ImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageFileController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
    public function destroy(ImageFile $imageFile)
    {
        $imageFile->delete();
        return ImageFile::all();
    }
}
