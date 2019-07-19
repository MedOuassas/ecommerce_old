<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingsDatatable;
use Illuminate\Http\Request;
use App\Model\Shipping;
use Up;
use Storage;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingsDatatable $shippings)
    {
       return $shippings->render('admin.shippings.index', ['title' => trans('admin.shippings')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shippings.create', ['title' => trans('admin.create')]);
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
                'user_id'   => 'required|numeric',
                'lat'       => 'sometimes|nullable|numeric',
                'lng'       => 'sometimes|nullable|numeric',
                'logo'      => 'sometimes|nullable|'.v_image()
            ], [], [
                'name'      => trans('admin.name'),
                'user_id'   => trans('admin.user'),
                'lat'       => trans('admin.lat'),
                'lng'       => trans('admin.lng'),
                'logo'      => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          => 'logo',
                'path'          => 'shippings',
                'upload_type'   => 'single',
                'delete_file'   => ''
            ]);
        }
        Shipping::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('shippings'));
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
        $shipping = Shipping::find($id);
        return view('admin.shippings.edit', ['title' => trans('admin.edit'), 'shipping' => $shipping]);
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
            'user_id'   => 'required|numeric',
            'lat'       => 'sometimes|nullable|numeric',
            'lng'       => 'sometimes|nullable|numeric',
            'logo'      => 'sometimes|nullable|'.v_image()
        ], [], [
            'name'      => trans('admin.name'),
            'user_id'   => trans('admin.user'),
            'lat'       => trans('admin.lat'),
            'lng'       => trans('admin.lng'),
            'logo'      => trans('admin.logo')
            ]
        );
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          => 'logo',
                'path'          => 'shippings',
                'upload_type'   => 'single',
                'delete_file'   => Shipping::find($id)->logo
            ]);
        }
        Shipping::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('shippings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::find($id);
        Storage::delete($shipping->logo);
        $shipping->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('shippings'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $shipping = Shipping::find($id);
                Storage::delete($shipping->logo);
                $shipping->delete();
            }
        } else {
            $shipping = Shipping::find(request('item'));
            Storage::delete($shipping->logo);
            $shipping->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('shippings'));
    }
}
