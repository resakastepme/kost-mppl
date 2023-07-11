<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Room;

class InvoiceController extends Controller
{
    public function index()
    {

        $invoices = Invoice::query()->with(['user','room'])->where('user_id', auth()->id())->get();

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
        $invoice->update(request()->input('path'));

        return redirect(route('user.invoices'))->with('success', 'Data berhasil diedit');
    }

}
