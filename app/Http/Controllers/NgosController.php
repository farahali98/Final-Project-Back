<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ngo;
class NgosController extends Controller
{  public function index()
    {
        //
        return Ngo::all();

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
        
          $ngo=Ngo::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password'],
            'location'=>$validatedData['location'],
        ]);
        return response()->json(['message'=>'new ngo added',
        'ngo'=>$ngo]);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $ngo = Ngo::where('id',$id)->first();
    return response()->json([ 'business'=>$ngo]);}
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
        $ngo=Ngo::where('id',$id)->first();
        $ngo->name=$data['name'];
        $ngo->email=$data['email'];
        $ngo->password=$data['password'];
        $ngo->location=$data['location'];


        $ngo->save();
        return response()->
        json([
            'status'=>200,
            'ngo'=>$ngo

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
        Ngo::find($id)->delete();
    }
}
