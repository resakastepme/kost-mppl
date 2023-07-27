<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {

        $invoices = Invoice::query()->with(['user', 'room'])->where('user_id', auth()->id())->get();

        return view('user.invoice.index', [
            'invoices' => $invoices
        ]);
    }

    public function edit(Invoice $invoice)
    {
        return view('user.invoice.edit', ['invoice' => $invoice]);
    }

    public function update(Invoice $invoice)
    {
        if (request()->file('path') ?? false) {
            $path = request()->file('path')->store('payments', 'public');

            $invoice->update(['path' => $path]);
        }

        return redirect(route('user.invoices'))->with('success', 'Data berhasil diedit');
    }
}
