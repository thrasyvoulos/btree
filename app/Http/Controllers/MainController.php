<?php


namespace App\Http\Controllers;

/**
 * Simple controller to render the upload form
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    public function createForm()
    {
        return view('main');
    }
}
