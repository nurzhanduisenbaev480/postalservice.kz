<?php


namespace App\Http\Controllers\Cabinet;


class CabinetController extends \App\Http\Controllers\Controller
{
    public function index(){

        return view('cabinet.cabinet');
    }
}
