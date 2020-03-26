@extends('master')

@section('content')


<h1>작업지시 수정하기</h1>

<div class="ui segment">
    <h2 class="ui left floated header">
        {{$workplan->project_name. ' ' .$workplan->title. ' '.$workplan->board_name. ' ' .$workplan->assy. ' ' .$workplan->ea.'EA'}}
        &nbsp;작업공수
        <strong style="color:#059DF5">Total: {{  number_format($workSum) }}분 ({{ round($workSum/60, 1)}}시간) </strong>
    </h2>

    <div class="ui clearing divider"></div>
    <p>작업지시번호: {{ $workplan->work_no}} | 작업일:{{ $workplan->start_product_date}} ~ {{ $workplan->end_product_date}} |
        작성자:{{ $workplan->wr_user }} | 작성일:{{ $workplan->created_at}}</p>
    <p>메모 : {{ $workplan->memo}} </p>
</div>

@foreach ($worktasks as $worktask)


{{--  공수리스트  --}}
<div class="ui segment">

<img style="width:60px; height:60px;" class="ui avatar image" src="{{ asset(auth()->user()->image) }}">
{{$worktask->process}}
{{$worktask->wr_user}}
{{$worktask->wt}}
{{ $worktask->description }}
{{$worktask->created_at}}

</div>

<div class="ui segment">
<div class="ui ordered steps">
    <div class="completed step">
      <div class="content">
        <div class="title">Shipping</div>
        <div class="description">Choose your shipping options</div>
      </div>
    </div>
    <div class="completed step">
      <div class="content">
        <div class="title">Billing</div>
        <div class="description">Enter billing information</div>
      </div>
    </div>
    <div class="active step">
      <div class="content">
        <div class="title">Confirm Order</div>
        <div class="description">Verify order details</div>
      </div>
    </div>
  </div>
</div>
@endforeach

{{-- 댓글작성하기 구현 --}}
<div class="ui segment">
<form class="ui form" method="POST" action="/worktask/{{ $workplan->id }}/tasks">
	@csrf
  <div class="field">
    <label>공수 입력</label>
    <div class="field">
        <div class="ui selection dropdown">
            <input class="input {{ $errors->has('process') ? 'is-danger' : '' }}" type="hidden" name="process"
                value="{{ old('process') }}" placeholder="방법" required>
            <i class="dropdown icon"></i>
            <div class="default text" style="color: black">공정명</div>
            <div class="menu">
                <div class="item">SMD프로그램</div>
                <div class="item">SMT설비교체</div>
                <div class="item">SMT작업공정</div>
                <div class="item">AOI검사공정</div>
                <div class="item">DIP공정</div>
                <div class="item">웨이브솔더링및컷팅공정</div>
                <div class="item">터치업및세척공정</div>
                <div class="item">코팅공정</div>
                <div class="item">ASSY공정</div>
                <div class="item">포장작업</div>
                <div class="item">무작업</div>
            </div>
        </div>
    </div>
    <input type="number" name="wt" placeholder="공수" required>
    <br>
    <br>
    <input class="ui primary button" type="submit" value="작성하기">
  </div>
</form>
</div>
{{-- 댓글작성하기 구현 --}}


<div class="ui segment">
    <div class="ui two column very relaxed grid">
      <div class="column">


            <div class="column">

                <form class="ui form" method="POST" action="/workplanAdminUpdate/{{$workplan->id}}">
                    @csrf
                    @method('PATCH')


                    <div class="field">
                        {{-- <label>구분</label> --}}
                        {{-- <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title"
                        value="{{ old('title') }}" placeholder="작업명"> --}}

                        <div class="field">
                            <label>구분</label>
                            <div class="ui selection dropdown">
                                <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="hidden" name="title"
                                    value="{{ $workplan->title }}" required>
                                <i class="dropdown icon"></i>

                                <div class="default text" style="color: black">{{$workplan->title}}</div>

                                <div class="menu">
                                    <div class="item">양산품</div>
                                    <div class="item">보수품</div>
                                    <div class="item">수리품</div>
                                    <div class="item">설변품</div>
                                    <div class="item">기타</div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="{{ $errors->has('project_name') ? 'field error' : 'field' }}">
                        <label>프로젝트명</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="project_name" value="{{ $workplan->project_name }}" required>
                            <i class="dropdown icon"></i>
                            <div class="default text" style="color: black">{{$workplan->project_name}}</div>
                            <div class="menu">
                                @foreach ($project_lists as $project_list)
                                <div class="item">{{$project_list->project_name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label>프로젝트 코드</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="project_code" value="{{$workplan->project_code}}">
                            <i class="dropdown icon"></i>
                            <div class="default text" style="color: black">{{$workplan->project_code}}</div>
                            <div class="menu">
                                @foreach ($project_lists as $project_list)
                                <div class="item">{{$project_list->project_code }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label>보드명</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="board_name" value="{{$workplan->board_name}}">
                            <i class="dropdown icon"></i>
                            <div class="default text" style="color: black">{{$workplan->board_name}}</div>

                            <div class="menu">
                                @foreach($board_names as $board_name)
                                <div class="item">{{ $board_name->boardname }}</div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="field">
                        <label>ASSY명</label>
                        <input class="input {{ $errors->has('ass') ? 'is-danger' : '' }}" type="text" name="assy"
                            value="{{ $workplan->assy }}" placeholder="ASSY명">
                    </div>

                    <div class="{{ $errors->has('ea') ? 'field error' : 'field' }}">
                        <label>수량</label>
                        <input class="input" type="number" name="ea" value="{{ $workplan->ea}}" placeholder="수량" required>
                    </div>

                    <div class="field">
                        <label>편성</label>
                        <input class="input {{ $errors->has('set_set') ? 'is-danger' : '' }}" type="number" name="set_set"
                            value="{{ $workplan->set_set}}" placeholder="편성">
                    </div>

                    <?php $dd = date("Y-m-d")?>
                    <div class="field">
                        <label>생산시작일</label>
                        <input type="date" name="start_product_date" value="{{ $workplan->start_product_date}}"
                            placeholder="생산시작일">
                    </div>

                    <div class="field">
                        <label>생산완료일</label>
                        <input type="date" name="end_product_date" value="{{ $workplan->end_product_date}}" placeholder="생산완료일">
                    </div>


                    <div class="field">
                        <label>메모</label>
                        <input class="input {{ $errors->has('memo') ? 'is-danger' : '' }}" type="text" name="memo"
                            value="{{ $workplan->memo}}" placeholder="메모">
                        <input type="hidden" name="con" value=0>
                    </div>


                    <div class="field">
                        <button class="ui teal button" type="submit">수정완료</button>
                    </div>
                </form>




                @if($errors->any())
                <div class="ui pink inverted segment">

                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>



      </div>
      <div class="column">

        <form class="ui form" action="/workplan/{{ $workplan->id }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="ui two column very relaxed grid">
                <div class="column">

                    <div class="field">
                        <label>SMD 공수입력</label>
                        <input class="input {{ $errors->has('smt') ? 'is-danger' : '' }} disabled field" type="number" name="smt"
                            value="{{$workplan->smt}}" placeholder="SMT공수" required>
                    </div>

                    <div class="field">
                        <label>DIP 공수입력</label>
                        <input class="input {{ $errors->has('dip') ? 'is-danger' : '' }} disabled field" type="number" name="dip"
                            value="{{$workplan->dip}}" placeholder="DIP공수" required>
                    </div>

                    <div class="field">
                        <label>AOI 공수입력</label>
                        <input class="input {{ $errors->has('aoi') ? 'is-danger' : '' }} disabled field" type="number" name="aoi"
                            value="{{$workplan->aoi}}" placeholder="aoi공수" required>
                    </div>

                    <div class="field">
                        <label>웨이브솔더링 + 컷팅 공수입력</label>
                        <input class="input {{ $errors->has('wave') ? 'is-danger' : '' }} disabled field" type="number" name="wave"
                            value="{{$workplan->wave}}" placeholder="wave공수" required>
                    </div>

                    <div class="field">
                        <label>터치업 + 세척 공수입력</label>
                        <input class="input {{ $errors->has('touchup') ? 'is-danger' : '' }} disabled field" type="number" name="touchup"
                            value="{{$workplan->touchup}}" placeholder="touchup공수" required>
                    </div>



                </div>
                <div class="column">

                    <div class="field">
                        <label>단품검사</label>
                        <input class="input {{ $errors->has('item_inspection') ? 'is-danger' : '' }} disabled field" type="number"
                            name="item_inspection" value="{{$workplan->item_inspection}}" placeholder="item_inspection공수"
                            required>
                    </div>

                    <div class="field">
                        <label>코팅</label>
                        <input class="input {{ $errors->has('coting') ? 'is-danger' : '' }} disabled field" type="number" name="coting"
                            value="{{$workplan->coting}}" placeholder="coting공수" required>
                    </div>

                    <div class="field">
                        <label>ASSY</label>
                        <input class="input {{ $errors->has('ass') ? 'is-danger' : '' }} disabled field" type="number" name="ass"
                            value="{{$workplan->ass}}" placeholder="ass공수" required>
                    </div>

                    <div class="field">
                        <label>포장작업</label>
                        <input class="input {{ $errors->has('packing') ? 'is-danger' : '' }} disabled field" type="number" name="packing"
                            value="{{$workplan->packing}}" placeholder="packing공수" required>
                    </div>

                    <div class="field">
                        <label>준비작업</label>
                        <input class="input {{ $errors->has('ready') ? 'is-danger' : '' }} disabled field" type="number" name="ready"
                            value="{{$workplan->ready}}" placeholder="ready공수" required>
                    </div>

                    <div class="field">
                        <label>무작업</label>
                        <input class="input {{ $errors->has('ect1') ? 'is-danger' : '' }} disabled field" type="number" name="ect1"
                            value="{{$workplan->ect1}}" placeholder="기타공수" required>
                    </div>

                </div>
            </div>
            <br>
            {{--  <button class="ui  primary  button" type="submit">공수입력</button>  --}}
        </form>


      </div>
    </div>
    <div class="ui vertical divider">
      and
    </div>
  </div>







@endsection
