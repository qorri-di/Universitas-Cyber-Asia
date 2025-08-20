<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.dashboard')

@section('sidebar')
@include('components.sidebar')
@endsection

@section('content')
@include('components.main',['content' => $content, 'vms' => $vms ?? null, 'chartApi' => $chartApi ?? null, 'chartEdr' => $chartEdr ?? null, 'chartZta' => $chartZta ?? null])
@endsection
