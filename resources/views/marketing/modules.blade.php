@extends('layouts.marketing')
@section('title', 'Modules — ForgeCost')
@section('content')
<h1 class="section-title">Toggleable business modules</h1>
<p>Run ForgeCost as a full suite or flip modules off for lean specialty crews.</p>
<div class="grid">
@foreach($modules as $key => $module)
    <article class="card">
        <span class="badge">{{ $key }} · {{ ($module['enabled'] ?? false) ? 'enabled' : 'disabled' }}</span>
        <h3>{{ $module['label'] ?? $key }}</h3>
        <p>{{ $module['description'] ?? '' }}</p>
    </article>
@endforeach
</div>
@endsection