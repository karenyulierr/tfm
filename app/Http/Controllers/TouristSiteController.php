<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryTouristSite;
use App\TouristSite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TouristSiteController extends Controller
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
                $id = Auth::user()->id;
                $rol = User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('model_has_roles.model_id',$id)->select('roles.name as rol')->first();
                if ($rol->rol == 'Administrador') {
                    $service = TouristSite::orderBy('name', 'ASC')->get();
                } else {
                    $service = TouristSite::where('user_admin', $id)->orderBy('name', 'ASC')->get();
                }
                return response()->json($service);
            case 1:
                $sql = User::get();
                $categories = Category::where('state','active')->get();
                return response()->json(array($sql,$categories));
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
        $categorie = json_decode($_POST['categories']);
        if($request->band=='create'){
            $images = $request->file('image_main');
            $name_image = $request->nit . '_' . date("Y-m-d") . '.' . $images->getClientOriginalExtension();
            Storage::disk('img_main')->put($name_image, file_get_contents($images->getRealPath()));
            $sql = TouristSite::create([
                'name' => $request->name,
                'description' => $request->description,
                'nit' => $request->nit,
                'email' => $request->email,
                'phone' => $request->phone,
                'main_image' => $name_image,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'state' => 'active',
                'user_admin' => $request->user_admin,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'user_id' => Auth::user()->id
            ]);
            for ($i = 0; $i < count($categorie); $i++){
                CategoryTouristSite::create([
                    'category_id'=>$categorie[$i]->id,
                    'tourist_site_id' => $sql->id,
                    'user_id' => Auth::user()->id
                ]);
            }
        } else {
            $photo = TouristSite::where('main_image',$request->image_main)->exists();

            if($photo==true){
                $name_image = $request->image_main;
            } else {
                $photoDel = TouristSite::where('id',$request->id)->first();
                unlink(config('app.img_main') . $photoDel->main_image);
                $images = $request->file('image_main');
                $name_image = $request->nit . '_' . date("Y-m-d") . '.' . $images->getClientOriginalExtension();
                Storage::disk('img_main')->put($name_image, file_get_contents($images->getRealPath()));
            }
            TouristSite::where('id',$request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'nit' => $request->nit,
                'email' => $request->email,
                'phone' => $request->phone,
                'main_image' => $name_image,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'state' => 'active',
                'user_admin' => $request->user_admin,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'user_id' => Auth::user()->id
            ]);
            CategoryTouristSite::where('tourist_site_id',$request->id)->delete();
            for ($i = 0; $i < count($categorie); $i++){
                CategoryTouristSite::create([
                    'category_id'=>$categorie[$i]->id,
                    'tourist_site_id' => $request->id,
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
            $query = TouristSite::where('name', $extract_id[0])->exists();
        }else if($extract_id[1] == 'nit') {
            $query = TouristSite::where('nit', $extract_id[0])->exists();
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
        $site = TouristSite::where('id',$id)->first();
        $user = User::where('id',$site->user_admin)->first();
        $categorie = CategoryTouristSite::join('categories', 'categories.id', '=', 'categorie_tourist_sities.category_id')->where('categorie_tourist_sities.tourist_site_id',$id)
            ->select('categories.id', 'categories.name')->get();
        return response()->json(array($site,$user,$categorie));
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
        TouristSite::where('id',$request->id)->update([
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
        //
    }
}
