<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\KelasDataTable;
use Illuminate\Validation\Rule;
use App\Models\Kelas;
use Validator;

class KelasController extends Controller
{
    public function index(KelasDataTable $dataTable)
    {
        return $dataTable->render('pages.kelas.index');
    }

    public function new()
    {
        return view('pages.kelas.new');
    }

    public function edit($id)
    {
        $data = Kelas::findOrFail($id);
        return view('pages.kelas.edit')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:kelas',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = Kelas::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data tersimpan');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nama' => 'required|unique:kelas,nama,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $data = Kelas::findOrFail($request->id);

        Kelas::where('id', $request->id)->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data terupdate');
    }

    public function destroy($id) {
        $data = Kelas::findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('kelas.index')->with('success', 'Data terhapus');
    }
}
