@extends('master')

@section('content')

<h1>작업지시 작성하기</h1>

<div class="ui stackable two column grid">

    <div class="column">

        <form class="ui form" method="POST" action="/workplan">
            @csrf


            <div class="field">
                {{-- <label>구분</label> --}}
                {{-- <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title"
                    value="{{ old('title') }}" placeholder="작업명"> --}}

                    <div class="field">
                        <div class="ui selection dropdown">
                          <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="hidden" name="title" value="{{ old('title') }}" placeholder="구분" required>
                          <i class="dropdown icon"></i>
                          <div class="default text" style="color: black">구분</div>
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
                <div class="ui selection dropdown">
                    <input type="hidden" name="project_name" value="{{ old('project_name') }}" required>
                    <i class="dropdown icon"></i>
                    <div class="default text" style="color: black">프로젝트명</div>
                    <div class="menu">
                        @foreach ($project_lists as $project_list)
                        <div class="item">{{$project_list->project_name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="ui selection dropdown">
                    <input type="hidden" name="project_code" value="{{ old('project_code') }}">
                    <i class="dropdown icon"></i>
                    <div class="default text" style="color: black">프로젝트코드</div>
                    <div class="menu">
                        @foreach ($project_lists as $project_list)
                        <div class="item">{{$project_list->project_code }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="ui selection dropdown">
                    <input type="hidden" name="board_name" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text" style="color: black">보드명</div>

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
                    value="{{ old('assy') }}" placeholder="ASSY명">
            </div>

            <div class="{{ $errors->has('ea') ? 'field error' : 'field' }}">
                <label>수량</label>
                <input class="input" type="number" name="ea" value="{{ old('ea') }}" placeholder="수량" required>
            </div>

            <div class="field">
                <label>편성</label>
                <input class="input {{ $errors->has('set_set') ? 'is-danger' : '' }}" type="number" name="set_set"
                    value="{{ old('set_set') }}" placeholder="편성">
            </div>

            <?php $dd = date("Y-m-d")?>
            <div class="field">
                <label>생산시작일</label>
                <input type="date" name="start_product_date" value="<?=$dd?>" placeholder="생산시작일">
            </div>

            <div class="field">
                <label>생산완료일</label>
                <input type="date" name="end_product_date" value="<?=$dd?>" placeholder="생산완료일">
            </div>


            <div class="field">
                <label>메모</label>
                <input class="input {{ $errors->has('memo') ? 'is-danger' : '' }}" type="text" name="memo"
                    value="{{ old('memo') }}" placeholder="메모">
                    <input type="hidden" name="con" value=0>
            </div>


            <div class="field">
                <button class="ui button" type="submit">작성완료</button>
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
@endsection
