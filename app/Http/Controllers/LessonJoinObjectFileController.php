<?php

namespace App\Http\Controllers;

use App\Models\LessonJoinObjectFile;
use App\Models\ObjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\ObjectType;

class LessonJoinObjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = LessonJoinObjectFile::get();
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
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinObject = new LessonJoinObjectFile();
            $lessonJoinObject->lesson_id = $request->lesson_id;
            $lessonJoinObject->object_file_id = $request->object_file_id;
            $lessonJoinObject->save();
            return $lessonJoinObject;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function show(LessonJoinObjectFile $lessonJoinObjectFile)
    {
        return $lessonJoinObjectFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinObjectFile $lessonJoinObjectFile)
    {
        return $lessonJoinObjectFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonJoinObjectFile $lessonJoinObjectFile)
    {
        $rules = [
            'lesson_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lessonJoinObject = LessonJoinObjectFile::find($lessonJoinObjectFile->id);
            $lessonJoinObject->lesson_id = $request->lesson_id;
            $lessonJoinObject->object_file_id = $request->object_file_id;
            $lessonJoinObject->save();
            return $lessonJoinObject;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinObjectFile  $lessonJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonJoinObjectFile $lessonJoinObjectFile)
    {
        $lessonJoinObjectFile->delete();
        return LessonJoinObjectFile::all();
    }
}
