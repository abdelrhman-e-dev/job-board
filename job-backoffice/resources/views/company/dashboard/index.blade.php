@extends('company.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Profile Completion Banner -->
    <x-company.profile-completion-banner :percentage="$missingPercentage" :missing="$missingData" />
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg mb-lg">
        <!-- Total Jobs -->
        <x-company.stat-card label="Total Jobs" :value="$stats['total_jobs']" icon="work" color="primary" />
        <!-- Total Applications -->
        <x-company.stat-card label="Total Applications" :value="$stats['total_applications']" icon="description" color="info" />
        <!-- Active Jobs -->
        <x-company.stat-card label="Active Jobs" :value="$stats['active_jobs']" icon="check_circle" color="success" />
        <!-- New Applications Today -->
        <x-company.stat-card label="New Applications Today" :value="$stats['new_applications_today']" icon="notifications" color="warning" />
    </div>
    <!-- Recent Applications Table Section -->
    <section class="bg-white rounded-xl shadow-md border border-neutral-300 overflow-hidden">
        <x-company.recent-applications :recentApplications="$recentApplications" />
        {{-- @php
            dd($recentApplications);
        @endphp --}}
    </section>
@endsection
