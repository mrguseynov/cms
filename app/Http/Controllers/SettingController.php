<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dash.settings.index',[
            'settings' => Setting::all()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dash.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:2', 'unique:settings'],
            'payload' => ['required', 'string', 'max:255'],
            'group' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }
        $setting =  Setting::create([
            'name' => $request->name,
            'payload' => $request->payload,
            'group' => $request->group,
            'locked' => $request->boolean('locked') ? 1 : 0,
        ]);

        //$setting->save();
        //return redirect()->back()->withSuccess(__('User was successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('dash.settings.edit',[
            'setting' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->name = $request->name;
        $setting->payload = $request->payload;
        $setting->group = $request->group;
        $setting->locked = $request->boolean('locked') ? 1 : 0;

        $setting->save();
        return redirect()->back()->withSuccess(__('Password was successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
