<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Text;
use Illuminate\Database\Query\Builder;

class FrontendController extends Controller
{

    
    public function index()
    {
        $fromDate = date('Y-m-d' . ' 00:00:00', time());
        $toDate = date('Y-m-d' . ' 22:00:40', time()); 
        $config = [
            'message' => 'The same thing we do every night, Pinky - try to take over the world!',
            'texts' =>Text::select('keyword', 'text')->whereBetween('created_at', [$fromDate, $toDate] )->get()
        ]; 


        // Serve the view
        return view('frontend.index', compact(['config']));
    }
}
?>