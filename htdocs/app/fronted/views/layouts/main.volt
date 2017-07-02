<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="themes-lab" name="author" />
    
    {{ stylesheet_link("css/bootstrap.min.css") }}
	{{ stylesheet_link("css/style.css") }}
	{{ stylesheet_link("css/gridforms.css") }}
	{{ stylesheet_link("css/simple-sidebar.css") }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- 1.モバイル表示用の省略メニュー -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle"
			data-toggle="collapse" data-target="#navbar-menu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">特定健診予約システム</a>
		</div>
		
		

		<!-- 2.ナビゲーションメニュー -->
		<div class="collapse navbar-collapse" id="navbar-menu">
		<ul class="nav navbar-nav">
			<li><a href="{{url('checkup')}}">特定健診種別登録</a></li>
			<li><a href="{{url('examinationcategory')}}">カテゴリー登録</a></li>
			<li><a href="{{url('examination')}}">検査項目登録</a></li>
			<li><a href="{{url('examinationitem')}}">取扱い品登録</a></li>
			<li><a href="{{url('record')}}">検査表表示</a></li>
			

		</ul>
		</div>
		
	</div>
</nav>

<div id="wrapper">
{{content()}}
<div class="modal fade" id="modal-responsive-loading" data-backdrop="static" aria-hidden="true">
                    {{ image("img/gif-load.gif") }}
</div>
<div class="footer" id="footer">
<div class="credit">

</div>
</div>
</div>



<script type="text/javascript" src="{{url('js/ext/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/ext/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/ext/jquery.validate.japlugin.js')}}"></script>

{{ javascript_include('js/gridforms.js') }}

<script>
	function loadJs(js) {
	    var path = "{{url('')}}" + js;
		document.write("<script src=" + js +  "><\/script>");
	}
	
	var checkError = function(response) {
		if('responseHeader' in response){
			var responseHeader = response.responseHeader;
			var string = responseHeader['code'].split('-');
			if(string.length == 5) {
				return string[4];
			} else {
		   	 return 0;
			}
		} else {
			return 99;
		}
	}
	
	function ajaxPostForm(event, $form, $action, callback) {
		 if(event) {
		 	event.preventDefault();
		 }
		 var $button = $form.find('button');
		 var data  = $form.serialize();
		 $.ajax({
			url: $action,
			type: 'post',
			dataType: 'jsonp',
			jsonpCallback: 'hoge',
			async:true,
			data: data,
			timeout: 10000,  // 単位はミリ秒

			// 送信前
			beforeSend: function(xhr, settings) {
				// ボタンを無効化し、二重送信を防止
				if($button) {
					$button.attr('disabled', true);
				}
			},
			// 応答後
			complete: function(xhr, textStatus) {
				// ボタンを有効化し、再送信を許可
				if($button) {
					$button.attr('disabled', false);
				}
			},
			success: callback,
			error: function(xhr, textStatus, error) {
			alert('error');
				alert(xhr.responseText);
			}
		});
		return false;
	}
</script>
<script src="{{url(js)}}"></script>
</body>
</html>