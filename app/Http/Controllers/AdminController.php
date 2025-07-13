<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use Illuminate\Validation\Rule;
use App\Models\User;
use Validator;

class AdminController extends Controller
{
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.index');
    }

    public function new()
    {
        return view('pages.admin.new');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.edit')->with([
            'data' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'min:3',
                'unique:users',
            ],
            'nama' => 'required|min:3',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'role' => 'ADMIN'
        ]);

        return redirect()->route('admin.index')->with('success', 'Data tersimpan');
    }

     public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'username' => [
                'required',
                'min:3',
                'unique:users,username,'.$request->id,
            ],
            'nama' => 'required|min:3',
            'password' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $user = User::findOrFail($request->id);

        User::where('id', $request->id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('admin.index')->with('success', 'Data terupdate');
    }

    public function destroy($id) {
        $data = User::findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('admin.index')->with('success', 'Data terhapus');
    }
}
