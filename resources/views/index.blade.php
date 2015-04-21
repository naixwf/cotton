@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div style="text-align:center">这里写点什么，这是一个问题。好了，问题解决了。</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">社区精华</div>

                    <div class="panel-body tab-panel">


                            @foreach($list as $key => $val)


                                <div class="list-group-item tab-list-item ">
                                    <span class="badge">1</span>
                                    <div class="media-left">
                                        <img src="//cdn.v2ex.com/gravatar/cbdc2d2abea269348d232f9f265e7072?s=48&amp;d=retro"
                                             class="avatar" border="0" align="default">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="/showTab?id={{$val['id']}}">{{$val['tab_name']}}</a></h4>
                                        {{$val['singer_name']}}
                                    </div>
                                </div>


                            @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">cotton</div>
                    <div class="panel-body">
                        社区简介<br/>
                        社区简介<br/>
                        社区简介<br/>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">社区统计</div>
                    <div class="panel-body">
                        <table cellpadding="5" cellspacing="0" border="0" width="100%">
                            <tbody><tr>
                                <td width="50" align="right"><span class="gray">注册会员</span></td>
                                <td width="auto" align="left"><strong>112237</strong></td>
                            </tr>
                            <tr>
                                <td width="50" align="right"><span class="gray">主题</span></td>
                                <td width="auto" align="left"><strong>182676</strong></td>
                            </tr>
                            <tr>
                                <td width="50" align="right"><span class="gray">回复</span></td>
                                <td width="auto" align="left"><strong>1984372</strong></td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">热门讨论</div>
                    <div class="panel-body">
                        content B<br/>
                        content B<br/>
                        content B<br/>
                        content B<br/>
                        content B<br/>
                        content B<br/>
                        content B<br/>
                        content B<br/>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
