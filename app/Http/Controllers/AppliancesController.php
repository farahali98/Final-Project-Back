<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Appliances;

class AppliancesController extends Controller
{
    public function index()
    {

        return Appliances::all();

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
        $data=$request->all();
        $appliance=new Appliances();
        $appliance->name=$data['name'];
        $appliance->type=$data['type'];
        $appliance->business_id=$data['business_id'];
        $appliance->image=$path;

        $appliance->quantity=$data['quantity'];
        $appliance->save();
        return response()->
        json([
            'status'=>200,
            'appliance'=>$appliance

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $appliance = Appliances::where('id',$id)->first();
    return response()->json([ 'appliance'=>$appliance]);}
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
        $appliance=Appliances::where('id',$id)->first();
        $appliance->name=$data['name'];
        $appliance->business_id=$data['business_id'];
        $appliance->type=$data['type'];
        $appliance->quantity=$data['quantity'];
        $appliance->image=$path;
        $appliance->save();
        return response()->
        json([
            'status'=>200,
            'appliance'=>$appliance

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
        Appliances::find($id)->delete();
    }
}
