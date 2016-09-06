<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Mail;
use Storage;

use App\AttributeVal;
use App\Category;
use App\Http\Requests;
use App\RequestAttribute;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RequestController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $attributes = AttributeVal::all();
        return view('request.create', compact('categories','attributes'));
    }

    /**
     * Stores the request called
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateRequest $input)
    {
        $request = new \App\Request($input->all());
        Auth::user()->requests()->save($request);

        $request->requestAttributes()->attach($input['attribute1']);

        if($input['attribute2']){
            $request->requestAttributes()->attach(AttributeVal::find($input['attribute2']));
        }
        if($input['attribute3']){
            $request->requestAttributes()->attach( AttributeVal::find($input['attribute3']));
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = \App\Request::find($id);
        return view('request.show', compact('request'));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Form to seach for Requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $categories = Category::all();
        $attributes = AttributeVal::all();
        return view('request.search', compact('categories','attributes'));
    }

    /**
     * Finds the matching Requests
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $input)
    {
        $attributes = [$input['attribute1']];
        if ($input['attribute2']) $attributes[] = $input['attribute2'];
        if ($input['attribute3']) $attributes[] = $input['attribute3'];
        $requests = \App\Request::where('category_id', $input['category_id'])->where('selected_offer',null)
            ->where('date','>=',date("Y-m-d"))->whereHas('requestAttributes', function($q) use ($attributes)
        {
            $q->whereIn('id', $attributes);
        }, '=', count($attributes))->get();

        return view('request.find', compact('requests'));
    }

    /**
     * Selects the offer for the Request
     *
     * @param $rid
     * @param $cid
     */
    public function select($rid, $cid)
    {
        $request = \App\Request::find($rid);
        if($request->offer != null){
            return redirect('/');
        }

        $offer = \App\Offer::find($cid);

        if($request != null && $offer != null) {
            $request->offer()->associate($offer);
            $request->save();

            $xml = $request->makeXML();

            Mail::send('emails.request', ['request' => $request, 'xml' => $xml], function ($m) use ($request, $xml) {
                $m->from('toolshare@dimaro.ch', 'toolshare');
                $m->to($request->user->email)->subject('Angebot angenommen!');
                $m->attachData(Storage::get($xml), 'order.xml');
            });

            Mail::send('emails.offer', ['request' => $request, 'xml' => $xml], function ($m) use ($request, $xml) {
                $m->from('toolshare@dimaro.ch', 'toolshare');
                $m->to($request->offer->user->email)->subject('Ihr Angebot wurde angenommen!');
                $m->attachData(Storage::get($xml), 'order.xml');
            });
        }

        return response(Storage::get($xml))->header('Content-Type','text/xml');
    }

    public function xml($id)
    {
        $request = \App\Request::find($id);
        $xml = $request->makeXML();

        Mail::send('emails.request', ['request' => $request, 'xml' => $xml], function ($m) use ($request, $xml) {
            $m->from('toolshare@dimaro.ch', 'toolshare');
            $m->to($request->user->email)->subject('Your Reminder!');
            $m->attachData(Storage::get($xml), 'order.xml');
        });


        return response(Storage::get($xml))->header('Content-Type','text/xml');
    }
}
