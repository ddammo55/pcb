<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>PCB팀 생산 공정 관리 시스템</title>

  <link rel="stylesheet" type="text/css" href="{{asset('semantic/semantic.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('/semantic/semantic.js')}}"></script>

{{-- <!-- 에디터 -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/decoupled-document/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script> -->
<!-- <script src="../ckeditor5-build-classic/ckeditor.js"></script> -->
 <!-- 에디터 --> --}}

{{-- <!--  ck에디터4 -->
<!-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script> --> --}}

<!--  teny에디터4 -->
<!-- <script src="{{ asset('../tinymce_4.3.8/js/tinymce/tinymce.min.js') }}"></script> -->
<script src="{{asset('/js/tinymce.min.js')}}"></script>

<!--  차트 js cdn -->
<script src="{{asset('js/Chart.js')}}"></script>




 <!-- Include stylesheet -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="../quill-1.3.6/quill.js"></script> -->

</head>
<style media="screen">
/* unvisited link */
a:link {
  color: #0861E3;
  font-weight: bold;
}
/* visited link */
a:visited {
  color: black;
}
/* mouse over link */
a:hover {
  color: black;
}
/* selected link */
a:active {
  color: black;
}
  body{
    padding: 1rem;
  }
  .pusher{
   margin-left: 15rem;
 }
 .text{
   margin-left: 1rem;
   margin-top: 2px;;
   color:white;
   font-size: 15px;
 }
 .ui.table td{
    padding: 1px;
 }

 .is-complete{
    text-decoration: line-through;
 }
</style>
<body>

  <div class="ui sidebar visible inverted vertical menu">
    <div class="item">
      <a class="ui logo icon image" href="/">
        <img src="/images/logo.png" width="30px" hight="30px">
      </a>
      <a href="/"><b data-tooltip="Go" data-position="bottom center">PCB팀 공정관리 시스템</b></a>
    </div>

    {{-- 게스트면 --}}
    @guest
    <a class="item" href="{{ url('/login') }}">
      <b>로그인</b>
    </a>

    {{-- 회원이면 --}}
    @else

    {{-- 회원이면 이름 출력 --}}
    <div class="item">
      <a  href="{{ url('/profile') }}">


            <img class="ui avatar image" src="{{ asset(auth()->user()->image) }}">{{auth()->user()->name}}

     </a>
   </div>

   {{-- 회원이면 로그아웃처리 --}}
   <a class="item" href="{{ route('logout') }}"
   onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">
   로그아웃
 </a>

 <form id="logout-form" action="{{ route('logout') }}" method="POST">
  @csrf
</form>
@endguest






<!-- <a class="item" href="/introduction/getting-started.html">
  <b>통계 보기</b>
</a> -->

<a class="item" href="#">
  <b><i class="database icon"></i>추적 성 관리</b>
</a>

<div class="menu">
  <a class="item" href="/product/create">
    시리얼번호 생성
  </a>

  <a class="item" href="/shipment">
    출하내역 입력
  </a>


  <a class="item" href="/boardSearchList">
    보드명 검색
  </a>

  <a class="item" href="/shipmentSearchList">
    출하내역 검색
  </a>
</div>


<a class="item" href="#">
  <b><i class="image outline icon"></i>제조영상</b>
</a>

<div class="menu">
  <a class="item" href="/pbas">
    PBA & ASSY
  </a>
</div>

<a class="item" href="#">
  <b><i class="file alternate outline icon"></i>작업 진행 현황</b>
</a>

<div class="menu">
  {{-- <a class="item" href="/works">
    작업지시 & 공수입력
  </a> --}}

  <a class="item" href="/workplan">
    작업지시 & 공수입력
  </a>
</div>

@if(Auth::check())
@if(auth()->user()->level >= 3)
<a class="item" href="#">
  <b><i class="lock icon"></i>관리자 메뉴</b>
</a>



<div class="menu">
  <a class="item" href="/projects">
    프로젝트 관리
  </a>
</div>


<div class="menu">
  <a class="item" href="/boardnames">
    보드명 관리
  </a>
</div>

{{-- <div class="menu">
  <a class="item" href="/projects/create">
    인수자 관리
  </a>
</div> --}}

<div class="menu">
  <a class="item" href="/member">
    팀원 관리
  </a>
</div>
@endif
@endif

<!-- 시리얼번호 검색 -->
<a class="item" href="#">
    <b><i class="truck icon"></i>시리얼번호 검색</b>
  </a>

<div class="item">
  <form method="get" action="/serialNameSearch">
    @csrf
    <div class="ui mini icon input">
      <input type="text" name="serial_name" placeholder="시리얼번호 검색">
      <i class="search icon"></i>

    </div>
  </form>
</div>

<!-- vtour -->
<a class="item" href="#">
    <b><i class="map marker alternate icon"></i>VR파노라마</b>
</a>

<a href="/vtour" alt="PCB팀 VR파노라마">
    <img style="margin:20px 20px 20px 20px;" class="ui small rounded image" src="/images/vtour.jpg">
</a>


</div>


<div class="pusher">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
  @include('flash::message')
  @yield('content')
</div>


<script>
  $('.ui.dropdown')
  .dropdown()
  ;
</script>



<!-- 맨위로가는 버튼 -->
<a href="#" class="go-top">맨 위로</a>

<!-- 커스텀js -->
<script src="/js/custom.js"></script>


@include('sweetalert::alert')
</body>
</html>
