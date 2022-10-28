<?php

namespace App\Http\Controllers;

use App\Models\ObjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ObjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $object = ObjectFile::all();
        return $object;
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
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $object_file = new ObjectFile();
            $object_file->name_ru = $request->name_ru;
            $object_file->name_uz = $request->name_uz;
            $object_file->url = $request->url;
            $object_file->image = $request->image;
            $object_file->save();
            return $object_file;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    public function show(ObjectFile $objectFile)
    {
        return $objectFile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    public function edit(ObjectFile $objectFile)
    {
        return $objectFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObjectFile $objectFile)
    {
        $rules = [
            'name_ru' => 'required',
            'name_uz' => 'required',
            'url' => 'required',
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $object_file = ObjectFile::find($objectFile->id);
            $object_file->name_ru = $request->name_ru;
            $object_file->name_uz = $request->name_uz;
            $object_file->url = $request->url;
            $object_file->image = $request->image;
            $object_file->save();
            return $object_file;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObjectFile  $objectFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObjectFile $objectFile)
    {
        $objectFile->delete();
        return ObjectFile::all();
    }
}
