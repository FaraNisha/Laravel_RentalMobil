<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelJenis_mobil;
use Validator;
use Auth;

class Jenis_MobilController extends Controller
{
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::user()->level=="admin") {
        $validator=Validator::make($request->all(),[
          'jenis_mobil'=>'required',
          'harga_sewa'=>'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=ModelJenis_mobil::insert([
            'jenis_mobil'=>$request->jenis_mobil,
            'harga_sewa'=>$request->harga_sewa
          ]);
          if($insert){
            $status="sukses";
          }
          else {
            $status="gagal";
          }
          return response()->json(compact('status'));
        }
      }
      else {
        echo "Mohon maaf, data hanya bisa diakses oleh Admin";
      }
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
        if(Auth::user()->level=="admin") {
        $validator=Validator::make($request->all(),
        [
          'jenis_mobil'=>'required',
          'harga_sewa'=>'required'

        ]);
      if($validator->fails()) {
        return response()->json($validator->errors());
      }
      $ubah=ModelJenis_mobil::where('id', $id)->update([
        'jenis_mobil'=>$request->jenis_mobil,
        'harga_sewa'=>$request->harga_sewa
      ]);
      if($ubah){
        return response()->json(['status'=>1]);
      }
      else {
        return response()->json(['status'=>0]);
      }
    }
    else {
      echo "Mohon maaf, data hanya bisa diakses oleh Admin";
    }
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
        if(Auth::user()->level=="admin") {
        $hapus=ModelJenis_mobil::where('id',$id)->delete();
        if($hapus){
          return response()->json(['status'=>1]);
        }
        else {
          return response()->json(['status'=>0]);
        }
      }
      else {
        echo "Mohon maaf, data hanya bisa diakses oleh Admin";
      }
    }
}
