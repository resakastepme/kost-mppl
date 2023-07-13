<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

//PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
class RecoveryController extends Controller
{
    public function index()
    {
        return view('auth.recovery');
    }
    public function store(Request $request)
    {

        $q = User::where('email', $request->email)->first();

        if(!$q){
            return redirect()->to('/recovery-request')->with('error', 'Email tidak terdaftar pada sistem!');
        }else{
        $name_enc = sha1($q['name']);
        $email_enc = sha1($q['email']);
        $spacing = "‎ ‎ ‎ ‎ ‎ ‎";

            //Start PHPMailer
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

<div>' . $spacing . $spacing . '‎ ‎ ‎<a href="http://127.0.0.1:8000/" target="blank" style="color: orange; font-size: 20px;">Kostify </a></div>

 <br>

 <h3 style="color: orange;">' . $spacing . $spacing . ' Hai, ' . $q["name"] . ' ! </h3>
 <h3 style="color: orange;">' . $spacing . $spacing . 'Kami baru saja menerima user request untuk ganti password.</h3>
 <h3 style="color: orange;">' . $spacing . $spacing . 'Klik link di bawah ini untuk melanjutkan:</h3>
<br>
<h4>' . $spacing . $spacing . '‎ ‎ ‎ <a href="http://127.0.0.1:8000/change-password?curln='.$name_enc.'&id='.$q['id'].'&curle='.$email_enc.' target="blank"> http://127.0.0.1:8000/change-password?curln='.$name_enc.'&id='.$q['id'].'&curle='.$email_enc.' </a></h4>
<br>
<h3 style="color: orange;">' . $spacing . $spacing . 'Jika anda tidak merasa melakukan request ganti password,</h3>
<h3 style="color: orange;">' . $spacing . $spacing . 'abaikan saja pemberitahuan ini!</h3>

<br><br>
<div class="text-center mb-3 mb-md-0" style="color: orange;">
                   ' . $spacing . $spacing . '&copy; <a class="border-bottom" href="http://127.0.0.1:800">Kostify</a>, All Right Reserved.
               </div>

 </section>
 </body>
 </html>

        ';
        $mail->addAddress($q['email']);

        if ($mail->send()) {
            return redirect()->route('login')->with('success_recovery', 'Email terkirim! Silahkan cek email anda');
        } else {
            return redirect()->route('login')->with('failed_recovery', 'Proses gagal! Silahkan coba beberapa saat lagi!');
        }

        //End PHPMailer

        }

    }

    public function recover(Request $request){

        $get_name = $request->curln;
        $get_email = $request->curle;
        $get_id = $request->id;

        if(!$get_name && !$get_email && !$get_id){
            return 'Error 404: Silahkan contact admin';
        }

        $db = User::where('id', $get_id)->first();

        if(!$db){
            return 'Error 404: Silahkan contact admin';
        }elseif( !sha1($db['name']) == $get_name ){
            return 'Error 404: Silahkan contact admin';
        }elseif( !sha1($db['email']) == $get_email ){
            return 'Error 404: Silahkan contact admin';
        }

        return view('auth.change-password', [
            'name' => $db['name']
        ]);

    }

    public function recoverp(Request $request){

        $pw = $request->password;
        $name = $request->hidden;

        $q = User::where('name', $name)->update([
            'password' => bcrypt($pw)
        ]);

        if($q){
            return redirect()->route('login')->with('success_change', 'Password berhasil diubah! Silahkan login');
        }else{
            return redirect()->route('login')->with('failed_change', 'Password gagal diubah! Silahkan hubungi admin');
        }

    }

}
