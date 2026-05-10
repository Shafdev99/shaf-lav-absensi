<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KirimEmailController extends Controller
{
    public function index()
    {

        Mail::to('filshaufiq@gmail.com')->send(new KirimEmail());
        return '<h4> Sukses mengirimkan email! </h4>';
    }
}
