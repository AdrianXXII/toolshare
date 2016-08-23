<?php

namespace App\Http\Controllers;

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
        //
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
        $requests = \App\Request::where('category_id', $input['category_id'])->whereHas('requestAttributes', function($q) use ($attributes)
        {
            $q->whereIn('id', $attributes);
        }, '=', count($attributes))->get();

        return view('request.find', compact('requests'));
    }
}
