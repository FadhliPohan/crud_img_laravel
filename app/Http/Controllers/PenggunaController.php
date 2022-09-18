<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penggunas = Pengguna::latest()->paginate(5);

        return view('penggunas.index', compact('penggunas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penggunas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'foto' => ['required'],
            'alamat' => ['required', 'string'],
            'NIK' => ['required', 'int'],

        ]);

        $input = $request->all();

        // if ($foto = $request->file('foto')) {


        //     $destinasi = 'foto/';
        //     $penggunaImage = date('YmdHis') . "." .
        //         $foto->getClientOriginalExtension();
        //     $foto->move($destinasi, $penggunaImage);
        //     $input['foto'] = "$penggunaImage";
        // }


        if ($foto = $request->file('foto')) {

            // $destinasi = 'foto/';
            $penggunaImage = date('YmdHis') . "." .
                $foto->getClientOriginalExtension();
            // $foto->move($destinasi, $penggunaImage);
            $foto->storeAs('public/foto', $penggunaImage);
            $input['foto'] = "$penggunaImage";
        }

        Pengguna::create($input);

        return redirect()->route('penggunas.index')
            ->with('success', 'Produk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(Pengguna $pengguna)
    {
        return view('penggunas.show',compact('pengguna'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengguna $pengguna)
    {
        return view('penggunas.edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'NIK' => 'required',
        ]);

        $input = $request->all();

        if ($foto = $request->file('foto')) {
            $judulfoto = date('YmdHis') . "." .
                $foto->getClientOriginalExtension();
            $foto->storeAs('public/foto', $judulfoto);
            $input['foto'] = "$judulfoto";

            if ($pengguna->foto) {
                Storage::delete('public/foto/' . $pengguna->foto);
            }
        } else {
            $judulfoto = $pengguna->foto;
        }

        $pengguna->update($input);

        return redirect()->route('penggunas.index')
            ->with('succes', 'Pengguna telah Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengguna $pengguna)
    {
        Storage::delete('public/foto/' . $pengguna->foto);
        $pengguna->delete();

        return redirect()->route('penggunas.index')
            ->with('success', 'Pengguna telah dihapus');
    }
}
