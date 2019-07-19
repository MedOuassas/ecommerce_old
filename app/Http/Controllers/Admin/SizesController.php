<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\SizesDatatable;
use Illuminate\Http\Request;
use App\Model\Size;
use App\Model\Category;
use Up;
use Storage;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizesDatatable $sizes)
    {
       return $sizes->render('admin.sizes.index', ['title' => trans('admin.sizes')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create', ['title' => trans('admin.create')]);
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
                'name'          => 'required',
                'is_public'     => 'required|in:yes,no',
                'category_id'   => 'required|numeric'
            ], [], [
                'name'          => trans('admin.name'),
                'is_public'     => trans('admin.is_public'),
                'category_id'   => trans('admin.category'),
            ]
        );
        Size::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('sizes'));
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
        $color = Size::find($id);
        return view('admin.sizes.edit', ['title' => trans('admin.edit'), 'color' => $color]);
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
            'name'          => 'required',
            'is_public'     => 'required|in:yes,no',
            'category_id'   => 'required|numeric'
        ], [], [
            'name'          => trans('admin.name'),
            'is_public'     => trans('admin.is_public'),
            'category_id'   => trans('admin.category'),
        ]);
        Size::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('sizes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Size::find($id);
        $color->delete();
        session()->flash('success', trans('admin.record_deleted'));

        return redirect(aurl('sizes'));
    }

    public function multi_delete() {
        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $color = Size::find($id);
                $color->delete();
            }
        } else {
            $color = Size::find(request('item'));
            $color->delete();
        }
        session()->flash('success', trans('admin.records_deleted'));

        return redirect(aurl('sizes'));
    }
}
