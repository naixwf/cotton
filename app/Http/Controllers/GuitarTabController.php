<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\GuitarTab;

class GuitarTabController extends Controller
{


    /**
     * Display a listing of the resource.
     * 查询吉他谱列表
     * @return Response
     */
    public function index()
    {
        $keyword = FacadesRequest::input('keyword');

        $list = DB::table("guitar_tabs")
            ->select('id', 'tab_name', 'singer_name')
            ->where('tab_name', 'like', "%$keyword%")
            ->orWhere('singer_name', 'like', "%$keyword%")
            ->paginate(15);
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
     * 转化吉他谱到html
     * @param $content
     * @return mixed
     */
    private function convertContent($content){
        $list = explode("\n",$content);
        $str = "";

        foreach($list as $l){

            //[F]拉  -> 拉<rt>F</rt>

            $l = str_replace("[","<ruby>&nbsp;<rt>",$l);
            $l = str_replace("]","</rt></ruby>",$l);
            $str = $str. "".$l."<br/>";
        }

        return $str;
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $model = DB::table("guitar_tabs")->select('id', 'tab_name', 'singer_name', 'content')
            ->where('id', '=', $id)->first();

        $model->content = $this->convertContent($model->content);

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
