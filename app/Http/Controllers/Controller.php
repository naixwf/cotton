<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Log;
use Illuminate\Support\Facades\DB;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
	{
		$this->beforeFilter('@enableQueryLogging');
		$this->afterFilter('@outputQueryLogging');
	}

	public function enableQueryLogging($route, $request)
	{
		Log::info('Started ' . $request->method() . ' ' . $request->server('PATH_INFO'));
		if(env("APP_DEBUG")){
			DB::connection()->enableQueryLog();
		}

	}

	public function outputQueryLogging()
	{
		foreach (DB::getQueryLog() as $query)
		{
			$replacements = $query['bindings'];
			$output = preg_replace_callback('/\?/', function($matches) use (&$replacements) {
				return array_shift($replacements);
			}, $query['query']);
			Log::info('(' . $query['time'] . ') ' . $output);
		}
	}


}
