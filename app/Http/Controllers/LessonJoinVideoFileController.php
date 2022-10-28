<?php

namespace App\Http\Controllers;

use App\Models\LessonJoinVideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LessonJoinVideoFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = LessonJoinVideoFile::get();
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
            'video_file_id' => 'required',
        ];
        $validator = Validator ::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinVideo = new LessonJoinVideoFile();
            $lessonJoinVideo->lesson_id = $request->lesson_id;
            $lessonJoinVideo->video_file_id = $request->video_file_id;
            $lessonJoinVideo->save();
            return $lessonJoinVideo;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function show(LessonJoinVideoFile $lessonJoinVideoFile)
    {
        return $lessonJoinVideoFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinVideoFile $lessonJoinVideoFile)
    {
        return $lessonJoinVideoFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonJoinVideoFile $lessonJoinVideoFile)
    {
        $rules = [
            'lesson_id' => 'required',
            'video_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lessonJoinVideo = LessonJoinVideoFile::find($lessonJoinVideoFile->id);
            $lessonJoinVideo->lesson_id = $request->lesson_id;
            $lessonJoinVideo->video_file_id = $request->video_file_id;
            $lessonJoinVideo->save();
            return $lessonJoinVideo;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinVideoFile  $lessonJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonJoinVideoFile $lessonJoinVideoFile)
    {
        $lessonJoinVideoFile->delete();
        return LessonJoinVideoFile::all();
    }
}
