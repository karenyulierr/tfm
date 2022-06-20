<?php

namespace App\Http\Controllers;

use App\Image;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImgSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch ($_GET['Q']) {
            case 0:
                $sql = Image::where('tourist_sities_id',$_GET['site_id'])->get();
                return response()->json($sql);
        }
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
        $file = $request->file('file');

        for($i = 0; $i < sizeof($file); $i++){
            $fileName = $request->site_id . '_site'.$i.date('_H_i_s').'.'.$file[$i]->getClientOriginalExtension();
            Image::create([
                'name' => $fileName,
                'state' => 'active',
                'tourist_sities_id' => $request->site_id,
                'user_id' => Auth::user()->id,
            ]);
            $file[$i]->move(public_path('soportes/img_site'), $fileName);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Image::where('id',$request->id)->update([
            'state' => $request->state
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = Image::where('id', $id)->get();
        unlink(config('app.img_site') . $img[0]->name);
        $response = Image::where('id', $id)->delete();
        return response()->json($response);
    }
}
