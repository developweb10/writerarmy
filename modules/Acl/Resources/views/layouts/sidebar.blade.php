<div class="col-md-3 acl-sidebar">
    <h4>Navigate</h4>
    <ul class="list-group">
        <li class="list-group-item">
            <a class=""
                href="{{ url('acl') }}">
                Assign Roles to User
            </a>
        </li>
        {{--<li class="list-group-item">
            <a class=""
                href="{{ route('acl.roles.index') }}">
                View All Roles
            </a>
        </li>
        <li class="list-group-item">
            <a class=""
                href="{{ route('acl.permissions.index') }}">
                View All Permissions
            </a>
        </li>--}}

        <li class="list-group-item">
            <a class=""
               href="{{ route('acl.user.create') }}">
                Create User
            </a>
        </li>

        <li class="list-group-item">
            <a class=""
               href="{{ route('acl.user.list') }}">
                User List
            </a>
        </li>
    </ul>
</div>
