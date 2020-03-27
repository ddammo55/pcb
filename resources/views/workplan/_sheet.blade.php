
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


<div class="ui segment">
    <a class="ui blue ribbon label">SMT</a>
<h5 style="color:black">1.SMT:초물(8~12시)/중물(12시~17시)/종물(17~21시)</h5>

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
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td></td>
      </tr>
      <tr>
        <td class="center aligned">실장공정</td>
        <td class="center aligned">부품실장상태</td>
        <td class="center aligned">미삽,틀어짐,뒤짚힘,밀림,날림,방향</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td></td>
      </tr>
      <tr>
        <td class="center aligned">리플로워</td>
        <td class="center aligned">납땜상태</td>
        <td class="center aligned">젖음성,쇼트,납볼,날림</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td></td>
      </tr>
    </tbody>
  </table>

</div>



<div class="ui segment">
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
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">인서트상태</td>
        <td class="center aligned">미삽,역삽(유극성소자),오삽</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">부품 리드길이</td>
        <td class="center aligned">리드길이 3~5mm</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">콘넥터, Jack류</td>
        <td class="center aligned">들뜸</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">웨이브솔더링</td>
        <td class="center aligned">납땜상태</td>
        <td class="center aligned">과납,미납,쇼트,젖음성</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
    </tbody>
  </table>

</div>


<div class="ui segment">
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
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">PCB 상태 검사</td>
        <td class="center aligned">미삽,역삽(유극성소자),오삽</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">수작업</td>
        <td class="center aligned">수작업 내용</td>
        <td class="center aligned">위치,규격</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">기능, 육안검사</td>
        <td class="center aligned">특성, 납땜상태</td>
        <td class="center aligned">동작상태, 과납,미납,쇼트,젖음성</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
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
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">코팅상태</td>
        <td class="center aligned">콘넥터,Jack류,점퍼캡(코팅불가),점도</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">실리콘 상태</td>
        <td class="center aligned">외경높이(10mm*15mm)이상, 코팅뿔(5mm이내)</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
      <tr>
        <td class="center aligned">체크 마킹</td>
        <td class="center aligned">DIODE,CAPACITOR</td>
        <td class="center aligned">D,K측(띠)C:(+)측 적색마킹, Ser.No</td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
        <td class="center aligned"> <i class="large green checkmark icon"></i></td>
      </tr>
    </tbody>
  </table>

</div>




