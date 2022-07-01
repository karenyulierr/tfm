<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryTouristSite;
use App\TouristSite;
use App\Service;
use App\Rule;
use App\Image;
use App\Review;






use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();
        return view('welcome', compact('category'));
    }
    public function contact()
    {
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();
        return view('contact', compact('category'));
    }
    public function meet_rivera()
    {
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();
        return view('meet_rivera', compact('category'));
    }
    public function tourist_plans()
    {
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();
        return view('tourist_plans', compact('category'));
    }
    public function detail_plans()
    {
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();
        return view('detail_plans', compact('category'));
    }

    public function categoryview(Request $request)
    {
        //dd($request->category_id);
        // dd($request->has("category_id"));
        $touristSite = $this->getTouristSites($request->category_id);
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();
        return view('categoryview', ['category' => $category, 'touristSiteService' => $touristSite, 'active_link' => $request->category_id]);

        // return view('programas.index', ['program'=>$program , 'subjects'=>$subjects , 'auxiliars' => $auxiliary]);
    }
    public function getTouristSites($category_id)
    {
        $touristSite = CategoryTouristSite::join('tourist_sites', 'tourist_sites.id', '=', 'categorie_tourist_sities.tourist_site_id')->join('categories', 'categories.id', '=', 'categorie_tourist_sities.category_id')->where(['categorie_tourist_sities.category_id' => $category_id, 'tourist_sites.state' => 'active'])->select('tourist_sites.name', 'tourist_sites.id', 'tourist_sites.description', 'tourist_sites.main_image', 'categories.name as category')->Paginate(5);
        //return response()->json($touristSiteService);

        return $touristSite;
    }
    public function categoryviewdetail(Request $request)
    {
       
        $touristSite = $this->getTouristSiteDetail($request->_id);
        $getImagesTotal = $this->getImagesTotal($request->_id);
        $getReviews = $this->getReviews($request->_id);
        $getRules = $this->getRules($request->_id);
        $getImages = $this->getImages($request->_id);
        $getServiceTourisSite = $this->getServiceTourisSite($request->_id);
        $category = Category::where('state', 'active')->orderBy('name', 'asc')->get();

        return view('categoryviewdetail', ['category' => $category, 'touristSite' => $touristSite, 'getServiceTourisSite' => $getServiceTourisSite, 'getRules' => $getRules, 'getImages' => $getImages, 'getImagesTotal' => $getImagesTotal, 'getReviews' => $getReviews]);
    }
    public function getReviews($_id)
    {
        $getReviews = Review::where('tourist_sities_id', $_id)->paginate(2);

        return $getReviews;
    }
    public function getImages($_id)
    {
        $getImages = Image::where(['tourist_sities_id' => $_id, 'state' => 'active'])->Paginate(4);

        return $getImages;
    }
    public function getImagesTotal($_id)
    {
        $getImages = Image::where(['tourist_sities_id' => $_id, 'state' => 'active'])->orderBy('id', 'asc')->get();

        return $getImages;
    }
    public function getRules($_id)
    {
        $getRules = Rule::where(['rules.tourist_sities_id' => $_id, 'rules.state' => 'active'])->get();

        return $getRules;
    }

    public function getTouristSiteDetail($_id)
    {
        $getTouristSiteDetail = TouristSite::where(['tourist_sites.id' => $_id, 'tourist_sites.state' => 'active'])->get();

        return $getTouristSiteDetail;
    }
    public function getServiceTourisSite($_id)
    {
        $getServiceTourisSite = Service::join('tourist_site_services', 'tourist_site_services.service_id', '=', 'services.id')->join('tourist_sites', 'tourist_sites.id', '=', 'tourist_site_services.tourist_site_id')->where(['tourist_sites.id' => $_id, 'tourist_sites.state' => 'active', 'tourist_site_services.state' => 'active', 'services.state' => 'active'])->select('services.id', 'services.name', 'tourist_sites.id', 'tourist_site_services.id')->get();

        return $getServiceTourisSite;
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
        //
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
