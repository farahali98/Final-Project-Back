<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Testimonial;
class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Testimonial::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        $testimonial=new Testimonial();
        $testimonial->name=$data['name'];
       $testimonial->content=$data['content'];
       $testimonial->image=$path;
       $testimonial->save();
       return response()->json(['message'=>'new testimonial created',
                                'testimonial'=>$testimonial        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        $data=$request->all();
        $testimonial=Testimonial::where('id',$id)->first();
        $testimonial->name=$data['name'];
        $testimonial->content=$data['content'];
        $testimonial->image=$path;
        $testimonial->save();
        return response()->
        json([
            'status'=>200,
            'testimonial'=>$testimonial

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
        //
        $testimonial=Testimonial::where('id',$id)->first()->delete();
        return 'deleted';
    }
}
