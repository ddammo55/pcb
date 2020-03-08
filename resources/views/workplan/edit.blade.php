@extends('master')

@section('content')

<div class="ui segment">
    <h2 class="ui left floated header">작업공수입력</h2>
    <div class="ui clearing divider"></div>
    <p>작업지시번호 {{ $workplan->work_no}}</p>
</div>

<div class="ui segment">
    <form class="ui form">

        <table class="ui celled table">


        <div class="field">
          <label>SMD 공수입력</label>
          <input class="input {{ $errors->has('smt') ? 'is-danger' : '' }}" type="number" name="smt" value="{{$workplan->smt}}" placeholder="SMT공수" required>
        </div>

        <div class="field">
          <label>DIP 공수입력</label>
          <input class="input {{ $errors->has('dip') ? 'is-danger' : '' }}" type="number" name="dip" value="{{$workplan->dip}}" placeholder="DIP공수" required>
        </div>

        <div class="field">
          <label>AOI 공수입력</label>
          <input class="input {{ $errors->has('aoi') ? 'is-danger' : '' }}" type="number" name="aoi" value="{{$workplan->aoi}}" placeholder="aoi공수" required>
        </div>

        <div class="field">
          <label>웨이브솔더링 + 컷팅 공수입력</label>
          <input class="input {{ $errors->has('wave') ? 'is-danger' : '' }}" type="number" name="wave" value="{{$workplan->wave}}" placeholder="wave공수" required>
        </div>

        <div class="field">
          <label>터치업 + 세척 공수입력</label>
          <input class="input {{ $errors->has('touchup') ? 'is-danger' : '' }}" type="number" name="touchup" value="{{$workplan->touchup}}" placeholder="touchup공수" required>
        </div>

        <div class="field">
          <label>단품검사</label>
          <input class="input {{ $errors->has('item_inspection') ? 'is-danger' : '' }}" type="number" name="item_inspection" value="{{$workplan->item_inspection}}" placeholder="item_inspection공수" required>
        </div>

        <div class="field">
          <label>코팅</label>
          <input class="input {{ $errors->has('coting') ? 'is-danger' : '' }}" type="number" name="coting" value="{{$workplan->coting}}" placeholder="coting공수" required>
        </div>

        <div class="field">
          <label>ASSY</label>
          <input class="input {{ $errors->has('ass') ? 'is-danger' : '' }}" type="number" name="ass" value="{{$workplan->ass}}" placeholder="ass공수" required>
        </div>

        <div class="field">
          <label>포장작업</label>
          <input class="input {{ $errors->has('packing') ? 'is-danger' : '' }}" type="number" name="packing" value="{{$workplan->packing}}" placeholder="packing공수" required>
        </div>

        <div class="field">
          <label>준비작업</label>
          <input class="input {{ $errors->has('ready') ? 'is-danger' : '' }}" type="number" name="ready" value="{{$workplan->ready}}" placeholder="ready공수" required>
        </div>

        <div class="field">
          <label>기타</label>
          <input class="input {{ $errors->has('ect1') ? 'is-danger' : '' }}" type="number" name="ect1" value="{{$workplan->ect1}}" placeholder="기타공수" required>
        </div>

        </table>

        <button class="ui button" type="submit">Submit</button>
      </form>
</div>

@endsection
