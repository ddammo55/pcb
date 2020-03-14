@extends('master')

@section('content')

<div class="ui segment">
    <div class="ui two column very relaxed grid">
        <div class="five wide column">
            <h1>프로젝트명 작성 ({{ $projects_count }}종)</h1>
            <form class="ui form" method="POST" action="/projects">
                @csrf
                <div class="field">
                    <input class="input {{ $errors->has('project_name') ? 'is-danger' : '' }}" type="text"
                        name="project_name" value="{{ old('project_name') }}" placeholder="프로젝트 명" required>
                </div>

                <div class="field">
                    <input class="input {{ $errors->has('project_code') ? 'is-danger' : '' }}" type="text"
                        name="project_code" value="{{ old('project_code') }}" placeholder="프로젝트 코드" required>
                </div>

                <div class="field">
                    <input class="input {{ $errors->has('car') ? 'is-danger' : '' }}" type="number" name="car"
                        value="{{ old('car') }}" placeholder="량" required>
                </div>

                <div class="field">
                    <input class="input {{ $errors->has('kinds') ? 'is-danger' : '' }}" type="text" name="kinds"
                        value="{{ old('kinds') }}" placeholder="종류" required>
                </div>

                <div class="field">
                    <input class="input {{ $errors->has('note') ? 'is-danger' : '' }}" type="text" name="note"
                        value="{{ old('note') }}" placeholder="메모">
                </div>



                <div class="field">
                    <button class="ui button" type="submit">프로젝트명 작성</button>
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
        <div class="eleven wide column">
            <table class="ui celled table">

                <thead>
                    <tr>
                        <th>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">ID</font>
                            </font>
                        </th>
                        <th>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">프로젝트 명</font>
                            </font>
                        </th>
                        <th>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">프로젝트 코드</font>
                            </font>
                        </th>
                        <th>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">량</font>
                            </font>
                        </th>
                        <th>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">종류</font>
                            </font>
                        </th>
                        <th>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">메모</font>
                            </font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{!! $project->id!!}</td>
                        <td><a href="/projects/{{ $project->id }}/edit">{{$project->project_name}}</a></td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{!! $project->project_code!!}</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{!! $project->car!!}</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{!! $project->kinds!!}</font>
                            </font>
                        </td>
                        <td>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{!! $project->note!!}</font>
                            </font>
                        </td>
                    </tr>
                    @endforeach



                </tbody>
            </table>


            {{-- 하단 --}}

            <div class="ui grid">
                <div class="row">
                    <div class="six wide column">

                        <div class="item">
                            <form method="get" action="/projects/" id="frm2">
                                @csrf
                                <div class="ui action left icon input">
                                    <i class="search icon"></i>
                                    <input type="text" name="project_name_search" placeholder="프로젝트명 검색">
                                    <div class="ui teal button" onclick="document.getElementById('frm2').submit();">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">검색</font>
                                        </font>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="ten wide column">
                        <div class="right column">

                            {{-- 페이지네이션 --}}
                            @if($projects->count())
                            {{ $projects->links() }}
                            @endif
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

</div>




@endsection
