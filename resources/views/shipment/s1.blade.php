@extends('master')

@section('content')

<h1 class="ui header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">출하 내역 관리 &nbsp;<i class="circular inverted small comment alternate outline icon" onclick="button_event()"></i></font></font></h1>

<div class="ui segment">
  <div class="ui three column very relaxed grid">

    <div class="four wide column">
 
        <form method="post" action="/shipment" name="combo_box">
          @csrf      
         
            <p>시리얼번호_보드명  ({{ $products->count() }})</p>

                  <select multiple size="10" name="list1" style="width:100%; height:350px" onDblClick="move(document.combo_box.list1,document.combo_box.list2)">
                    <?php foreach($products as $product ){ ?>
                    <option><?=$product->serial_name.'_'.$product->board_name?></option>
                    <?php }?>
                  </select>

        </div>

        <div class="middle aligned column eight wide column"> 
          
        <div class="field">
          <div class="ui selection dropdown">
            <input type="hidden" name="project"  class="input {{ $errors->has('project') ? 'is-danger' : '' }}" value="{{ old('project') }}" required>
            <i class="dropdown icon"></i>
            <div class="default text" style="color: black">프로젝트 명</div>
            <div class="menu">
              @foreach ($projects as $project)
              <div class="item">{{$project->project_name }}</div>
              @endforeach
            </div>
          </div>
        </div>

        <br>
        <?php $dd = date("Y-m-d")?>
        <div class="ui form">
          <div class="field">
            <label>출하일</label>
            <input type="date" name="shipment_date" value="<?=$dd?>" required>
          </div>
        </div>

        <br> 


        <div class="ui segment">
          <div class="ui two column very relaxed grid">
            <div class="column">
             <div class="ui form">
              <div class="field">
                <label>인수팀</label>
                <input type="text"  name="receiver_team" class="input {{ $errors->has('receiver_team') ? 'is-danger' : '' }}" value="{{ old('receiver_team') }}" required>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="ui form">
              <div class="field">
                <label>인수자</label>
                <input type="text" name="receiver"  class="input {{ $errors->has('receiver') ? 'is-danger' : '' }}" value="{{ old('receiver') }}" required>
              </div>
            </div>
          </div>
        </div>
        <div class="ui vertical divider"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
          과
        </font></font></div>
      </div>



        <div class="ui form">
          <div class="field">
            <label>메모</label>
            <input type="text" name="note">
          </div>
        </div>

        <input type="hidden" name="con" value="1">

          <div class="ui section divider"></div>
         
           <input class="ui button" type="button" onClick="move(this.form.list2,this.form.list1)" value="<<" id=button1 name=button1>
           <input class="ui button" type="button" onClick="move(this.form.list1,this.form.list2)" value=">>" id=button2 name=button2>
           <input class="ui teal button" type="submit" name="submit_button" value="입력" onClick="selectAll(document.combo_box.list2);">
           <input class="ui button" type="reset" value="초기화">
  
       </div>

       <div class="four wide column">
       
        <p>출하 시리얼번호</p>

                  <select multiple size="10" id="list2" name="skills[]" class="input {{ $errors->has('skills[]') ? 'is-danger' : '' }}" value="{{ old('skills[]') }}" required style="width:100%; height:350px" onDblClick="move(document.combo_box.list2,document.combo_box.list1)">
                  </select>

          </form>

      </div>

    </div>

  </div>




{{-- 최근입력 시리얼번호 --}}

<div class="ui segment">
  <div class="ui vertically divided grid">
    <div class="three column row" style="background-color:#1B1C1D">
      <div class="two wide column">
        <h4 style="color: white">최근 출하 내역</h4>
      </div>

      <div class="three wide column">

        {{-- 시리얼번호 검색 --}}
        <form method="get" action="/shipment" id="frm2">
          @csrf      
          <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" name="serial_name" placeholder="시리얼 번호">
            <div class="ui teal button" onclick="document.getElementById('frm2').submit();"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">검색</font></font>
            </div>
          </div>
        </form>

      </div>

      <div class="eleven wide column">
        {{-- 페이지네이션 --}}
        @if($products_alls->count())
        <div class="ui right floated pagination menu">
          {{ $products_alls->links() }}
        </div>
        @endif
      </div>

    </div>
  </div>
</div>


      <div class="ui relaxed divided list" style="height: 350px;overflow: auto;">
        <table class="ui selectable celled table" style="margin-top: 0px;">

          <thead>
            <tr>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ID</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">시리얼번호</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">보드명</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">프로젝트명</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">생산일</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">출하일</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">편성</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">불량</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">불량내용</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">타입</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">코팅두께</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">코팅육안검사</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">인계자</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">인수자</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">메모</font></font></th>
              <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">취소</font></font></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products_alls as $products_all)
            @if(substr($products_all->updated_at,0,-3) == date("Y-m-d H:i"))
            <tr style="background-color: #0EC7B9">
              @else
              <tr>
                @endif
              <td>{{$products_all->id}}</td>
              <td><a href="/product/{{ $products_all->id }}/edit">{{$products_all->serial_name}}</a></td>
              <td>{{$products_all->board_name}}</td>
              <td>{{$products_all->shipment_daily}}</td>
              <td>{{$products_all->product_date}}</td>
              <td>{{$products_all->shipment}}</td>
              <td>{{$products_all->set_set}}</td>
              <td>{{$products_all->faulty}}</td>
              <td>{{$products_all->remarks}}</td>
              <td>{{$products_all->type}}</td>
              <td>{{$products_all->coting_t}}</td>
              <td>{{$products_all->coting_inp}}</td>
              <td>{{$products_all->ship_user}}</td>
              <td>{{$products_all->receiver}}</td>
              <td>{{isset($products_all->note) ? mb_substr($products_all->note, 0,10) : ''}}</td>
              <td>
                <form method="post" action="/product/con/{{ $products_all->id }}">
                  @csrf
                  <input type="submit" value="지우기">  
                </form>            
              </td>

            </tr>
            @endforeach



          </tbody>
        </table>
    </div>
  </div>




{{-- 에러표시 --}}
  @if($errors->any())
  <div class="ui pink inverted segment">

    <ul>  
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>  
  @endif

<!-- 출하내역 설명 모달 -->
<div id="modal1" class="ui long test modal scrolling transition hidden">
    <div class="header">
      출하내역 관리 도움말
    </div>
    <div class="image content">

      <div class="description">
        <div class="ui header">설명서</div>
        <pre>
          내용
        </pre>

      </div>
    </div>
    <div class="actions">
      <div class="ui primary approve button">
        닫기
        <i class="x icon icon"></i>
      </div>
    </div>
  </div>


<script type="text/javascript">
 function button_event(){
$('#modal1')
  .modal('show')
;
}
</script>
<!-- 설명 모달 -->






<!-- 셀렉트박스 자바스크립트 -->
<script type="text/javascript">

  function move(fbox, tbox) {
   var arrFbox = new Array();
   var arrTbox = new Array();
   var arrLookup = new Array();
   var i;
   for(i=0; i<tbox.options.length; i++) {
    arrLookup[tbox.options[i].text] = tbox.options[i].value;
    arrTbox[i] = tbox.options[i].text;
  }
  var fLength = 0;
  var tLength = arrTbox.length
  for(i=0; i<fbox.options.length; i++) {
    arrLookup[fbox.options[i].text] = fbox.options[i].value;
    if(fbox.options[i].selected && fbox.options[i].value != "") {
     arrTbox[tLength] = fbox.options[i].text;
     tLength++;
   } else {
     arrFbox[fLength] = fbox.options[i].text;
     fLength++;
   }
 }
 arrFbox.sort();
 arrTbox.sort();
 fbox.length = 0;
 tbox.length = 0;
 var c;
 for(c=0; c<arrFbox.length; c++) {
  var no = new Option();
  no.value = arrLookup[arrFbox[c]];
  no.text = arrFbox[c];
  fbox[c] = no;
}
for(c=0; c<arrTbox.length; c++) {
  var no = new Option();
  no.value = arrLookup[arrTbox[c]];
  no.text = arrTbox[c];
  tbox[c] = no;
}
}

function selectAll(box) {
 for(var i=0; i<box.length; i++) {
  box[i].selected = true;
}
}


</script>

@endsection