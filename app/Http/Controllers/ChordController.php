<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;


/**
 * 资源：和弦
 * Class ChordController
 * @package App\Http\Controllers
 */
class ChordController extends Controller
{

    /**
     * 搜索和弦的页面，ajax调用载体
     */
    public function search(){
        return view("chord/search");
    }

//    /**
//     * 参数names
//     * Display a listing of the resource.
//     *
//     * @return Response
//     */
//    public function index()
//    {
//        $chordName = FacadesRequest::input('chordName');
//
//        $list = DB::table("chords")
//            ->select('id', 'full_name', 'variation', 'fingerboard')
//            ->where('full_name','=', $chordName)
//            ->get();
//        return response()->json($list);
//    }

    /**
     * 输入一组和弦，返回查询结果 TODO
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        $names = FacadesRequest::input('names');
        $nameList = explode(",",$names);

        $list = DB::table("chords")
            ->select('id', 'full_name', 'variation', 'fingerboard')
            ->where('variation','=',0)
            ->whereIn('full_name', $nameList)
            ->get();
        return response()->json($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $model = DB::table("chords")->select('id', 'full_name', 'variation', 'fingerboard')
            ->where('id', '=', $id)->first();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
