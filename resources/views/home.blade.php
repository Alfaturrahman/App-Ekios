@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Selamat Datang di Home Page</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Ini adalah contoh konten untuk halaman home.</p>
                        <button id="cardButton" class="btn btn-primary">Klik Saya!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cardButton').click(function() {
            alert('Tombol di dalam card berhasil ditekan!');
        });
    });
</script>
@endpush
