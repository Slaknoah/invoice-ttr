<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
	{
	    return view('settings.index');
	}

	public function store(Request $request)
	{
	    $rules = Setting::getValidationRules();
	    $data = $this->validate($request, $rules);

	    $validSettings = array_keys($rules);

	    foreach ($data as $key => $val) {
	        if (in_array($key, $validSettings)) {
	            Setting::add($key, $val, Setting::getDataType($key));
	        }
	    }

	    Setting::updateCurrencies();

	    return redirect()->back()->with('success', 'Настройки сохранены!');
	}
}
