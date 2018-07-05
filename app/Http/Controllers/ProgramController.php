<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Kategori;
use Session;
class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $program = Program::with('Kategori')->get();
        return view('program.index',compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('program.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required|',
            'deskripsi' => 'required|',
            'gambar' => 'required|',
            'id_kategori' => 'required'
        ]);
       $program = new Program;
       $program->judul = $request->judul;
       $program->deskripsi = $request->deskripsi;
       $program->gambar = $request->gambar;
       $program->id_kategori = $request->id_kategori;
       $program->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$program->judul</b>"
        ]);
        return redirect()->route('program.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $program = Program::findOrFail($id);
        return view('program.show',compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $program = Program::findOrFail($id);
        $kategori = Kategori::all();
        $selectedKategori = Program::findOrFail($id)->id_kategori;
        return view('program.edit',compact('program','kategori','selectedKategori'));
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
        $this->validate($request,[
            'judul' => 'required|',
            'deskripsi' => 'required|',
            'gambar' => 'required|',
            'id_kategori' => 'required'
        ]);
       $program = Mahasiswa::findOrFail($id);
       $program->judul = $request->judul;
       $program->deskripsi = $request->deskripsi;
       $program->gambar = $request->gambar;
       $program->id_kategori = $request->id_kategori;
       $program->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$program->judul</b>"
        ]);
        return redirect()->route('program.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('program.index');
    }
}
