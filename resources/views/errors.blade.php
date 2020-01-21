    	@if($errors->any())
    	<div class="ui pink inverted segment">

    		<ul>	
    			@foreach ($errors->all() as $error)
    			<li>{{$error}}</li>
    			@endforeach
    		</ul>
    	</div>	

    	@endif