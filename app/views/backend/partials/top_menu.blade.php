<div class="top_menu">
	<ul>
		<li>{{$pictures_count}} photos
        @if($new_pictures !== 0)
            <a class="new" href="#" >{{$new_pictures}}</a>
        @endif
        </li>
		<li>{{$users_count}} utilisateurs
        @if($new_users !== 0)
            <a class="new" href="#" >{{$new_users}}</a>
        @endif
        </li>
		<li>{{$emails_count}} mails
        @if($new_emails !== 0)
            <a class="new" href="#" >{{$new_emails}}</a>
        @endif
        </li>
		<li>{{$bugs_count}} bugs
        @if($new_bugs !== 0)
            <a class="new" href="#" >{{$new_bugs}}</a>
        @endif
        </li>
		<li>{{$sugs_count}} suggestions
        @if($new_sugs !== 0)
            <a class="new" href="#" >{{$new_sugs}}</a>
        @endif
        </li>
        <li><a href="{{url('/explorer')}}" title="">site en ligne</a></li>
		<li><a href="https://www.google.com/analytics/web/?hl=fr&pli=1#report/visitors-overview/a70399180w107677411p112175720/" title="">google analytics</a></li>
	</ul>
</div>
