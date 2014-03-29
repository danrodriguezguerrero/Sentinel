@extends(Config::get('Sentinel::config.layout'))

{{-- Web site Title --}}
@section('title')
@parent
Groups
@stop

{{-- Content --}}
@section('content')
<h4>Available Groups</h4>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>Name</th>
				<th>Slug</th>
				<th>Permissions</th>
				<th>Options</th>
			</thead>
			<tbody>
			@foreach ($groups as $group)
				<tr>
					<td>
						<a href="groups/{{ $group->id }}">{{ $group->name }}</a>
					</td>
					<td>
						{{ $group->slug }}
					</td>
					<td>	
						<?php $permissions = array_keys($group->getPermissions()->getPermissions()); ?>
						{{ implode(', ', array_map("ucfirst", $permissions)); }}
					</td>
					<td>
						<button class="btn btn-default" onClick="location.href='{{ action('Sentinel\GroupController@edit', array($group->id)) }}'">Edit</button>
					 	<button class="btn btn-default action_confirm {{ ($group->name == 'Admins') ? 'disabled' : '' }}" type="button" data-token="{{ Session::getToken() }}" data-method="delete" href="{{ URL::action('Sentinel\GroupController@destroy', array($group->id)) }}">Delete</button>
					 </td>
				</tr>	
			@endforeach
			</tbody>
		</table> 
	</div>
	 <button class="btn btn-primary" onClick="location.href='{{ URL::action('Sentinel\GroupController@create') }}'">New Group</button>
   </div>
</div>
<!--  
	The delete button uses Resftulizer.js to restfully submit with "Delete".  The "action_confirm" class triggers an optional confirm dialog.
	Also, I have hardcoded adding the "disabled" class to the Admin group - deleting your own admin access causes problems.
-->
@stop

