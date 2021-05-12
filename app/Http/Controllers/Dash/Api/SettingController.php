<?php

namespace App\Http\Controllers\Dash\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\DashSettings;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = new DashSettings();

        return Setting::orderBy('created_at', 'desc')->paginate($settings->setting_per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = new Setting;
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:2', 'unique:settings'],
            'payload' => ['required', 'string', 'max:255'],
            'group' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message' => $validator->errors()],401);
        }
        $setting->name = $request->name;
        $setting->payload = $request->payload;
        $setting->group = $request->group;
        $setting->locked = $request->boolean('locked') ? 1 : 0;
        if ($setting->save()) {
            return response()->json(['status'=>true, 'message' => 'Setting Added Successfully']);
        }else{
            return response()->json(['status'=>false, 'message' => $validator]);
        }

    }
    public function update(Request $request, $id)
    {
        $id = Setting::find($id);

        request()->validate([
            'name' => 'required',
            'group' => 'required',
            'payload' => 'required',
            'locked' => 'required'
        ]);
        $id->name = $request->name;
        $id->group = $request->group;
        $id->payload = $request->payload;
        $id->locked = $request->locked;
        $id->save();
        return response()->json($id);
    }
    public function destroy($id)
    {
        Setting::where('id', $id)->delete();
    }

}
