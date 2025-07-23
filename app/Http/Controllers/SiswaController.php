<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SiswaDataTable;
use Illuminate\Validation\Rule;
use App\Models\Siswa;
use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\User;
use Validator;
use DB;

class SiswaController extends Controller
{
    public function index(SiswaDataTable $dataTable, Request $request)
    {
        $kelas = Kelas::pluck('nama','id');
        $dataTable->with([
            'kelas_id' => $request->get('kelas_id') // contoh parameter
        ]);
        return $dataTable->render('pages.siswa.index', [
            'kelas' => $kelas,
            'kelas_id' => $request->get('kelas_id')
        ]);
    }

    public function filter(Request $request)
    {
        $id_kelas = $request->id_kelas;
        return redirect()->route('siswa.index', ['kelas_id' => $id_kelas]);
    }

    public function new()
    {
        $angkatans = Angkatan::pluck('nama','id');
        $kelas = Kelas::pluck('nama','id');
        return view('pages.siswa.new')->with([
            'angkatans' => $angkatans,
            'kelas' => $kelas,
        ]);
    }

    public function edit($id)
    {
        $angkatans = Angkatan::pluck('nama','id');
        $kelas = Kelas::pluck('nama','id');
        $data = Siswa::findOrFail($id);

        return view('pages.siswa.edit')->with([
            'angkatans' => $angkatans,
            'kelas' => $kelas,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nisn' => 'required',
            'id_kelas' => 'required',
            'id_angkatan' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $user = User::create([
            'username' => $request->nisn,
            'nama' => $request->nama,
            'password' => bcrypt($request->nisn),
            'role' => 'SISWA'
        ]);

        $store = Siswa::create([
            'nisn' => $request->nisn,
            'alamat' => $request->alamat,
            'id_kelas' => $request->id_kelas,
            'id_angkatan' => $request->id_angkatan,
            'id_user' => $user->id
        ]);

        DB::commit();

        return redirect()->route('siswa.index')->with('success', 'Data tersimpan');
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'id_kelas' => 'required',
            'id_angkatan' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $find = Siswa::findOrFail($request->id);

        $user = User::where('id', $find->user->id)->update([
            'username' => $request->nisn,
            'nama' => $request->nama,
            'password' => bcrypt($request->nisn),
        ]);

        $store = Siswa::where('id', $request->id)->update([
            'nisn' => $request->nisn,
            'alamat' => $request->alamat,
            'id_kelas' => $request->id_kelas,
            'id_angkatan' => $request->id_angkatan
        ]);

        DB::commit();

        return redirect()->route('siswa.index')->with('success', 'Data terupdate');
    }

    public function destroy($id) {
        DB::beginTransaction();

        $data = Siswa::findOrFail($id);

        $data->delete();

        User::where('id', $data->id_user)->delete();

        DB::commit();

        return redirect()->route('siswa.index')->with('success', 'Data terhapus');
    }
}
