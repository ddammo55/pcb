@extends('master')

@section('content')

<div class="ui segment">
  <h2 class="ui left floated header">{{$workplan->project_name. ' ' .$workplan->title. ' '.$workplan->board_name. ' ' .$workplan->assy. ' ' .$workplan->ea.'EA'}} &nbsp;작업공수입력
   <strong style="color:#059DF5">Total: {{  number_format($workSum) }}분 ({{ round($workSum/60, 1)}}시간) </strong>
  </h2>

  <div class="ui clearing divider"></div>
  <p>작업지시번호: {{ $workplan->work_no}} | 작업일:{{ $workplan->start_product_date}} ~ {{ $workplan->end_product_date}} | 작성자:{{ $workplan->wr_user }} | 작성일:{{ $workplan->created_at}}</p>
  <p>메모 : {{ $workplan->memo}} </p>
</div>


<div class="ui segment">
  <form class="ui form" action="/workplan/{{ $workplan->id }}" method="POST">
    @csrf
    @method('PATCH')
  <div class="ui two column very relaxed grid">
        <div class="column">

          <div class="field">
            <label>SMD 공수입력</label>
            <input class="input {{ $errors->has('smt') ? 'is-danger' : '' }}" type="number" name="smt"
              value="{{$workplan->smt}}" placeholder="SMT공수" required>
          </div>

          <div class="field">
            <label>DIP 공수입력</label>
            <input class="input {{ $errors->has('dip') ? 'is-danger' : '' }}" type="number" name="dip"
              value="{{$workplan->dip}}" placeholder="DIP공수" required>
          </div>

          <div class="field">
            <label>AOI 공수입력</label>
            <input class="input {{ $errors->has('aoi') ? 'is-danger' : '' }}" type="number" name="aoi"
              value="{{$workplan->aoi}}" placeholder="aoi공수" required>
          </div>

          <div class="field">
            <label>웨이브솔더링 + 컷팅 공수입력</label>
            <input class="input {{ $errors->has('wave') ? 'is-danger' : '' }}" type="number" name="wave"
              value="{{$workplan->wave}}" placeholder="wave공수" required>
          </div>

          <div class="field">
            <label>터치업 + 세척 공수입력</label>
            <input class="input {{ $errors->has('touchup') ? 'is-danger' : '' }}" type="number" name="touchup"
              value="{{$workplan->touchup}}" placeholder="touchup공수" required>
          </div>



        </div>
        <div class="column">

            <div class="field">
                <label>단품검사</label>
                <input class="input {{ $errors->has('item_inspection') ? 'is-danger' : '' }}" type="number"
                  name="item_inspection" value="{{$workplan->item_inspection}}" placeholder="item_inspection공수" required>
              </div>

            <div class="field">
                <label>코팅</label>
                <input class="input {{ $errors->has('coting') ? 'is-danger' : '' }}" type="number" name="coting"
                  value="{{$workplan->coting}}" placeholder="coting공수" required>
              </div>

              <div class="field">
                <label>ASSY</label>
                <input class="input {{ $errors->has('ass') ? 'is-danger' : '' }}" type="number" name="ass"
                  value="{{$workplan->ass}}" placeholder="ass공수" required>
              </div>

              <div class="field">
                <label>포장작업</label>
                <input class="input {{ $errors->has('packing') ? 'is-danger' : '' }}" type="number" name="packing"
                  value="{{$workplan->packing}}" placeholder="packing공수" required>
              </div>

              <div class="field">
                <label>준비작업</label>
                <input class="input {{ $errors->has('ready') ? 'is-danger' : '' }}" type="number" name="ready"
                  value="{{$workplan->ready}}" placeholder="ready공수" required>
              </div>

              <div class="field">
                <label>무작업</label>
                <input class="input {{ $errors->has('ect1') ? 'is-danger' : '' }}" type="number" name="ect1"
                  value="{{$workplan->ect1}}" placeholder="기타공수" required>
              </div>

        </div>
      </div>
      <br>
      <button class="ui  primary  button" type="submit">공수입력</button>
  </form>
  <div class="ui vertical divider">
    and
  </div>
</div>

@endsection
