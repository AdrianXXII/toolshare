<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Auth::user()->offers;
        return view('offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $request = \App\Request::find($id);

        if($request->user->id  == Auth::user()->id){
            return redirect()->route('showRequest',['id' => $request->id]);
        }
        return view('offer.create', compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreOfferRequest $input, $id)
    {
        //
        $input['request_id'] = $id;
        $offer = new \App\Offer($input->all());
        Auth::user()->offers()->save($offer);

        return redirect('/');
    }
}
