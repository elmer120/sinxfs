<ul class="uk-breadcrumb uk-margin-remove-bottom uk-margin-small-top uk-margin-medium-left">
    <li class=""><a href='{{ route("dashboard") }}'>Home</a></li>
    <li><span>{{ request()->route()->getName() }}</span></li>
</ul>