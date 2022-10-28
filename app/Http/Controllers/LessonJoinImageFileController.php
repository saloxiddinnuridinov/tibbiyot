<?php

namespace App\Http\Controllers;

use App\Models\LessonJoinImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonJoinImageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $model = LessonJoinImageFile::get();
        return $model;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'lesson_id' => 'required',
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinImage = new LessonJoinImageFile();
            $lessonJoinImage->lesson_id = $request->lesson_id;
            $lessonJoinImage->image_file_id = $request->image_file_id;
            $lessonJoinImage->save();
            return $lessonJoinImage;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function show(LessonJoinImageFile $lessonJoinImageFile)
    {
        return $lessonJoinImageFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinImageFile $lessonJoinImageFile)
    {
        return $lessonJoinImageFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonJoinImageFile $lessonJoinImageFile)
    {
        $rules = [
            'lesson_id' => 'required',
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json($validator);
    }else{
        $lessonJoinImage = LessonJoinImageFile::find($lessonJoinImageFile->id);
        $lessonJoinImage->lesson_id = $request->lesson_id;
        $lessonJoinImage->image_file_id = $request->image_file_id;
        $lessonJoinImage->save();
        return $lessonJoinImage;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinImageFile  $lessonJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonJoinImageFile $lessonJoinImageFile)
    {
        $lessonJoinImageFile->delete();
        return LessonJoinImageFile::all();
    }
}
