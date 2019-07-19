<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;
use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $users)
    {
        return $users->render('admin.users.index', ['title' => trans('admin.user_control')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['title' => trans('admin.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(), [
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'level'     => 'required|in:user,vendor,company',
                'password'  => 'required|min:6'
            ], [], [
                'name'      => trans('admin.name'),
                'email'     => trans('admin.email'),
                'level'     => trans('admin.level'),
                'password'  => trans('admin.password')
            ]);
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', ['title' => trans('admin.edit'), 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email,'.$id,
                'level'     => 'required|in:user,vendor,company',
                'password'  => 'sometimes|nullable|min:6'
            ], [], [
                'name'      => trans('admin.name'),
                'email'     => trans('admin.email'),
                'level'     => trans('admin.level'),
                'password'  => trans('admin.password')
            ]);
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
        }
        User::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('users'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            User::destroy(request('item'));
        } else {
            User::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('users'));
    }
}
