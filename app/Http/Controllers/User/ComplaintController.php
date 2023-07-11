<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('user.complaint.index', [
            'complaints' => Complaint::query()->with(['user'])->latest('date_reported')->get()
        ]);
    }

    public function create()
    {
        return view('user.complaint.create');
    }

    public function store()
    {
        $attributes = array_merge(
            $this->validate_complaint(),
            [
                'user_id' => auth()->id(),
                'date_reported' => date('Y-m-d'),
                'status' => 'Belum Diproses'
            ]
        );

        Complaint::query()->create($attributes);

        return redirect(route('user.complaints'))->with('success', 'Data berhasil disimpan');
    }

    public function edit(Complaint $complaint)
    {
        return view('user.complaint.edit', ['complaint' => $complaint]);
    }

    public function update(Complaint $complaint)
    {
        $attributes = $this->validate_complaint($complaint);

        $complaint->update($attributes);

        return redirect(route('user.complaints'))->with('success', 'Data berhasil diedit');
    }

    public function destroy(Complaint $complaint)
    {

        $complaint->delete();

        return back()->with('success', 'Data terhapus');
    }

    protected function validate_complaint(?Complaint $complaint = null): array
    {
        $complaint ??= new Complaint();

        return request()->validate(
            [
                'complain' => ['required'],
            ],
            [
                'complain' => [
                    'required' => ':attribute tidak boleh kosong',
                ],
            ],
        );
    }
}
