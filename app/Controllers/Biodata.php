<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Biodata extends BaseController
{
    public function abdul()
    {
        return view('biodata/abdul');
    }

    public function wildan()
    {
        return view('biodata/wildan');
    }

    public function gumelar()
    {
        return view('biodata/gumelar');
    }

    public function arya()
    {
        return view('biodata/arya');
    }

    public function nandra()
    {
        return view('biodata/nandra');
    }
}