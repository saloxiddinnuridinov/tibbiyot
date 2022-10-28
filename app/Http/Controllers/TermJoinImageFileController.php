<?php

namespace App\Http\Controllers;

use App\Models\TermJoinImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TermJoinImageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = TermJoinImageFile::get();
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
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinImage = new TermJoinImageFile();
            $termJoinImage->term_id = $request->term_id;
            $termJoinImage->image_file_id = $request->image_file_id;
            $termJoinImage->save();
            return $termJoinImage;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function show(TermJoinImageFile $termJoinImageFile)
    {
        return $termJoinImageFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TermJoinImageFile $termJoinImageFile)
    {
        return $termJoinImageFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermJoinImageFile $termJoinImageFile)
    {
        $rules = [
            'term_id' => 'required',
            'image_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinImage = TermJoinImageFile::find($termJoinImageFile->id);
            $termJoinImage->term_id = $request->term_id;
            $termJoinImage->image_file_id = $request->image_file_id;
            $termJoinImage->save();
            return $termJoinImage;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermJoinImageFile  $termJoinImageFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermJoinImageFile $termJoinImageFile)
    {
        $termJoinImageFile->delete();
        return TermJoinImageFile::all();
    }
}
