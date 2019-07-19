<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;
use Up;
class Settings extends Controller
{
    public function setting() {
        return view('admin.settings', ['title'=> trans('admin.settings')]);
    }

    public function setting_save() {
        $data = $this->validate(request(), [
            'logo'                  => v_image(),
            'icon'                  => v_image(),
            'sitename_en'           => 'required',
            'sitename_ar'           => 'required',
            'email'                 => 'required|email',
            'main_lang'             => 'required',
            'description'           => 'required',
            'keywords'              => 'required',
            'status'                => 'required|in:open,close',
            'message_maintenance'   => 'required'
        ], [], [
            'logo'                  => trans('admin.logo'),
            'icon'                  => trans('admin.icon'),
            'sitename_en'           => trans('admin.sitename_en'),
            'sitename_ar'           => trans('admin.sitename_ar'),
            'email'                 => trans('admin.email'),
            'main_lang'             => trans('admin.main_lang'),
            'description'           => trans('admin.description'),
            'keywords'              => trans('admin.keywords'),
            'status'                => trans('admin.status'),
            'message_maintenance'   => trans('admin.message_maintenance')
        ]);
        if(request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file'          =>'logo',
                'path'          =>'settings',
                'upload_type'   =>'single',
                'delete_file'   =>setting()->logo
            ]);
        }
        if(request()->hasFile('icon')) {
            //!empty(setting()->icon) ? \Storage::delete(setting()->icon):'';
            //$data['icon'] = request()->file('icon')->store('settings');
            $data['icon'] = up()->upload([
                'file'          =>'icon',
                'path'          =>'settings',
                'upload_type'   =>'single',
                'delete_file'   =>setting()->icon
            ]);
        }
        Setting::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings'));
    }
}
