<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MakersDatatable;
use Illuminate\Http\Request;
use App\Model\Maker;
use Up;
use Storage;

class MakersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MakersDatatable $makers)
    {
       return $makers->render('admin.makers.index', ['title' => trans('admin.makers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.makers.create', ['title' => trans('admin.create')]);
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
                'name_en'       => 'required',
                'name_ar'       => 'required',
                'contact_name'  => 'sometimes|nullable|string',
                'email'         => 'sometimes|nullable|email',
                'mobile'        => 'sometimes|nullable|numeric',
                'facebook'      => 'sometimes|nullable|url',
                'website'       => 'sometimes|nullable|url',
                'address'       => 'sometimes|nullable',
                'lat'           => 'sometimes|nullable|numeric',
                'lng'           => 'sometimes|nullable|numeric',
                'logo'          => 'sometimes|nullable|'.v_image()
            ], [], [
                'name_en'       => trans('admin.name_en'),
                'name_ar'       => trans('admin.name_ar'),
                'contact_name'  => trans('admin.contact_name'),
                'email'         => trans('admin.email'),
                'mobile'        => trans('admin.mobile'),
                'facebook'      => trans('admin.facebook'),
                'website'       => trans('admin.website'),
                'address'       => trans('admin.address'),
                'lat'           => trans('admin.lat'),
                'lng'           => trans('admin.lng'),
                'logo'          => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'makers',
                'upload_type'   =>'single',
                'delete_file'   =>''
            ]);
        }
        Maker::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('makers'));
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
        $maker = Maker::find($id);
        return view('admin.makers.edit', ['title' => trans('admin.edit'), 'maker' => $maker]);
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
            'name_en'       => 'required',
            'name_ar'       => 'required',
            'contact_name'  => 'sometimes|nullable|string',
            'email'         => 'sometimes|nullable|email',
            'mobile'        => 'sometimes|nullable|numeric',
            'facebook'      => 'sometimes|nullable|url',
            'website'       => 'sometimes|nullable|url',
            'address'       => 'sometimes|nullable',
            'lat'           => 'sometimes|nullable|numeric',
            'lng'           => 'sometimes|nullable|numeric',
            'logo'          => 'sometimes|nullable|'.v_image()
        ], [], [
            'name_en'       => trans('admin.name_en'),
            'name_ar'       => trans('admin.name_ar'),
            'contact_name'  => trans('admin.contact_name'),
            'email'         => trans('admin.email'),
            'mobile'        => trans('admin.mobile'),
            'facebook'      => trans('admin.facebook'),
            'website'       => trans('admin.website'),
            'address'       => trans('admin.address'),
            'lat'           => trans('admin.lat'),
            'lng'           => trans('admin.lng'),
            'logo'          => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'makers',
                'upload_type'   =>'single',
                'delete_file'   =>Maker::find($id)->logo
            ]);
        }
        Maker::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('makers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maker = Maker::find($id);
        Storage::delete($maker->logo);
        $maker->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('makers'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $maker = Maker::find($id);
                Storage::delete($maker->logo);
                $maker->delete();
            }
        } else {
            $maker = Maker::find(request('item'));
            Storage::delete($maker->logo);
            $maker->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('makers'));
    }
}
