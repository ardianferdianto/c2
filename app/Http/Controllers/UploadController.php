<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;

use App\Upload;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploads = Upload::all();

        return view('uploads.index', compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        $file = $request->file('file');

        if ($file->isValid()) {
            $name = $file->getClientOriginalName();
            $key = 'uploads/' . $name;
            Storage::disk('s3')->put($key, file_get_contents($file));

            $upload = new Upload;

            $upload->name = $name;
            $upload->file = $key;
            $upload->save();
        }

        return redirect('uploads');
        // return ['message'=> 'File Uploaded! '];
    }
}
