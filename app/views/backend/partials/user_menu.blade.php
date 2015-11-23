<div class="user_menu">
	<ul>
		<li><a href="{{url('admin/logout');}}" title="Deconnection">Deconnection</a>
			<ul>
				<li><a href="{{ route('admin.user.edit', Auth::id())}}" title="Compte">Compte</a></li>
			</ul>
		</li>

	</ul>
</div>