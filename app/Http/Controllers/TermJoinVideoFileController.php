<?php

namespace App\Http\Controllers;

use App\Models\TermJoinVideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TermJoinVideoFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = TermJoinVideoFile::get();
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
            'term_id' => 'required',
            'video_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termjoinvideo = new TermJoinVideoFile();
            $termjoinvideo->term_id = $request->term_id;
            $termjoinvideo->video_file_id = $request->video_file_id;
            $termjoinvideo->save();
            return $termjoinvideo;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function show(TermJoinVideoFile $termJoinVideoFile)
    {
        return $termJoinVideoFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TermJoinVideoFile $termJoinVideoFile)
    {
        return $termJoinVideoFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermJoinVideoFile $termJoinVideoFile)
    {
        $rules = [
            'term_id' => 'required',
            'video_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termjoinvideo = TermJoinVideoFile::find($termJoinVideoFile->id);
            $termjoinvideo->term_id = $request->term_id;
            $termjoinvideo->video_file_id = $request->video_file_id;
            $termjoinvideo->save();
            return $termjoinvideo;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermJoinVideoFile  $termJoinVideoFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermJoinVideoFile $termJoinVideoFile)
    {
        $termJoinVideoFile->delete();
        return TermJoinVideoFile::all();
    }
}
