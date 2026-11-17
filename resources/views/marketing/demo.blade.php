@extends('layouts.marketing')
@section('title', 'Demo — ForgeCost')
@section('content')
<h1 class="section-title">Demo users</h1>
<p>Password for all seeded accounts: <strong>password</strong></p>
<table>
    <thead><tr><th>Role</th><th>Email</th><th>Access</th></tr></thead>
    <tbody>
        <tr><td>Super Admin</td><td>superadmin@forgecost.test</td><td>/admin</td></tr>
        <tr><td>Admin</td><td>admin@forgecost.test</td><td>/admin</td></tr>
        <tr><td>Manager</td><td>manager@forgecost.test</td><td>/admin</td></tr>
        <tr><td>Staff</td><td>staff@forgecost.test</td><td>/admin</td></tr>
        <tr><td>Demo</td><td>demo@forgecost.test</td><td>/admin</td></tr>
        <tr><td>Client</td><td>client@forgecost.test</td><td>/portal</td></tr>
    </tbody>
</table>
<a class="btn" href="/admin">Go to admin login</a>
@endsection