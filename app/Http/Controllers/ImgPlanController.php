<?php

namespace App\Http\Controllers;

use App\PlanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImgPlanController extends Controller
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
                $sql = PlanImage::where('plan_tourist_id',$_GET['plan_id'])->get();
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
            $fileName = $request->plan_id . '_plan_'.$i.date('_H_i_s').'.'.$file[$i]->getClientOriginalExtension();
            PlanImage::create([
                'name' => $fileName,
                'state' => 'active',
                'plan_tourist_id' => $request->plan_id,
                'user_id' => Auth::user()->id,
            ]);
            $file[$i]->move(public_path('soportes/img_plan'), $fileName);
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
        PlanImage::where('id',$request->id)->update([
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
        $img = PlanImage::where('id', $id)->get();
        unlink(config('app.img_plan') . $img[0]->name);
        $response = PlanImage::where('id', $id)->delete();
        return response()->json($response);
    }
}
