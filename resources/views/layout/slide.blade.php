
<div class="row carousel-holder">
	<div class="col-md-12">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				@foreach($slide as $key =>$value)
					<li data-target="#carousel-example-generic" data-slide-to="{{$key}}"
							{{$key ==0 ? "class=active" : ""}}
					>
					</li>
				@endforeach
			</ol>
			<div class="carousel-inner">
				@foreach($slide as $key =>$value)
					<div class="item {{$key ==0 ? "active" : ""}}">
						<img class="slide-image" src="image/800x300.png" alt="">
					</div>
				@endforeach
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
</div>


