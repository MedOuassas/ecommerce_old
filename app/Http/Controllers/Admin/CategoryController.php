<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', ['title'=> trans('admin.categories')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', ['title'=> trans('admin.categories')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
                'categ_name_en'   => 'required',
                'categ_name_ar'   => 'required',
                'photo'           => 'sometimes|nullable|'.v_image(),
                'description'     => 'sometimes|nullable',
                'keywords'        => 'sometimes|nullable',
                'parent'          => 'sometimes|nullable|numeric'
            ], [], [
                'categ_name_en'   => trans('admin.categ_name_en'),
                'categ_name_ar'   => trans('admin.categ_name_ar'),
                'photo'           => trans('admin.photo'),
                'description'     => trans('admin.description'),
                'keywords'        => trans('admin.keywords'),
                'parent'          => trans('admin.parent')
            ]
        );
        if(request()->hasFile('photo')){
            $data['photo'] = up()->upload([
                'file'          =>'photo',
                'path'          =>'categories',
                'upload_type'   =>'single',
                'delete_file'   =>''
            ]);
        }
        
        Category::create($data);
        session()->flash('success', trans('admin.record_added'));

        return redirect(aurl('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['title'=> trans('admin.categories'), 'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
                'categ_name_en'   => 'required',
                'categ_name_ar'   => 'required',
                'photo'           => 'sometimes|nullable|'.v_image(),
                'description'     => 'sometimes|nullable',
                'keywords'        => 'sometimes|nullable',
                'parent'          => 'sometimes|nullable|numeric'
            ], [], [
                'categ_name_en'   => trans('admin.categ_name_en'),
                'categ_name_ar'   => trans('admin.categ_name_ar'),
                'photo'           => trans('admin.photo'),
                'description'     => trans('admin.description'),
                'keywords'        => trans('admin.keywords'),
                'parent'          => trans('admin.parent')
            ]
        );
        if(request()->hasFile('photo')){
            $data['photo'] = up()->upload([
                'file'          =>'photo',
                'path'          =>'categories',
                'upload_type'   =>'single',
                'delete_file'   =>Category::find($id)->photo
            ]);
        }
        
        Category::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_edited'));

        return redirect(aurl('categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete_category($id) {
        $categories = Category::where('parent',$id)->get();
        foreach ($categories as $category) {
            Self::delete_category($category->id);
            if(!empty($category->photo)){
                Storage::has($category->photo)?Storage::delete($category->photo):'';
            }
            Category::find($category->id)->delete();
        }
    }

    public function destroy($id)
    {
        Self::delete_category($id);
        
        $category = Category::find($id);
        if(!empty($category->photo)){
            Storage::has($category->photo)?Storage::delete($category->photo):'';
        }
        $category->delete();

        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('categories'));
    }
}
