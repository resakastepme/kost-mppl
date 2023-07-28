<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Room;
use App\Models\User;
use Illuminate\Validation\Rule;

//PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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

        //Start PHPMailer
        $email = User::where('id', $user_id)->first();
        $room = Room::where('user_id', $user_id)->first();
        // $invoice = Invoice::where('user_id', $user_id)->first();
        $spacing = "‎ ‎ ‎ ‎ ‎ ‎";

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "resa.komara.akbari@gmail.com";
        $mail->Password = "bkjrpudbpadvfzjf";
        $mail->Subject = "[Kostify Notification] No Reply!";
        $mail->setFrom("resa.komara.akbari@gmail.com");
        $mail->isHTML(true);
        $mail->Body = '

        <html>

 <body>

 <section class="portfolio bg-image bg-dark" id="forecast" style="background-image: url(https://cdn.discordapp.com/attachments/758697084039462913/1037737471259185152/PHPMAILER.jpg); background-size: cover; background-repeat: no-repeat; background-blend-mode: overlay;">

<div>' . $spacing . $spacing . '‎ ‎ ‎<a href="' . route('user.landing_page') . '" target="blank" style="color: orange; font-size: 20px;">Kostify </a></div>

 <br>

 <h3 style="color: orange;">' . $spacing . $spacing . ' Hai, ' . $email["name"] . ' ! </h3>
 <h3 style="color: orange;">' . $spacing . $spacing . 'Kami beritahukan bahwa anda memiliki tagihan kamar Kost terbaru</h3>
 <h3 style="color: orange;">' . $spacing . $spacing . 'Dengan rincian sebagai berikut:</h3>

<div style="margin: 5%;">
 <table border="1" style="color: white; margin:1;">

    <tr>
        <th> Nomor Kamar </th>
        <th> Nama Penghuni </th>
        <th> Total Tagihan </th>
        <th> Jatuh Tempo </th>
        <th> Status </th>
    </tr>
    <tr>
        <td class="text-center"> ' . $room["room_number"] . ' </td>
        <td class="text-center"> ' . $email["name"] . ' </td>
        <td class="text-center"> Rp. ' . number_format($room["price"], 2, ',', '.') . ' </td>
        <td class="text-center"> ' . date("d/m/Y", strtotime($attributes["due_date"])) . ' </td>
        <td class="text-center"> <span class="badge bg-danger"> ' . $attributes["status"] . ' </span> </td>
    </tr>

 </table>
 </div>

<h3 style="color: orange;">' . $spacing . $spacing . 'Mohon lakukan pembayaran sebelum Jatuh Tempo dengan</h3>
<h3 style="color: orange;">' . $spacing . $spacing . 'meng-akses langsung website Kostify atau dengan klik link dibawah ini:</h3>
<h4>' . $spacing . $spacing . '‎ ‎ ‎ <a href="http://127.0.0.1:8000/user/invoices" target="blank"> http://127.0.0.1:8000/user/invoices </a></h4>

<br><br>
<div class="text-center mb-3 mb-md-0" style="color: orange;">
                   ' . $spacing . $spacing . '&copy; <a class="border-bottom" href="http://127.0.0.1:800">Kostify</a>, All Right Reserved.
               </div>

 </section>
 </body>
 </html>

        ';
        $mail->addAddress($email['email']);

        if ($mail->send()) {
            // echo '<script type="text/javascript"> console.log("Email Sent!"); </script>';
            // Log::info('Email Sent!');
            error_log('Email Sent!');
            return redirect(route('admin.invoices'))->with('success', 'Data berhasil disimpan')->with('emailReport', 'Email Sent!');
        } else {
            // echo '<script type="text/javascript"> console.log("Email Failed!"); </script>';
            // Log::info('Email Failed!');
            error_log('Email Failed!');
            return redirect(route('admin.invoices'))->with('success', 'Data berhasil disimpan')->with('emailReport', 'Email Failed!');
        }

        //End PHPMailer

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
                'room_id' => 'Kamar',
                'due_date' => 'Tanggal Jatuh Tempo',
            ]
        );
    }
}
