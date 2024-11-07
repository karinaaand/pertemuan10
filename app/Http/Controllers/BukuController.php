<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

Paginator::useBootstrapFive();

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // DataTables
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function indexpublic()
    {


        Paginator::useBootstrapFive();
        $data_buku = Buku::orderBy('id', 'desc')->get(); // Ambil semua data buku yang sudah diurutkan
        $total_buku = $data_buku->count(); // Menghitung jumlah total buku
        $total_harga = $data_buku->sum('harga'); // Menghitung jumlah total harga buku
        return view('index_public', compact('data_buku', 'total_buku', 'total_harga'));

    }
    public function indexadmin()
    {
        if (Auth::check()) {
            Paginator::useBootstrapFive();
        $data_buku = Buku::orderBy('id', 'desc')->get(); // Ambil semua data buku yang sudah diurutkan
        $total_buku = $data_buku->count(); // Menghitung jumlah total buku
        $total_harga = $data_buku->sum('harga'); // Menghitung jumlah total harga buku
        return view('index_admin', compact('data_buku', 'total_buku', 'total_harga'));
        }

        return redirect()->route('login')
                        ->withErrors([
                            'email' => 'Please login to access the dashboard.',
                        ])->onlyInput('email');
    }



    //N0 3 tugas praktikum
    public function index(){
        $batas = 10;
        $total_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        $total_harga = Buku::sum('harga');
        return view('index', compact('data_buku', 'no', 'total_buku', 'total_harga'));
    }


    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
                         ->orWhere('penulis', 'like', "%" . $cari . "%")
                         ->paginate($batas);

        $total_harga = 0;
        foreach($data_buku as $buku){
            $total_harga+=$buku->harga;
        }

        $total_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        // dd($data_buku);

        return view('search', compact('total_buku', 'data_buku', 'no', 'cari', 'total_harga'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'Please login to access the dashboard.',
        //     ])->onlyInput('email');
        // }
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // if (!(Auth::check())) {
    //     return redirect()->route('login')
    //     ->withErrors([
    //         'email' => 'Please login to access the dashboard.',
    //     ])->onlyInput('email');
    // }

    // Validasi input dari request
    $this->validate($request, [
        'judul' => 'required|string',
        'penulis' => 'required|string|max:30',
        'harga' => 'required|numeric',
        'tgl_terbit' => 'required|date',
        'photo' => 'image|nullable|max:1999'
    ], [
        'judul.required' => 'Kolom Judul Buku wajib diisi.',
        'penulis.required' => 'Kolom Nama Penulis wajib diisi.',
        'penulis.max' => 'Kolom Nama Penulis tidak boleh lebih dari 30 karakter.',
        'harga.required' => 'Kolom Harga Buku wajib diisi.',
        'harga.numeric' => 'Kolom Harga Buku harus berupa angka.',
        'tgl_terbit.required' => 'Kolom Tanggal Terbit wajib diisi.',
        'tgl_terbit.date' => 'Kolom Tanggal Terbit tidak valid.'
    ]);

    // Buat objek Buku baru dan isi datanya
    $buku = new Buku();
    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->harga = $request->harga;
    $buku->tgl_terbit = $request->tgl_terbit;

    // Proses upload foto jika ada
    if ($request->hasFile('photo')) {
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameSimpan = $filename . '_' . time() . '.' . $extension;

        // Simpan file di public/photos
        $path = $request->file('photo')->storeAs('public/photos', $filenameSimpan);

        // Simpan path ke database
        $buku->photo = 'photos/' . $filenameSimpan;
    }

    // Simpan data buku ke database
    $buku->save();

    return redirect()->route('buku.index.admin')->with('pesan', 'Data Buku Berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'Please login to access the dashboard.',
        //     ])->onlyInput('email');
        // }

        $buku = Buku::find($id);
        return view('edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'Please login to access the dashboard.',
        //     ])->onlyInput('email');
        // }

        $validatedData = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ], [
            'judul.required' => 'Kolom Judul Buku wajib diisi.',
            'penulis.required' => 'Kolom Nama Penulis wajib diisi.',
            'harga.required' => 'Kolom Harga Buku wajib diisi.',
            'harga.numeric' => 'Kolom Harga Buku harus berupa angka.',
            'tgl_terbit.required' => 'Kolom Tanggal Terbit wajib diisi.',
            'tgl_terbit.date' => 'Kolom Tanggal Terbit tidak valid.'
        ]);

        $buku = Buku::findOrFail($id);

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;

        // Simpan file di public/photos
        $path = $request->file('photo')->storeAs('public/photos', $filenameSimpan);

         // Simpan path ke database
        $buku->photo = 'photos/' . $filenameSimpan;

    }
        $buku->save(); // Menyimpan perubahan ke database
        return redirect()->route('buku.index.admin')->with('pesan', 'Buku berhasil diperbarui.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'Please login to access the dashboard.',
        //     ])->onlyInput('email');
        // }
        $buku = Buku::find($id);
        $buku->delete();

        return redirect()->route('buku.index.admin')->with('pesan', 'Buku berhasil dihapus.');
    }
}
