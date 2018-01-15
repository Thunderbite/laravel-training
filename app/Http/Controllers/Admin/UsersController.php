<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ButtonHelper;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Get the data for the datatable.
     *
     * @return Response
     */
    public function data()
    {
        return datatables()->of(User::query())
            ->addColumn('actions', function ($user) {
                return ButtonHelper::groupEditDelete('users', $user->id);
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
        ]);

        // Create a random password
        $password = str_random(10);

        // Create the user
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($password),
        ]);

        // Send welcome email
        \Mail::to($user)->send(new \App\Mail\Admin\UserWelcome($user, $password));

        // Redirect with success message
        session()->flash('success', 'The user has been created!');

        return redirect('/admin/users');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $user->update($request->except('password', 'password_confirmation'));

        if ($request->has('password')):

            $user->password = Hash::make($request->input('password'));
        $user->save();

        endif;

        $request->session()->flash('success', 'The user details have been saved!');

        return redirect('/admin/users/'.$user->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();

        session()->flash('success', 'The user has been removed!');

        return redirect('/admin/users');
    }
}
