@extends('master')

@section('content')

<h1>실시간 작업 리스트 & 공수입력
    @if(Auth::check())
    @if(auth()->user()->level >= 3)
    <a class="ui primary button" href="/workplan/create">작업지시작성</a>
    @endif
    @endif
</h1>

{{-- @foreach($works as $work)
{{ $work->id}}
@endforeach --}}



<div class="ui relaxed divided list">
    <table class="ui selectable table">
        <thead>
            <tr>
                <th>작업지시번호</th>
                <th>제목</th>
                <th>프로젝트명</th>
                <th>프로젝트코드</th>
                <th>보드명</th>
                <th>assy</th>
                <th>수량</th>
                <th>작업시작일</th>
                <th>작업완료일</th>
                <th>작업진행상황</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>공수합계</th>
                @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
                <th>완료</th>
                @else
                <th>공수입력</th>
                @endif
            </tr>
        </thead>
        <tbody>



            @foreach($works as $workplan)
            <form action="/workplan/{{$workplan->id}}/edit" method="get">
            @csrf
            @method('PATCH')

            <tr>
                <td style="height:50px;">
                    {{-- con=0이면 종이 빈종이고 con=1이면 종이 빨강색으로 --}}
                    @if($workplan->con == 0)
                    <i class="big bell outline icon"></i>
                    @else
                    <i style="color:#56C295" class="big bell icon"></i>
                    @endif

                    <a href="/workplanAdminEdit/{{$workplan->id}}">
                    {{ $workplan->work_no }}
                    </a>
                </td>
                <td>{{ $workplan->title }}</td>
                <td><b style="color:teal">{{ $workplan->project_name }}</b></td>
                <td>{{ $workplan->project_code }}</td>
                <td>{{ $workplan->board_name }}</td>
                <td>{{ $workplan->assy }}</td>
                <td>{{ $workplan->ea }}</td>
                <td>{{ $workplan->start_product_date }}</td>
                <td>{{ $workplan->end_product_date }}</td>
                <td>{{ $workplan->status }}</td>
                <td>{{ $workplan->wr_user }}</td>
                <td>{{Carbon\Carbon::parse($workplan->created_at)->format('m-d')}}</td>

                <td>{{ $workplan->total }}/({{ round($workplan->total/60, 1)}}시간)</td>
                <td>
                    @if(Auth::check())
                    @if(auth()->user()->level == 2)
                    @if($workplan->con == 0)
                    <button class="ui primary button">공수입력</button>
                    @else
                    <button class="ui disabled button">입력완료</button>
                    @endif
                    @endif
                    @endif

                    @if(Auth::check())
                    @if($workplan->con != 1) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
                    @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
                    {{--  <label class="ui center aligned header">완료</label>  --}}
                    <input class="ui button" type="submit" value="완료" formaction="/workplanComplate/{{$workplan->id}}">
                    <input type="hidden" name="con" value=1>
                    @endif
                    @endif
                    @endif



                    @if($workplan->con != 0) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
                    @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
                    <input class="ui button" type="submit" value="취소" formaction="/workplanComplate/{{$workplan->id}}">
                    <input type="hidden" name="con" value=0>
                    @else
                    @endif
                    @endif
                </td>
            </tr>
            <tr>
                @if($workplan->memo == null)
                <td colspan="14"></td>
                @else
                <td style="padding-left:15px;" colspan="14" class="selectable warning"><i
                        class="clockwise rotated level up alternate icon"></i>{{$workplan->memo}}</td>
                @endif
            </tr>

            </form>

            @endforeach

        </tbody>
    </table>
</div>


{{-- 페이지네이션 --}}
@if($works->count())
{{ $works->links() }}
@endif

<br>
<br>


@endsection

