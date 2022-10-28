<?php

namespace App\Http\Controllers;

use App\Models\VideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VideoFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = VideoFile::get();
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
            'name_ru' => 'required',
            'name_uz' => 'required',
            'url' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $video = new VideoFile();
            $video->name_ru = $request->name_ru;
            $video->name_uz = $request->name_uz;
            $video->url = $request->url;
            $video->save();
            return $video;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    public function show(VideoFile $videoFile)
    {
        return $videoFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoFile $videoFile)
    {
        return $videoFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoFile $videoFile)
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
            $video = VideoFile::find($videoFile->id);
            $video->name_ru = $request->name_ru;
            $video->name_uz = $request->name_uz;
            $video->url = $request->url;
            $video->save();
            return $video;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoFile  $videoFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoFile $videoFile)
    {
        $videoFile->delete();
        return VideoFile::all();
    }
}
