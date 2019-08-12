<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Offerimage;

class PublicController extends Controller
{
    public function index() {
        return view('frontend.home');
    }
}

?>
