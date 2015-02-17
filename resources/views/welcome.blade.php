<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title" id="title">Laravel 5</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
			</div>
		</div>

		<script src="bower_components/react/react.js"></script>
		<script src="bower_components/react/JSXTransformer.js"></script>
		<script type="text/jsx">
			React.render(
				<h1>Hello, world!</h1>,
                    document.getElementById('title')
			);
		</script>


	</body>
</html>
