<?php namespace App\Http\Controllers;

use App\GuitarTab;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function chord()
	{
		return view('chord');
	}

	/**
	 * 吉他谱页面框架
	 *
	 * @return Response
	 */
	public function tab()
	{
		return view('tab');
	}

	/**
	 * 网站首页
	 * @return \Illuminate\View\View
	 */
	public function index()
	{


		$list = GuitarTab::all(['id','tab_name','singer_name'])->take(10);

		$data['list'] =$list;

		return view('index',$data);
	}

}
