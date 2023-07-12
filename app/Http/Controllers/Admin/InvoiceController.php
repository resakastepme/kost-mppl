<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Room;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoice.index', [
            'invoices' => Invoice::query()->with(['user', 'room'])->oldest('id')->get()
        ]);
    }

    public function create()
    {
        return view('admin.invoice.create');
    }

    public function store()
    {

        $attributes = array_merge($this->validate_invoice(), [
            'status' => 'Belum Dibayar',
        ]);


        $room_id = request()->input('room_id');
        $room = Room::find($room_id);
        $user_id = $room->user_id;

        $attributes['user_id'] = $user_id;

        Invoice::query()->create($attributes);

        return redirect(route('admin.invoices'))->with('success', 'Data berhasil disimpan');
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.invoice.edit', ['invoice' => $invoice]);
    }

    public function update(Invoice $invoice)
    {
        $attributes = $this->validate_invoice($invoice);

        $room_id = request()->input('room_id');
        $room = Room::find($room_id);
        $user_id = $room->user_id;

        $attributes['user_id'] = $user_id;

        $invoice->update($attributes);

        return redirect(route('admin.invoices'))->with('success', 'Data berhasil diedit');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return back()->with('success', 'Data terhapus');
    }

    public function payment_process(Invoice $invoice)
    {
        $attributes['status'] = 'Sudah Dibayar';

        $invoice->update($attributes);

        return back()->with('success', 'berhasil diubah');
    }

    protected function validate_invoice(?Invoice $invoice = null): array
    {
        $invoice ??= new Invoice();

        return request()->validate(
            [
                'due_date' => $invoice->exists ? [] : ['required'],
                'room_id' => $invoice->exists ? [Rule::in(Room::pluck('id'))] : ['required', Rule::in(Room::pluck('id'))],
            ],
            [
                'due_date' => [
                    'required' => ':attribute tidak boleh kosong',
                ],
                'room_id' => [
                    'required' => ':attribute tidak boleh kosong',
                    'in' => 'data :attribute tidak tersedia',
                ],
            ],
            [
                'attributes' => [
                    'room_id' => 'kamar',
                ],
            ]
        );
    }
}
