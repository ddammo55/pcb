<div class="four wide column">

    <form method="post" action="/shipment" name="combo_box">
        @csrf

        <p>시리얼번호_보드명 ({{ $products->count() }})</p>

        <select multiple size="10" name="list1" style="width:100%; height:350px"
            onDblClick="move(document.combo_box.list1,document.combo_box.list2)">


            {{-- 만약 시리얼번호 생성이 있다면 --}}
            @if(isset($serialNameArray)){
               @foreach($serialNameArray as $serialName)
               <option>{{ $serialName.'_'.$board_name }}</option>
               @endforeach
            @else

            @foreach($products as $product )
            <option>{{ $product->serial_name.'_'.$product->board_name.'_'.$product->shipment_daily }}</option>
            @endforeach

            @endif
        </select>

</div>

<div class="middle aligned column eight wide column">

    <div class="ui form">
        <div class="field">
            <div class="ui selection dropdown full">
                <input type="hidden" name="project" class="input {{ $errors->has('project') ? 'is-danger' : '' }}"
                    value="{{ old('project') }}" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">프로젝트 명</div>
                <div class="menu">
                    @foreach ($projects as $project)
                    <div class="item">{{$project->project_name }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <br>


    <?php $dd = date("Y-m-d")?>

    {{--  /////////////////////////////////////////////////////////////////////////////  --}}
    <div class="ui grid">

        <div class="six wide column">
            <div class="ui form">

                {{--  <label>출하일</label>  --}}
                출하일<input type="date" name="shipment_date" value="<?=$dd?>" required>

            </div>
        </div>

        <div class="five wide column">
            <div class="ui form">

                {{--  <label>편성</label>  --}}
                편성<input type="text" name="set_set">

            </div>
        </div>

        <div class="five wide column">
            <div class="ui form">

                {{--  <label>타입</label>  --}}
                타입<input type="text" name="type">

            </div>
        </div>

    </div>

    {{--  /////////////////////////////////////////////////////////////////////////////  --}}


    <div class="ui segment">
        <div class="ui two column very relaxed grid">
            <div class="column">
                <div class="ui form">
                    <div class="field">
                        <label>인수팀</label>
                        <input type="text" name="receiver_team"
                            class="input {{ $errors->has('receiver_team') ? 'is-danger' : '' }}"
                            value="{{ old('receiver_team') }}" required>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui form">
                    <div class="field">
                        <label>인수자</label>
                        <input type="text" name="receiver"
                            class="input {{ $errors->has('receiver') ? 'is-danger' : '' }}"
                            value="{{ old('receiver') }}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui vertical divider">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    과
                </font>
            </font>
        </div>
    </div>



    <div class="ui form">
        <div class="field">
            <label>메모</label>
            <input type="text" name="note">
        </div>
    </div>

    <input type="hidden" name="con" value="1">

    <div class="ui section divider"></div>

    <input class="ui button" type="button" onClick="move(this.form.list2,this.form.list1)" value="<<" id=button1
        name=button1>
    <input class="ui button" type="button" onClick="move(this.form.list1,this.form.list2)" value=">>" id=button2
        name=button2>
    <input class="ui teal button" type="submit" name="submit_button" value="입력"
        onClick="selectAll(document.combo_box.list2);">
    <input class="ui button" type="reset" value="초기화">

</div>

<div class="four wide column">

    <p>출하 시리얼번호</p>

    <select multiple size="10" id="list2" name="skills[]"
        class="input {{ $errors->has('skills[]') ? 'is-danger' : '' }}" value="{{ old('skills[]') }}" required
        style="width:100%; height:350px" onDblClick="move(document.combo_box.list2,document.combo_box.list1)">
    </select>

    </form>

</div>

</div>
