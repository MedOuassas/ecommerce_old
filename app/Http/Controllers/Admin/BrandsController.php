<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\BrandsDatatable;
use Illuminate\Http\Request;
use App\Model\Brand;
use Up;
use Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrandsDatatable $brands)
    {
       return $brands->render('admin.brands.index', ['title' => trans('admin.brands')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create', ['title' => trans('admin.create')]);
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
                'name_en'   => 'required',
                'name_ar'   => 'required',
                'logo'      => 'sometimes|nullable|'.v_image()
            ], [], [
                'name_en'   => trans('admin.name_en'),
                'name_ar'   => trans('admin.name_ar'),
                'logo'      => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'brands',
                'upload_type'   =>'single',
                'delete_file'   =>''
            ]);
        }
        Brand::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('brands'));
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
        $brand = Brand::find($id);
        return view('admin.brands.edit', ['title' => trans('admin.edit'), 'brand' => $brand]);
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
                'name_en'   => 'required',
                'name_ar'   => 'required',
                'logo'      => 'sometimes|nullable|'.v_image(),
            ], [], [
                'name_en'   => trans('admin.name_en'),
                'name_ar'   => trans('admin.name_ar'),
                'logo'      => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'brands',
                'upload_type'   =>'single',
                'delete_file'   =>Brand::find($id)->logo
            ]);
        }
        Brand::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('brands'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        Storage::delete($brand->logo);
        $brand->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('brands'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $brand = Brand::find($id);
                Storage::delete($brand->logo);
                $brand->delete();
            }
        } else {
            $brand = Brand::find(request('item'));
            Storage::delete($brand->logo);
            $brand->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('brands'));
    }
}
