@extends('layouts.marketing')

@section('title', 'ForgeCost — Contractor Job Costing SaaS')
@section('meta_description', 'Contractor job costing SaaS for labor, materials, change orders, profit tracking, and real-time project margins built for construction teams.')

@section('content')
<section class="hero">
    <div class="badge">Construction job costing</div>
    <h1>ForgeCost</h1>
    <p>Real-time labor, materials, change orders, and project margins — so construction teams protect profit before the job closes.</p>
    <div class="cta">
        <a class="btn" href="/admin">Open Admin</a>
        <a class="btn ghost" href="{{ route('demo') }}">Try demo users</a>
    </div>
</section>
<section class="grid">
    @foreach($modules as $key => $module)
        <article class="card">
            <span class="badge">{{ ($module['enabled'] ?? false) ? 'On' : 'Off' }}</span>
            <h3>{{ $module['label'] ?? $key }}</h3>
            <p>{{ $module['description'] ?? '' }}</p>
        </article>
    @endforeach
</section>
@endsection