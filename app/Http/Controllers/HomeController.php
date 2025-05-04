<?php

namespace App\Http\Controllers;

use App\Services\TableService;
use Illuminate\Http\Request;

class HomeController extends Controller {

    private $tableService;

    public function __construct(TableService $tableService) {
        $this->tableService = $tableService;
    }
    public function home() {
        // return redirect()->route('dashboard');
        return view('content.landing.index');
    }

    public function dashboard() {
        return redirect()->to('levels');
    }
}
