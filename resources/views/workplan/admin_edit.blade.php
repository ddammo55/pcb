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



  </div>







@endsection
