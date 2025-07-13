<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\AngkatanDataTable;
use Illuminate\Validation\Rule;
use App\Models\Angkatan;
use Validator;

class AngkatanController extends Controller
{
    public function index(AngkatanDataTable $dataTable)
    {
        return $dataTable->render('pages.angkatan.index');
    }

    public function new()
    {
        return view('pages.angkatan.new');
    }

    public function edit($id)
    {
        $data = Angkatan::findOrFail($id);
        return view('pages.angkatan.edit')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:angkatans',
            'biaya' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = Angkatan::create([
            'nama' => $request->nama,
            'biaya' => $request->biaya
        ]);

        return redirect()->route('angkatan.index')->with('success', 'Data tersimpan');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nama' => 'required|unique:angkatans,nama,'.$request->id,
            'biaya' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $data = Angkatan::findOrFail($request->id);

        Angkatan::where('id', $request->id)->update([
            'nama' => $request->nama,
            'biaya' => $request->biaya
        ]);

        return redirect()->route('angkatan.index')->with('success', 'Data terupdate');
    }

    public function destroy($id) {
        $data = Angkatan::findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('angkatan.index')->with('success', 'Data terhapus');
    }
}
