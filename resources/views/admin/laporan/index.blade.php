@extends('layouts.admin')

@section('content')
<h3>Daftar Laporan Hewan Hilang</h3>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Hewan</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->user->name }}</td>
            <td>{{ $report->animal->name }}</td>
            <td>{{ $report->location->area_name }}</td>
            <td>{{ $report->status }}</td>
            <td>
                @if($report->image)
                    <img src="{{ asset('storage/'.$report->image) }}" width="80">
                @endif
            </td>
            <td>
                @if($report->status == 'pending')
                <form action="{{ route('admin.laporan.approve', $report->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection