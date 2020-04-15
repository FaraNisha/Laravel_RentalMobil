<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelPenyewa;
use Validator;
use Auth;

class PenyewaController extends Controller
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
          'nama_penyewa'=>'required',
          'alamat'=>'required',
          'nohp'=>'required',
          'noktp'=>'required',
          'foto'=>'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=ModelPenyewa::insert([
            'nama_penyewa'=>$request->nama_penyewa,
            'alamat'=>$request->alamat,
            'nohp'=>$request->nohp,
            'noktp'=>$request->noktp,
            'foto'=>$request->foto
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
          'nama_penyewa'=>'required',
          'alamat'=>'required',
          'nohp'=>'required',
          'noktp'=>'required',
          'foto'=>'required'

        ]);
      if($validator->fails()) {
        return response()->json($validator->errors());
      }
      $ubah=ModelPenyewa::where('id', $id)->update([
        'nama_penyewa'=>$request->nama_penyewa,
        'alamat'=>$request->alamat,
        'nohp'=>$request->nohp,
        'noktp'=>$request->noktp,
        'foto'=>$request->foto
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
        $hapus=ModelPenyewa::where('id',$id)->delete();
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
