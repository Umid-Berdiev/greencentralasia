<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MurojatMailController extends Controller
{
  public static function send($first, $second, $from, $receiver)
  {
    $objDemo = new \stdClass();
    $objDemo->demo_one = $first;
    $objDemo->demo_two = $second;
    $objDemo->sender = $from;
    $objDemo->receiver = $receiver;

    Mail::to($from)->send(new DemoEmail($objDemo));
  }
}
