<?php namespace App\Http\Controllers;

use App\GuitarTab;

class WelcomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
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
