@extends('layouts.app')
@section('menuTitle')
Tableau de bord
@endsection
@section('contentIndex')

<li class="breadcrumb-item text-muted">
    <a href="/" class="text-muted">
        Acceuil </a>
</li>
<li class="breadcrumb-item text-dark">
    Card Preview </li>
@endsection
@section('content')

<card-view />
@endsection
