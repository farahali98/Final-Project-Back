<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Food;
class FoodController extends Controller
{
    public function index()
    {

        return Food::all();

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
        $food=new Food();
        $food->name=$data['name'];
        $food->type=$data['type'];
        $food->business_id=$data['business_id'];
        $food->image=$path;
        $food->cooked_at=$data['cooked_at'];
        $food->quantity=$data['quantity'];
        $food->save();
        return response()->
        json([
            'status'=>200,
            'food'=>$food

        ]);

         
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $food = Food::where('id',$id)->first();
    return response()->json([ 'food'=>$food]);}
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
        $food=Food::where('id',$id)->first();
        $food->name=$data['name'];
        $food->business_id=$data['business_id'];
        $food->type=$data['type'];
        $food->quantity=$data['quantity'];
        $food->cooked_at=$data['cooked_at'];
        $food->image=$path;
        $food->save();
        return response()->
        json([
            'status'=>200,
            'food'=>$food

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
        Food::find($id)->delete();
    }
}
