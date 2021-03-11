<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
class BusinessController extends Controller
{
    public function index()
    {
        //
        return Business::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required|min:6',
            'location'=>'required',
          ]);
        
          $business=Business::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password'],
        ]);
        return response()->json(['message'=>'new business added',
        'business'=>$business]);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $business = Business::where('id',$id)->first();
    return response()->json([ 'business'=>$business]);}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data=$request->all();
        $business=Business::where('id',$id)->first();
        $business->name=$data['name'];
        $business->email=$data['email'];
        $business->password=$data['password'];
        $business->location=$data['location'];


        $business->save();
        return response()->
        json([
            'status'=>200,
            'business'=>$business

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
        Business::find($id)->delete();
    }}
