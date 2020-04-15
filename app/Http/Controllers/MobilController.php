<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelMobil;
use App\ModelJenis_mobil;
use Validator;
use Auth;

class MobilController extends Controller
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
          'id_jenis'=>'required',
          'nama_mobil'=>'required',
          'plat'=>'required',
          'merk'=>'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=ModelMobil::insert([
            'id_jenis'=>$request->id_jenis,
            'nama_mobil'=>$request->nama_mobil,
            'plat'=>$request->plat,
            'merk'=>$request->merk
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
          'id_jenis'=>'required',
          'nama_mobil'=>'required',
          'plat'=>'required',
          'merk'=>'required'

        ]);
      if($validator->fails()) {
        return response()->json($validator->errors());
      }
      $ubah=ModelMobil::where('id', $id)->update([
        'id_jenis'=>$request->id_jenis,
        'nama_mobil'=>$request->nama_mobil,
        'plat'=>$request->plat,
        'merk'=>$request->merk
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
        $hapus=ModelMobil::where('id',$id)->delete();
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
