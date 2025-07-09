@extends('layouts.app')

@section('content')
<h3>Laporan Saya</h3>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>Hewan</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Gambar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->animal->name }}</td>
            <td>{{ $report->location->area_name }}</td>
            <td>{{ $report->status }}</td>
            <td>
                @if($report->image)
                    <img src="{{ asset('storage/'.$report->image) }}" width="80">
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection