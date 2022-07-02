<?php

namespace App\Http\Controllers;

use App\TouristSite;
use App\User;
use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
                    $service = TouristSite::where([['user_admin', $id],['state','active']])->orderBy('name', 'ASC')->get();
                }
                return response()->json($service);
            case 1:
                $review = Review::where('tourist_sities_id', $_GET['id'])->orderBy('created_at', 'ASC')->get();
                return response()->json($review);
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
        $datos = Review::where(['tourist_sities_id' => request()->tourist_sities_id, 'email' => request()->email])->get();
        if ($datos->count() > 0) {
            if ($datos[0]->email == request()->email) {
                return redirect('categoryviewdetail?_id=' . request()->tourist_sities_id)->with('error', 'Ya se ha agregado una reseña con este correo  ' . request()->email);
            }
        } else {
            $review = request()->except('_token');
            Review::insert($review);
            return redirect('categoryviewdetail?_id=' . request()->tourist_sities_id)->with('mensaje', 'Reseña agregada, exitosamente');
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
