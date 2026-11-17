@extends('layouts.marketing')
@section('title', 'Client Portal — ForgeCost')
@section('content')
<h1 class="section-title">Project portal</h1>
<p>Welcome, {{ $user->name }}. Review job status and projected margins.</p>
<div class="grid">
@forelse($projects as $project)
    <article class="card">
        <span class="badge">{{ $project->code }}</span>
        <h3>{{ $project->name }}</h3>
        <p>Status: {{ $project->status }} · Margin: {{ number_format((float)$project->projected_margin_pct, 1) }}%</p>
    </article>
@empty
    <article class="card"><p>No projects assigned yet.</p></article>
@endforelse
</div>
@endsection