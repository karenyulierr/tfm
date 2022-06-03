<?php

namespace App\Http\Controllers;

use App\Service;
use App\TouristSiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceSiteController extends Controller
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
                $sql = TouristSiteService::join('services', 'services.id', '=', 'tourist_site_services.service_id')
                    ->where('tourist_site_services.tourist_site_id',$_GET['site_id'])
                    ->select('tourist_site_services.*','services.id as id_service','services.name')->get();
                return response()->json($sql);
            case 1:
                $service = Service::where('state', 'active')->get();
                return response()->json($service);
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
        if($request->band == 'create') {
            TouristSiteService::create([
                'tourist_site_id' => $request->site_id,
                'service_id' => $request->service,
                'start_day' => $request->start_day,
                'end_day' => $request->end_day,
                'value' => $request->price,
                'state' => 'active',
                'user_id' => Auth::user()->id
            ]);
        }else{
            TouristSiteService::where('id',$request->id)->update([
                'tourist_site_id' => $request->site_id,
                'service_id' => $request->service,
                'start_day' => $request->start_day,
                'end_day' => $request->end_day,
                'value' => $request->price,
            ]);
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
        $sql = TouristSiteService::join('services', 'services.id', '=', 'tourist_site_services.service_id')
            ->where('tourist_site_services.id',$id)
            ->select('tourist_site_services.*','services.id as id_service','services.name')->first();

        return response()->json($sql);
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
        TouristSiteService::where('id',$request->id)->update([
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
