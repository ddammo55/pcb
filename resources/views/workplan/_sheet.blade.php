
<div class="ui segment">



 <form class="ui form" method="POST" action="/workplanSheetUpdate/{{ $workplan->id }}">
    @csrf
    @method('PATCH')

<table class="ui celled table">
    <thead>
        <tr>
            <th class="center aligned">차종</th>
            <th class="center aligned">{{$workplan->project_name }}</th>
            <th class="center aligned">PCB명</th>
            <th class="center aligned">{{$workplan->board_name }}</th>
            <th class="center aligned">수량</th>
            <th class="center aligned">{{ $workplan->ea }}</th>
        </tr>
    </thead>
</table>

<div class="ui teal message">
    <div class="header">
      전달사항
    </div>
    <p>{{ $workplan->memo }}</p>
</div>



<div class="ui grid">

    <div class="eight wide column">
        {{-- smt --}}
        <div class="ui segment" style="border-color:gray; border-width:2px">
            <a class="ui blue ribbon label">SMT</a>
        <h5 style="color:black">1.SMT:초물(8~12시)/중물(12시~17시)/종물(17~21시)</h5>

        <table class="ui celled table" >
            <thead>
              <tr class="positive">
                <td class="center aligned">작업시작일</td>
                <td class="center aligned">{{$workplan->start_product_date }}</td>
                <td class="center aligned">작업종료일</td>
                <td class="center aligned">{{$workplan->end_product_date }}</td>
                <td class="center aligned">공수</td>
                <td class="center aligned">{{$worktasksSum}}</td>
              </tr>
            </thead>
          </table>

          <h5 style="color:black">*CTQ 체크포인트</h5>

          <table class="ui celled table">
              <tr>
                <td class="center aligned"><b>공정부문</b></td>
                <td class="center aligned"><b>체크항목</b></td>
                <td class="center aligned"><b>체크포인트</b></td>
                <td class="center aligned"><b>초물</b></td>
                <td class="center aligned"><b>중물</b></td>
                <td class="center aligned"><b>종물</b></td>
              </tr>
              <tr>
                <td class="center aligned">인쇄공정</td>
                <td class="center aligned">프린터상태</td>
                <td class="center aligned">과납,미납,소납,치우침</td>
                <td class="center aligned"> <input type="radio" name="s1" value="1" {{ ($workplan->s1 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s1" value="0" {{ ($workplan->s1 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="s2" value="1" {{ ($workplan->s2 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s2" value="0" {{ ($workplan->s2 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="s3" value="1" {{ ($workplan->s3 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s3" value="0" {{ ($workplan->s3 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
              <tr>
                <td class="center aligned">실장공정</td>
                <td class="center aligned">부품실장상태</td>
                <td class="center aligned">미삽,틀어짐,뒤짚힘,밀림,날림,방향</td>
                <td class="center aligned"><input type="radio" name="s4" value="1" {{ ($workplan->s4 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s4" value="0" {{ ($workplan->s4 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"><input type="radio" name="s5" value="1" {{ ($workplan->s5 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s5" value="0" {{ ($workplan->s5 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"><input type="radio" name="s6" value="1" {{ ($workplan->s6 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s6" value="0" {{ ($workplan->s6 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
              <tr>
                <td class="center aligned">리플로워</td>
                <td class="center aligned">납땜상태</td>
                <td class="center aligned">젖음성,쇼트,납볼,날림</td>
                <td class="center aligned"> <input type="radio" name="s7" value="1" {{ ($workplan->s7 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s7" value="0" {{ ($workplan->s7 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="s8" value="1" {{ ($workplan->s8 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s8" value="0" {{ ($workplan->s8 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="s9" value="1" {{ ($workplan->s9 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="s9" value="0" {{ ($workplan->s9 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
            </tbody>
          </table>

          <br>
          <br>

        </div>

    </div>

    <div class="eight wide column">
        {{-- dip --}}
        <div class="ui segment" style="border-color:gray; border-width:2px;">
            <a class="ui orange ribbon label">DIP</a>
        <h5 style="color:black">2.DIP:초물(8~12시)/중물(12시~17시)/종물(17~21시)</h5>

        <table class="ui celled table">
            <thead>
              <tr  class="positive">
                <td class="center aligned">작업시작일</td>
                <td class="center aligned">{{$workplan->start_product_date }}</td>
                <td class="center aligned">작업종료일</td>
                <td class="center aligned">{{$workplan->end_product_date }}</td>
                <td class="center aligned">공수</td>
                <td class="center aligned">{{$worktasksSum}}</td>
              </tr>
            </thead>
          </table>

          <h5 style="color:black">*CTQ 체크포인트</h5>

          <table class="ui celled structured table">
            <tr>
                <th class="center aligned">공정부문</th>
                <th class="center aligned">체크항목</th>
                <th class="center aligned">체크포인트</th>
                <th class="center aligned">초물</th>
                <th class="center aligned">중물</th>
                <th class="center aligned">종물</th>
              </tr>
              <tr>
                <td class="center aligned" rowspan="4">인서트공정</td>
                <td class="center aligned">부품상태</td>
                <td class="center aligned">변형,절곡부분</td>
                <td class="center aligned"> <input type="radio" name="d1" value="1" {{ ($workplan->d1 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d1" value="0" {{ ($workplan->d1 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d2" value="1" {{ ($workplan->d2 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d2" value="0" {{ ($workplan->d2 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d3" value="1" {{ ($workplan->d3 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d3" value="0" {{ ($workplan->d3 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
              <tr>
                <td class="center aligned">인서트상태</td>
                <td class="center aligned">미삽,역삽(유극성소자),오삽</td>
                <td class="center aligned"> <input type="radio" name="d4" value="1" {{ ($workplan->d4 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d4" value="0" {{ ($workplan->d4 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d5" value="1" {{ ($workplan->d5 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d5" value="0" {{ ($workplan->d5 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d6" value="1" {{ ($workplan->d6 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d6" value="0" {{ ($workplan->d6 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
              <tr>
                <td class="center aligned">부품 리드길이</td>
                <td class="center aligned">리드길이 3~5mm</td>
                <td class="center aligned"> <input type="radio" name="d7" value="1" {{ ($workplan->d7 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d7" value="0" {{ ($workplan->d7 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d8" value="1" {{ ($workplan->d8 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d8" value="0" {{ ($workplan->d8 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d9" value="1" {{ ($workplan->d9 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d9" value="0" {{ ($workplan->d9 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
              <tr>
                <td class="center aligned">콘넥터, Jack류</td>
                <td class="center aligned">들뜸</td>
                <td class="center aligned"> <input type="radio" name="d10" value="1" {{ ($workplan->d10 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d10" value="0" {{ ($workplan->d10 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d11" value="1" {{ ($workplan->d11 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d11" value="0" {{ ($workplan->d11 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d12" value="1" {{ ($workplan->d12 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d12" value="0" {{ ($workplan->d12 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
              <tr>
                <td class="center aligned">웨이브솔더링</td>
                <td class="center aligned">납땜상태</td>
                <td class="center aligned">과납,미납,쇼트,젖음성</td>
                <td class="center aligned"> <input type="radio" name="d13" value="1" {{ ($workplan->d13 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d13" value="0" {{ ($workplan->d13 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d14" value="1" {{ ($workplan->d14 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d14" value="0" {{ ($workplan->d14 == 0 ? ' checked' : '') }}>&nbsp;X</td>
                <td class="center aligned"> <input type="radio" name="d15" value="1" {{ ($workplan->d15 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="d15" value="0" {{ ($workplan->d15 == 0 ? ' checked' : '') }}>&nbsp;X</td>
              </tr>
            </tbody>
          </table>

        </div>
    </div>

</div>









<div class="ui segment" style="border-color:gray; border-width:2px;">
    <a class="ui teal ribbon label">터치업 세척코팅</a>
<h5 style="color:black">3.터치업 세척코팅:초물(8~12시)/중물(12시~17시)/종물(17~21시)</h5>

<table class="ui celled table">
    <thead>
      <tr class="positive">
        <td class="center aligned">작업시작일</td>
        <td class="center aligned">{{$workplan->start_product_date }}</td>
        <td class="center aligned">작업종료일</td>
        <td class="center aligned">{{$workplan->end_product_date }}</td>
        <td class="center aligned">공수</td>
        <td class="center aligned">{{$worktasksSum}}</td>
      </tr>
    </thead>
  </table>

<h5 style="color:black">*CTQ 체크포인트(특성검사 시에는 검사일지에 기록관리한다.)</h5>

  <table class="ui celled structured table">
    <tr>
        <th class="center aligned">공정부문</th>
        <th class="center aligned">체크항목</th>
        <th class="center aligned">체크포인트</th>
        <th class="center aligned">초물</th>
        <th class="center aligned">중물</th>
        <th class="center aligned">종물</th>
      </tr>
      <tr>
        <td class="center aligned" rowspan="2">터치업 작업</td>
        <td class="center aligned">부품상태 교정</td>
        <td class="center aligned">변형,절곡부분,리드길이(0.6~1.8mm)</td>
        <td class="center aligned"> <input type="radio" name="t1" value="1" {{ ($workplan->t1 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t1" value="0" {{ ($workplan->t1 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t2" value="1" {{ ($workplan->t2 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t2" value="0" {{ ($workplan->t2 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t3" value="1" {{ ($workplan->t3 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t3" value="0" {{ ($workplan->t3 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
      <tr>
        <td class="center aligned">PCB 상태 검사</td>
        <td class="center aligned">미삽,역삽(유극성소자),오삽</td>
        <td class="center aligned"> <input type="radio" name="t4" value="1" {{ ($workplan->t4 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t4" value="0" {{ ($workplan->t4 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t5" value="1" {{ ($workplan->t5 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t5" value="0" {{ ($workplan->t5 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t6" value="1" {{ ($workplan->t6 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t6" value="0" {{ ($workplan->t6 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
      <tr>
        <td class="center aligned">수작업</td>
        <td class="center aligned">수작업 내용</td>
        <td class="center aligned">위치,규격</td>
        <td class="center aligned"> <input type="radio" name="t7" value="1" {{ ($workplan->t7 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t7" value="0" {{ ($workplan->t7 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t8" value="1" {{ ($workplan->t8 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t8" value="0" {{ ($workplan->t8 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t9" value="1" {{ ($workplan->t9 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t9" value="0" {{ ($workplan->t9 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
      <tr>
        <td class="center aligned">기능, 육안검사</td>
        <td class="center aligned">특성, 납땜상태</td>
        <td class="center aligned">동작상태, 과납,미납,쇼트,젖음성</td>
        <td class="center aligned"> <input type="radio" name="t10" value="1" {{ ($workplan->t10 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t10" value="0" {{ ($workplan->t10 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t11" value="1" {{ ($workplan->t11 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t11" value="0" {{ ($workplan->t11 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t12" value="1" {{ ($workplan->t12 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t12" value="0" {{ ($workplan->t12 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
    </tbody>
  </table>


  <h5 style="color:black">*CTQ 체크포인트</h5>

  <table class="ui celled structured table">
    <tr>
        <th class="center aligned">공정부문</th>
        <th class="center aligned">체크항목</th>
        <th class="center aligned">체크포인트</th>
        <th class="center aligned">초물</th>
        <th class="center aligned">중물</th>
        <th class="center aligned">종물</th>
      </tr>
      <tr>
        <td class="center aligned" rowspan="3">터치업 작업</td>
        <td class="center aligned">세척상태</td>
        <td class="center aligned">변형, 이물질(깨끗할것)</td>
        <td class="center aligned"> <input type="radio" name="t13" value="1" {{ ($workplan->t13 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t13" value="0" {{ ($workplan->t13 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t14" value="1" {{ ($workplan->t14 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t14" value="0" {{ ($workplan->t14 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t15" value="1" {{ ($workplan->t15 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t15" value="0" {{ ($workplan->t15 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
      <tr>
        <td class="center aligned">코팅상태</td>
        <td class="center aligned">콘넥터,Jack류,점퍼캡(코팅불가),점도</td>
        <td class="center aligned"> <input type="radio" name="t16" value="1" {{ ($workplan->t16 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t16" value="0" {{ ($workplan->t16 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t17" value="1" {{ ($workplan->t17 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t17" value="0" {{ ($workplan->t17 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t18" value="1" {{ ($workplan->t18 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t18" value="0" {{ ($workplan->t18 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
      <tr>
        <td class="center aligned">실리콘 상태</td>
        <td class="center aligned">외경높이(10mm*15mm)이상, 코팅뿔(5mm이내)</td>
        <td class="center aligned"> <input type="radio" name="t19" value="1" {{ ($workplan->t19 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t19" value="0" {{ ($workplan->t19 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t20" value="1" {{ ($workplan->t20 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t20" value="0" {{ ($workplan->t20 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t21" value="1" {{ ($workplan->t21 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t21" value="0" {{ ($workplan->t21 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
      <tr>
        <td class="center aligned">체크 마킹</td>
        <td class="center aligned">DIODE,CAPACITOR</td>
        <td class="center aligned">D,K측(띠)C:(+)측 적색마킹, Ser.No</td>
        <td class="center aligned"> <input type="radio" name="t22" value="1" {{ ($workplan->t22 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t22" value="0" {{ ($workplan->t22 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t23" value="1" {{ ($workplan->t23 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t23" value="0" {{ ($workplan->t23 == 0 ? ' checked' : '') }}>&nbsp;X</td>
        <td class="center aligned"> <input type="radio" name="t24" value="1" {{ ($workplan->t24 == 1 ? ' checked' : '') }} >&nbsp;O <input type="radio" name="t24" value="0" {{ ($workplan->t24 == 0 ? ' checked' : '') }}>&nbsp;X</td>
      </tr>
    </tbody>
  </table>

</div>
    <button class="fluid ui positive button">제출하기</button>
{{-- <input type="submit" value="제출" > --}}
 </form>

</div>




