<?php

namespace App\Http\Controllers;

use App\Models\TermJoinObjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class TermJoinObjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = TermJoinObjectFile::get();
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
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinObject = new TermJoinObjectFile();
            $termJoinObject->term_id = $request->term_id;
            $termJoinObject->object_file_id = $request->object_file_id;
            $termJoinObject->save();
            return $termJoinObject;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function show(TermJoinObjectFile $termJoinObjectFile)
    {
        return $termJoinObjectFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function edit(TermJoinObjectFile $termJoinObjectFile)
    {
        return $termJoinObjectFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermJoinObjectFile $termJoinObjectFile)
    {
        $rules = [
            'term_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $termJoinObject = TermJoinObjectFile::find($termJoinObjectFile->id);
            $termJoinObject->term_id = $request->term_id;
            $termJoinObject->image_file_id = $request->image_file_id;
            $termJoinObject->save();
            return $termJoinObject;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermJoinObjectFile  $termJoinObjectFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermJoinObjectFile $termJoinObjectFile)
    {
        $termJoinObjectFile->delete();
        return TermJoinObjectFile::all();
    }
}
