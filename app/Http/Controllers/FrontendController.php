<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Text;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    protected function getDate( $param )
    {
        $request = new Request();
        return strtotime( $request->query($param, null) );
    }    
       
    public function getTexts( $from, $to ) 
    {
	if ( $from && $to ) {
		return Text::select('keyword', 'text')
               ->whereBetween('created_at', [ date('Y-m-d H:i:s', $from), date('Y-m-d H:i:s', $to) ])
               ->get(); 
	}
	if ( $from ) {
		return Text::select('keyword', 'text')
               ->where('created_at' > date('Y-m-d H:i:s', $from) )
               ->get(); 
	}
	if ( $to ) {
		return Text::select('keyword', 'text')
               ->where('created_at' < date('Y-m-d H:i:s', $to) )
               ->get(); 
	}
	return Text::select('keyword', 'text')
               ->get(); 
    }
    
    public function index()
    {

	$from = $this->getDate( 'fromDate' );
	$to = $this->getDate( 'toDate' );

        $config = [
            'message' => 'Hello World', 
	    'texts' => $this->getTexts( $from, $to )
        ];

        
        // Serve the view
        return view('frontend.index', compact(['config']));
    }
}
?>