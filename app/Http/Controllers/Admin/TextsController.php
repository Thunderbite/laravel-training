<?php 
namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Text;
use Illuminate\Http\Request;
use App\Helpers\ButtonHelper;
use App\Http\Controllers\Controller;

class TextsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.texts.index');
    }

    /**
     * Get the data for the datatable.
     *
     * @return Response
     */
    public function data()
    {
        return datatables()->of(Text::select('id as _id', 'keyword', 'text', 'created_at as _created', 'updated_at as _updated'))->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.texts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // Validation
        $this->validate(request(), [
            'keyword' => 'required|max:30',
            'text' => 'required|max:255',
        ]);
        // Add the text
        $text = Text::create([
            'keyword' => request('keyword'),
            'text' => request('text'),
        ]);

        // Redirect with success message
        session()->flash('success', 'The text has been added!');

        return redirect('/admin/texts');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

}
?>