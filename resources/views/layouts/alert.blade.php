@if(Session::has('error'))
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ Session::get('error') }}</strong>
	</div>
	</div>
</div>
@endif