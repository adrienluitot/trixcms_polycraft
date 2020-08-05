@ThemeElement("header")

@include($fetch_all)

@extends("Fetch.fetch")
@include("Fetch.notification")

@if(url()->current() == action('Auth\User\ProfileController@home'))
    @include("Fetch.profile_2fa")
@endif

@ThemeElement("footer")
