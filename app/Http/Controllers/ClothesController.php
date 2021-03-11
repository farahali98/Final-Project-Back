<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Clothe;
class ClothesController extends Controller
{
    public function index()
    {
        //
        return Clothe::all();

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
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $clothe = Clothe::where('id',$id)->first();
       return response()->json(['clothe'=>$clothe]);}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        $data=$request->all();
        $clothe=new Clothe();
        $clothe->name=$data['name'];
        $clothe->type=$data['type'];
        $clothe->business_id=$data['business_id'];
        $clothe->image=$path;
        $clothe->quantity=$data['quantity'];
        $clothe->save();
        return response()->
        json([
            'status'=>200,
            'clothe'=>$clothe

        ]);

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
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        $data=$request->all();
        $clothe=Clothe::where('id',$id)->first();
        $clothe->name=$data['name'];
        $clothe->business_id=$data['business_id'];
        $clothe->type=$data['type'];
        $clothe->quantity=$data['quantity'];
        $clothe->image=$path;
        $clothe->save();
        return response()->
        json([
            'status'=>200,
            'clothe'=>$clothe

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
        Clothe::find($id)->delete();
    }
}
