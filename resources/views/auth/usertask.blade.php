@extends('master')

@section('content')



<h4 class="ui horizontal divider header">
    <i class="address book icon"></i>
    PCB팀 업무분장
</h4>



<div class="ui seven doubling cards">

    <div class="card">
        <div class="image">
            <img src="{{ $user1 }}" alt="">
        </div>
        <div class="content">
            <div class="header">채수단
                <a class="ui blue basic label"><font style="vertical-align: inherit;">팀장</font></a>
            </div>
            <div class="meta">
                <a href="#">팀운영</a>
            </div>

        </div>
        <div class="extra content">
                중점추진성과관리 <br>
                프로젝트별 생산 관리<br>
                부문별 업무 관련 협의<br>
                이슈사항 검토 조치
        </div>
        <div class="extra content">
           근속년수 : 25년
        </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user2 }}" alt="">
        </div>
        <div class="content">
            <div class="header">최원호
                <a class="ui teal basic label"><font style="vertical-align: inherit;">반장</font></a>
            </div>
            <div class="meta">
                <a href="#">공정관리</a>
            </div>

        </div>
        <div class="extra content">
                환경관리(화학물질) <br>
                소모품 및 자재관리<br>
                제조관리 및 문서작성<br>
                출하 및 작업 실적관리
        </div>
        <div class="extra content">
            근속년수 : 12년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user3 }}" alt="">
        </div>
        <div class="content">
            <div class="header">신관식(부장)</div>
            <div class="meta">
                <a href="#">SMD자재관리</a>
            </div>

        </div>
        <div class="extra content">
            PBA ITEM별 도면관리 <br>
            차종별PCB관리<br>
            전자부품 재고 관리<br>
            구매요청 자재 수입검사
        </div>
        <div class="extra content">
            근속년수 : 31년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user4 }}" alt="">
        </div>
        <div class="content">
            <div class="header">이영호(기정)</div>
            <div class="meta">
                <a href="#">선행조립</a>
            </div>

        </div>
        <div class="extra content">
            ASSY 도면 검토 <br>
            ASSY 자재 검사<br>
            디자인 리뷰(DR)<br>
            PBA 출하검사
        </div>
        <div class="extra content">
            근속년수 : 27년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user5 }}" alt="">
        </div>
        <div class="content">
            <div class="header">문혁(기사)</div>
            <div class="meta">
                <a href="">SMT설비운영</a>
            </div>

        </div>
        <div class="extra content">
            설비 프로그램 관리 <br>
            SMD 부품 관리<br>
            SMT 설비 관리<br>
            설비프로파일 작성
        </div>
        <div class="extra content">
            근속년수 : 8년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user6 }}" alt="">
        </div>
        <div class="content">
            <div class="header">고순선(기사)</div>
            <div class="meta">
                <a href="#">DIP인서트</a>
            </div>

        </div>
        <div class="extra content">
            리드 컷팅 <br>
            리드 절곡<br>
            코팅 작업<br>
            볼트 취부 작업
        </div>
        <div class="extra content">
            근속년수 : 17년
         </div>
    </div>

</div>



{{-- 가로줄 --}}
<div class="ui divider"></div>





<div class="ui seven doubling cards">

    <div class="card">
        <div class="image">
            <img src="{{ $user7 }}" alt="">
        </div>
        <div class="content">
            <div class="header">홍성자(기사)</div>
            <div class="meta">
                <a href="#">PBA 터치업1</a>
            </div>

        </div>
        <div class="extra content">
            수 납땜 작업 <br>
            세척기 운영<br>
            설계변경 작업<br>
            정규외 작업 및 A/S
        </div>
        <div class="extra content">
            근속년수 : 7년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user8 }}" alt="">
        </div>
        <div class="content">
            <div class="header">박향순(사원)</div>
            <div class="meta">
                <a href="#">PBA 터치업2</a>
            </div>

        </div>
        <div class="extra content">
            수 납땜 작업 <br>
            세척, 코팅작업<br>
            솔더링 M/C운영<br>
            인서트 보조 작업
        </div>
        <div class="extra content">
            근속년수 : 1년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user9 }}" alt="">
        </div>
        <div class="content">
            <div class="header">박찬숙(기사)</div>
            <div class="meta">
                <a href="#">AOI검사</a>
            </div>

        </div>
        <div class="extra content">
            PBA 완성품 육안 검사 <br>
            AOI 프로그램<br>
            PPM관리, 사진자료화<br>
            설비 보조 작업
        </div>
        <div class="extra content">
            근속년수 : 8년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user10 }}" alt="">
        </div>
        <div class="content">
            <div class="header">최정규(기사)</div>
            <div class="meta">
                <a href="">기능검사</a>
            </div>

        </div>
        <div class="extra content">
            PBA 검사요령서 작성 <br>
            검사 프로그램<br>
            출하 및 추적성 관리<br>
            성적서 관리
        </div>
        <div class="extra content">
            근속년수 : 7년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user11 }}" alt="">
        </div>
        <div class="content">
            <div class="header">김진성(사원)</div>
            <div class="meta">
                <a href="#">UNIT조립</a>
            </div>

        </div>
        <div class="extra content">
            ASSY 자재 입고 관리 <br>
            각차종 UNIT 조립<br>
            제조 영상 관리<br>
            정병류 관리 및 조립
        </div>
        <div class="extra content">
            근속년수 : 1년
         </div>
    </div>

    <div class="card">
        <div class="image">
            <img src="{{ $user12 }}" alt="">
        </div>
        <div class="content">
            <div class="header">석세영(기사)</div>
            <div class="meta">
                <a href="#">UNIT조립</a>
            </div>

        </div>
        <div class="extra content">
            ASSY 자재 입고 관리 <br>
            단품 UNIT 조립<br>
            코팅 작업<br>
            장치별 출하 포장
        </div>
        <div class="extra content">
            근속년수 : 1년
         </div>
    </div>

</div>

<br>
<br>


@endsection
