@extends('master')

@section('content')

    <h1>글 수정</h1>
<form class="ui form" method="POST" action="/pbas/{{ $pba->id }}" enctype="multipart/form-data">
	 @csrf
	 @method('PATCH')

   @if($pba->division == "PBA")
<!-- 보드명 -->
  <div class="field">
    <div class="ui selection dropdown">
       <input class="input {{ $errors->has('board_name') ? 'is-danger' : '' }}" type="hidden" name="board_name" value="{{$pba->board_name}}" required>
      <i class="dropdown icon"></i>
       
      <div class="default text" style="color: black">{{$pba->board_name}}</div>

      <div class="menu">
        @foreach ($pcb_lists as $pcb_list)
        <div class="item">{{$pcb_list->boardname}}</div>
        @endforeach
      </div>
    </div>
  </div>
<!-- 보드명 -->
@else

<!-- assy명 -->
  <div class="field">
   
       <input class="input {{ $errors->has('assy_name') ? 'is-danger' : '' }}" type="text" name="assy_name" value="{{$pba->assy_name}}" required>
 
      {{-- <div class="default text" style="color: black">{{$pba->assy_name}}</div> --}}

   
  </div>
<!-- assy명 -->
@endif

<!-- 프로젝트명 -->
  <div class="field">
    <div class="ui selection dropdown">
      <input class="input {{ $errors->has('project_name') ? 'is-danger' : '' }}" type="hidden" name="project_name" value="{{$pba->project_name}}" required>
      <i class="dropdown icon"></i>
       
      <div class="default text" style="color: black">{{$pba->project_name}}</div>

      <div class="menu">
        @foreach ($project_lists as $project_list)
        <div class="item">{{$project_list->project_name}}</div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- 프로젝트명 -->


<textarea  name="content" class="form-control my-editor" style="height: 350px;">{{ $pba->content }}</textarea>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

<div class="ui divider"></div>
	<div class="field">
		<button class="ui teal button" type="submit">제조영상 수정</button>
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

@endsection