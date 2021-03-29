<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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
    
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        // preg_match_all('([+|-]*[0-9]+[/.]+[0-9]+)',$request['location'],$matches);    
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required|min:6',
            'location'=>'required',
            'url'=>'required',
            'phone_number'=>'required',]);
             $ngo=Ngo::create([
             'name'=>$validatedData['name'],
             'email'=>$validatedData['email'],
             'password'=>$validatedData['password'],
             'location'=>$validatedData['location'],
             'url'=>$validatedData['url'],
             'phone_number'=>$validatedData['phone_number'],
             'image'=>$path,
            //  'xcoordinate'=>floatval($matches[0][0]),
            //  'ycoordinate'=>floatval($matches[0][1]),

        ]);
        return response()->json(['message'=>'new ngo added',
        'ngo'=>$ngo]);}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id){
        $ngo = Ngo::where('id',$id)->first();
    return response()->json([ 'ngo'=>$ngo]);}
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
        $ngo=Ngo::where('id',$id)->first();
        $ngo->name=$data['name'];
        $ngo->email=$data['email'];
        $ngo->password=$data['password'];
        $ngo->location=$data['location'];
        $ngo->url=$data['url'];
        $ngo->phone_number=$data['phone_number'];
        $ngo->image=$path;
        // preg_match_all('([+|-]*[0-9]+[/.]+[0-9]+)',$request['location'],$matches);    
        // $ngo->xcoordinate=floatval($matches[0][0]);
        // $ngo->ycoordinate=floatval($matches[0][1]);
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
