@extends('layouts.app')

@section('content')
<h3>Lapor Hewan Hilang</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
<form action="{{ url('/lapor') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Hewan</label>
        <select name="animal_id" class="form-control" required>
            @foreach($animals as $animal)
                <option value="{{ $animal->id }}">{{ $animal->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Lokasi</label>
        <select name="location_id" class="form-control" required>
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->area_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Gambar Hewan</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-primary">Kirim Laporan</button>
</form>
@endsection


