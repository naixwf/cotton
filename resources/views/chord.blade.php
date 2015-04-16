@extends('app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">


                <div class="panel panel-default ">
                    <div class="panel-heading">和弦字典</div>

                    <div class="panel-body">
                        <div class="row">
                            <form class="form-inline" id="searchbar" onsubmit="void(0);">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"></div>
                                        <input type="text" class="form-control" id="chord-name" name="chordName"
                                               placeholder="和弦名称">
                                    </div>
                                </div>
                                <button type="button" id="search-btn" class="btn btn-primary">查询</button>
                            </form>
                        </div>

                        <hr/>
                        <ul id="chords" class="row list-inline">
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script type="text/javascript">

        var width = 80;
        var height = 120;
        var lineWidth = 1;

        var lines = 6;//六根弦
        var grids = 6;//6根品丝

        /**
         * 由x1,y1向x2,y2画线
         * @param x1
         * @param y1
         * @param x2
         * @param y2
         */
        function drawLine(context, x1, y1, x2, y2) {
            context.strokeStyle = "black";
            context.moveTo(x1, y1);
            context.lineTo(x2, y2);
            context.stroke();
        }

        /**
         * 画手指标记
         * @param context
         * @param x
         * @param y
         * @param r
         */
        function drawFinger(context, x, y, r, number) {
            context.strokeStyle = "black";
            context.beginPath();
            context.arc(x, y, r, 0, 360, false);
            context.fillStyle = "black";//填充颜色,默认是黑色
            context.fill();//画实心圆
            context.closePath();

            if (number != undefined) {
                context.fillStyle = "white";
                context.textBaseline = "middle";
                context.textAlign = "center";
                context.font = "normal bold " + r + "px serif";
                context.fillText(number, x, y, r * 2);
            }

        }

        /**
         * 使用chord json绘制canvas
         * @param json
         * @param canvas
         */
        function draw(json, canvas) {


            var chord = JSON.parse(json.fingerboard);
            var name = json.full_name;


            var context = canvas.getContext("2d");
            //调整canvas坐标原点
            context.translate(20, 20);


            //设置线的宽度
            context.lineWidth = lineWidth;


            //弦间距
            var betweenLine = width / (lines - 1);
            //品格间距
            var betweenGrid = height / (grids - 1);

            //写和弦名称
            context.fillText(name, 0, -10);


            //画弦
            for (var i = 0; i < lines; i++) {
                var x1 = i * betweenLine;
                var y1 = 0;
                var x2 = i * betweenLine;
                var y2 = height;
                drawLine(context, x1, y1, x2, y2);
            }

            //画品格
            for (var i = 0; i < grids; i++) {
                var x1 = 0;
                var y1 = i * betweenGrid;
                var x2 = width;
                var y2 = i * betweenGrid;
                drawLine(context, x1, y1, x2, y2);
            }

            //画手指标识
            var minGrid = chord[0].num;
            var maxGrid = chord[0].num;
            for (var i = 0; i < lines; i++) {

                if ("full2" !== chord[i].head) {//只有head标记为空时，才有按弦
                    if (chord[i].num < minGrid) {
                        minGrid = chord[i].num;
                    }
                    if (chord[i].num > maxGrid) {
                        maxGrid = chord[i].num;
                    }
                } else {//head不为空的，说明此弦不能按，需要标记
                    var x = width - betweenLine * i;
                    context.textBaseline = "bottom";
                    context.textAlign = "center";
                    context.fillText("x", x, 0);
                }

            }


            if ((maxGrid - minGrid) > grids) {
                console.log("错误：和弦跨度大于6个品格" + maxGrid + "->" + minGrid);
                console.log(json);
            }


            for (var i = 0; i < lines; i++) {
                var c = chord[i];
                var num = c.num - minGrid;

                //大横按的回执和第一把位和弦回执不一样
                if (minGrid > 0) {
                    num++;
                }

                //小于零时不按
                if (num > 0) {
                    var x = width - betweenLine * i;
                    var y = betweenGrid * (num - 0.5);

                    drawFinger(context, x, y, betweenGrid / 4);
                }


            }

            //标记第一把位 TODO 调整字体样式
            if (minGrid > 0) {
                context.fillText(minGrid, -15, betweenGrid / 2);
            }

        }


        $('#search-btn').click(function () {
//            $.get("/chord?names=C,D,E,F,G,A,B", function (result) {
//
//
//            });


            jQuery.ajax({
                url: '/chord',
                data: $('#searchbar').serialize(),
                type: "GET",
                success: function (result) {

                    //初始化和弦列表显示区
                    var chords = $('#chords');
                    chords.html('');

                    for (var i in result) {

                        var li = $('<li>');

                        var canvas = $('<canvas>').attr({
                            id: 'chord' + result[i].id
                        });


                        draw(result[i], canvas[0]);

                        canvas.appendTo(li);


                        li.appendTo(chords);

                    }
                }
            });
        });


    </script>
@endsection
