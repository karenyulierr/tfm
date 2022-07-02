<?php

namespace App\Http\Controllers;

use App\PlanTourist;
use App\PlanTouristSite;
use App\TouristSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlansController extends Controller
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
                $plan= PlanTourist::orderBy('name', 'ASC')->get();
                return response()->json($plan);
            case 1:
                $sql = TouristSite::where('state','active')->get();
                return response()->json($sql);
            case 2:

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
        $sites = json_decode($_POST['sites']);
        if($request->band=='create'){
            $images = $request->file('image_main');
            $name_image = 'plan_' . date("Y-m-d_H-i-s") . '.' . $images->getClientOriginalExtension();
            Storage::disk('img_main')->put($name_image, file_get_contents($images->getRealPath()));
            $sql = PlanTourist::create([
                'name' => $request->name,
                'description' => $request->description,
                'value' => $request->value,
                'main_image' => $name_image,
                'state' => 'active',
                'user_id' => Auth::user()->id
            ]);
            for ($i = 0; $i < count($sites); $i++){
                PlanTouristSite::create([
                    'plan_tourist_id' => $sql->id,
                    'tourist_sities_id'=>$sites[$i]->id,
                    'user_id' => Auth::user()->id
                ]);
            }
        } else {
            $photo = PlanTourist::where('main_image',$request->image_main)->exists();
            if($photo==true){
                $name_image = $request->image_main;
            } else {
                $photoDel = TouristSite::where('id',$request->id)->first();
                unlink(config('app.img_main') . $photoDel->main_image);
                $images = $request->file('image_main');
                $name_image = 'plan_' . date("Y-m-d_H-i-s") . '.' . $images->getClientOriginalExtension();
                Storage::disk('img_main')->put($name_image, file_get_contents($images->getRealPath()));
            }
            PlanTourist::where('id',$request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'value' => $request->value,
                'main_image' => $name_image,
                'state' => 'active',
                'user_id' => Auth::user()->id
            ]);
            PlanTouristSite::where('plan_tourist_id',$request->id)->delete();
            for ($i = 0; $i < count($sites); $i++){
                PlanTouristSite::create([
                    'plan_tourist_id' => $request->id,
                    'tourist_sities_id'=>$sites[$i]->id,
                    'user_id' => Auth::user()->id
                ]);
            }
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
        $extract_id = explode('-', $id);
        if($extract_id[1] == 'name') {
            $query = PlanTourist::where('name', $extract_id[0])->exists();
        }
        return response()->json($query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = PlanTourist::where('id',$id)->first();
        $site = PlanTouristSite::join('tourist_sites', 'tourist_sites.id', '=', 'plan_tourist_sities.tourist_sities_id')->where('plan_tourist_sities.plan_tourist_id',$id)
            ->select('tourist_sites.id', 'tourist_sites.name')->get();
        return response()->json(array($plan,$site));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
