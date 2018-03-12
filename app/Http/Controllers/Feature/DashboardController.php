<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Collection;

class DashboardController extends Controller
{
    /**
     * Create a new DashboardController instance.
     * Inject dependencies.
     *
     * @param  \App\Models\Collection $collection
     * @return void
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index', ['collection' => $this->collection::paginate(10)]);
    }
}
