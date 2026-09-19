@extends('company.layouts.app')
@section('title', 'Team')
@section('content')

  <div class="flex flex-col md:flex-row md:items-center justify-between mb-lg gap-md">
    {{-- Breadcrumb --}}
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <a href="{{ route('company.dashboard') }}"
            class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
            </svg>
            Home
          </a>
        </li>
        <li>
          <div class="flex items-center space-x-1.5">
            <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m9 5 7 7-7 7" />
            </svg>
            <p class="inline-flex items-center text-sm font-medium text-neutral-500 hover:text-fg-brand">
              Team
            </p>
          </div>
        </li>
      </ol>
    </nav>
    {{-- Invite Member Button --}}
    <livewire:company.team.invite-member-modal />
    <button x-data @click="$dispatch('open-invite-modal')"
      class="flex items-center justify-center gap-sm bg-primary text-on-primary px-[20px] py-[10px] rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all active:scale-95 shadow-md"
      type="button">
      <span class="material-symbols-outlined">person_add</span>
      Invite Member
    </button>
  </div>
  <div>
    {{-- limit banner --}}
    <x-company.team.limit-banner :reachLimit="$reachLimit" :current="$current" />
  </div>
  <!-- Members Table Card -->
  <livewire:company.team.team-list />
  <!-- Bento Info Section -->
@endsection