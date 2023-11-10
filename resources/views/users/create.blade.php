<h1>Create User</h1>

<h3>Hello {{$name1}} and {{$name2}}</h3>

The current UNIX timestemp is {{ time() }}.

Hello, {!! $name /*this tag for html and css*/ !!}

@if ($name2 == 'saad')
    <h4>this is saad</h4>
@elseif ($name2 == 'salim')
    <h4>this is salim</h4>
@else 
    <h4>No Name</h4>
@endif

<br>
@unless (Auth::check())
    You are not signed in.
@endunless

<br>
@isset ($name /*verify if exist*/) 
    is defined and not null..
@endisset

<br>
@empty($name3 /*verify if empty*/)
    name3 is empty
@endempty


<br>
@auth
    The user is authenticated..
@endauth

@guest
    The user is not authenticated..
@endguest

<br>
@env('staging')
    The application is running in "staging"...
@endenv
@env('staging', 'production')
    The application is running in "staging" or "production"...
@endenv