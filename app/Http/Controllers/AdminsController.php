<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();

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
          ]);
        
          $admin=User::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password'],
        ]);
        return response()->json(['message'=>'new Admin added',
        'Admin'=>$admin]);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $admin = User::where('id',$id)->first();
    return response()->json([ 'Admin'=>$admin]);}
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
        $admin=User::where('id',$id)->first();
        $admin->name=$data['name'];
        $admin->email=$data['email'];
        $admin->password=$data['password'];
        $admin->save();
        return response()->
        json([
            'status'=>200,
            'admin'=>$admin

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
        User::find($id)->delete();
    }
}
