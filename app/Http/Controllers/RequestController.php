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
    /**
     * RequestController constructor. Makes sure the user is logged in.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $attributes = [];
        $requests = null;
        if ($input['attribute1']) $attributes[] = $input['attribute1'];
        if ($input['attribute2']) $attributes[] = $input['attribute2'];
        if ($input['attribute3']) $attributes[] = $input['attribute3'];
        if (count($attributes) > 0) {
            $requests = \App\Request::where('category_id', $input['category_id'])->where('selected_offer',null)
                ->where('user_id', '!=', Auth::User()->id)->where('date','>=',date("Y-m-d"))
                ->whereHas('requestAttributes', function($q) use ($attributes)
                {
                    $q->whereIn('id', $attributes);
                }, '=', count($attributes))->get();
        } else {
            $requests = \App\Request::where('category_id', $input['category_id'])->where('selected_offer',null)
                ->where('user_id', '!=', Auth::User()->id)->where('date','>=',date("Y-m-d"))->get();
        }


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

        return redirect('/');
    }

    /**
     * This function mainly serves as a means to easily test the xml generation and sending of mails.
     * @param $id
     * @return mixed
     */
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
