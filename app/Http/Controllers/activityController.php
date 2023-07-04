<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\activity;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class activityController extends Controller
{
           /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = activity::orderBy('name_activity', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return view('activity.tombol')->with('data', $data);
            })
            ->make(true);
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
        $validasi = Validator::make($request->all(), [
            'name_activity' => 'required',
            'user_handle' => 'required',
        ], [
            'name_activity.required' => 'Nama wajib diisi',
            'user_handle.required' => 'Email wajib diisi',
            'user_handle.user_handle' => 'Format user_handle wajib benar',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'name_activity' => $request->name_activity,
                'user_handle' => $request->user_handle
            ];
            activity::create($data);
            return response()->json(['success' => "Berhasil menyimpan data"]);
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
        $data = activity::where('id', $id)->first();
        return response()->json(['result' => $data]);
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
        $validasi = Validator::make($request->all(), [
            'name_activity' => 'required',
            'user_handle' => 'required',
        ], [
            'name_activity.required' => 'Name Activity wajib diisi',
            'user_handle.required' => 'User Handle wajib diisi'
            // 'user_handle.user_handle' => 'Format user_handle wajib benar',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'name_activity' => $request->name_activity,
                'user_handle' => $request->user_handle
            ];
            activity::where('id', $id)->update($data);
            return response()->json(['success' => "Berhasil melakukan update data"]);
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
        activity::where('id', $id)->delete();
    }
}
