@extends('company.layouts.app')
@section('title', 'Jobs')
@section('content')

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-xl gap-md">
        {{-- Breadcrumb --}}
        {{ Breadcrumbs::render('company.jobs') }}
        {{-- export button --}}
    </div>
    <!-- Analysis Cards (Stat Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg mb-xl">
        <!-- Total Jobs -->
        <x-company.jobs.jobs-stat-card label="Total Jobs" :value="$stats['total_jobs']" icon="work" color="primary"
            description="Total Pasted Jobs" />
        <!-- Active Listings -->
        <x-company.jobs.jobs-stat-card label="Active Listings" :value="$stats['active_jobs']" icon="check_circle" color="success"
            description="Currently accepting applicants" />
        <!-- Draft Listings -->
        <x-company.jobs.jobs-stat-card label="Draft Listings" :value="$stats['draft_jobs']" icon="info" color="warning"
            description="Not Published yet" />
        <!-- Closed Listings -->
        <x-company.jobs.jobs-stat-card label="Closed Listings" :value="$stats['closed_jobs']" icon="block" color="danger"
            description="Archived historical data" />
    </div>
    <!-- Main Listing Section -->
    <livewire:company.jobs.jobs-table />

@endsection
