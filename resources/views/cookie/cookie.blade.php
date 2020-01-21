<html>
<head>

</head>
<body>
<div class="container">
<h1>Cookie 결과 확인</h1>
<div style="width: 100%; background:rgb(240,240,240); border-radius: 5px;">
<h2>My cookie= {{$cookie or '값 없음'}}</h2></div>
<form method="get" action="cookie_ok">
<div class="form-group">
<label name="cookie">Cookie</label>
<input type="text" name="cookie" class="form-control" />
</div>
<button type="submit" class="btn btn-success">쿠키 전송하기</button>
</form>
</div>
</body>
</html>