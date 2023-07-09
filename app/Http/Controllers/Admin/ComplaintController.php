<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('admin.complaint.index', [
            'complaints' => Complaint::query()->with(['user'])->latest('date_reported')->get()
        ]);
    }

    public function process(Complaint $complaint)
    {
        $attributes['status'] = 'Diproses';

        $complaint->update($attributes);

        return back()->with('success', 'berhasil diubah');
    }

    public function finished(Complaint $complaint)
    {
        $attributes['status'] = 'Selesai';

        $complaint->update($attributes);

        return back()->with('success', 'berhasil diubah');
    }
}
