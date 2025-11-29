<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    public function index()
    {
        return view('group.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id'        => 'nullable|exists:groups,id',
            'name'      => 'required|string|max:255',
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);
        Group::updateOrCreate(
            ['id' => $validated['id'] ?? null],
            $validated
        );
        return redirect()->route('group')->with('success', 'Group saved successfully.');
    }
    public function api(Request $request)
    {
        $query = Group::query();
        return DataTables::of($query)
            ->addIndexColumn() // Tambah nomor urut (opsional)
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d-m-Y H:i');
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-warning btn-edit" 
                    data-id="' . $row->id . '" 
                    data-name="' . $row->name . '" 
                    data-type_group="' . $row->type_group . '"
                    data-latitude="' . $row->latitude . '"
                    data-longitude="' . $row->longitude . '">
                    Edit
                </button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
