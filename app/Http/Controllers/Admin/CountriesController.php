<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CountriesDatatable;
use Illuminate\Http\Request;
use App\Model\Country;
use Up;
use Storage;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDatatable $countries)
    {
       return $countries->render('admin.countries.index', ['title' => trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create', ['title' => trans('admin.create')]);
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
                'country_name_en'   => 'required',
                'country_name_ar'   => 'required',
                'code'              => 'required',
                'mob'               => 'required',
                'logo'              => 'required|'.v_image()
            ], [], [
                'country_name_en'   => trans('admin.country_name_en'),
                'country_name_ar'   => trans('admin.country_name_ar'),
                'code'              => trans('admin.code'),
                'mob'               => trans('admin.mob'),
                'logo'              => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'countries',
                'upload_type'   =>'single',
                'delete_file'   =>''
            ]);
        }
        Country::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('countries'));
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
        $country = Country::find($id);
        return view('admin.countries.edit', ['title' => trans('admin.edit'), 'country' => $country]);
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
                'country_name_en'   => 'required',
                'country_name_ar'   => 'required',
                'code'              => 'required',
                'mob'               => 'required',
                'logo'              => 'sometimes|nullable|'.v_image(),
            ], [], [
                'country_name_en'   => trans('admin.country_name_en'),
                'country_name_ar'   => trans('admin.country_name_ar'),
                'code'              => trans('admin.code'),
                'mob'               => trans('admin.mob'),
                'logo'              => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'countries',
                'upload_type'   =>'single',
                'delete_file'   =>Country::find($id)->logo
            ]);
        }
        Country::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $countrie = Country::find($id);
        Storage::delete($countrie->logo);
        $countrie->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('countries'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $countrie = Country::find($id);
                Storage::delete($countrie->logo);
                $countrie->delete();
            }
        } else {
            $countrie = Country::find(request('item'));
            Storage::delete($countrie->logo);
            $countrie->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('countries'));
    }
}
