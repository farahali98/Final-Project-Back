<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Business;
class BusinessController extends Controller
{
    public function index()
    {
        //
        return Business::with('Food')->get();

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
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        //
        preg_match_all('([+|-]*[0-9]+[/.]+[0-9]+)',$request['location'],$matches);    

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required|min:6',
            'location'=>'required',
            'url'=>'required',
            'phone_number'=>'required',

          ]);
        
          $business=Business::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password'],
            'url'=>$validatedData['url'],
            'image'=>$path,
            'phone_number'=>$validatedData['phone_number'],
            'location'=>$validatedData['location'],
            'xcoordinate'=>floatval($matches[0][0]),
            'ycoordinate'=>floatval($matches[0][1]),  
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
    $business = Business::where('id',$id)->with('Food')->first();
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

        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        $data=$request->all();
        $business=Business::where('id',$id)->first();
        $business->name=$data['name'];
        $business->email=$data['email'];
        $business->password=$data['password'];
        $business->location=$data['location'];
        $business->url=$data['url'];
        $business->phone_number=$data['phone_number'];
        $business->image=$path;
        preg_match_all('([+|-]*[0-9]+[/.]+[0-9]+)',$request['location'],$matches);    
        $business->xcoordinate=floatval($matches[0][0]);
        $business->ycoordinate=floatval($matches[0][1]);       
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
    }
}
