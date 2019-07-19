<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\StatesDatatable;
use Illuminate\Http\Request;
use App\Model\State;
use App\Model\City;
use Form;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDatatable $states)
    {
        return $states->render('admin.states.index', ['title' => trans('admin.states')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            if(request()->has('country_id')){
                $select=request()->has('select')?request('select'):'';
                return Form::select('city_id', City::where('country_id', request('country_id'))->pluck('city_name_en','id'), $select, ['class' => 'form-control', 'placeholder'=>trans('admin.city')]);
            }
        }
        return view('admin.states.create', ['title' => trans('admin.create')]);
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
                'state_name_en'   => 'required',
                'state_name_ar'   => 'required',
                'country_id'      => 'required',
                'city_id'         => 'required'
            ], [], [
                'state_name_en'   => trans('admin.state_name_en'),
                'state_name_ar'   => trans('admin.state_name_ar'),
                'country_id'      => trans('admin.country'),
                'city_id'         => trans('admin.city')
            ]
        );
        
        State::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('states'));
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
        $state = State::find($id);
        return view('admin.states.edit', ['title' => trans('admin.edit'), 'state' => $state]);
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
                'state_name_en'   => 'required',
                'state_name_ar'   => 'required',
                'country_id'      => 'required',
                'city_id'         => 'required'
            ], [], [
                'state_name_en'   => trans('admin.state_name_en'),
                'state_name_ar'   => trans('admin.state_name_ar'),
                'country_id'      => trans('admin.country'),
                'city_id'         => trans('admin.city')
            ]
        );
        
        State::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::find($id)->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('states'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            State::destroy(request('item'));
        } else {
            State::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('states'));
    }
}
