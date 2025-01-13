@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="card" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title">Judul Card</h5>
        <p class="card-text">Ini adalah deskripsi singkat tentang isi card ini. Anda dapat menambahkan lebih banyak detail di sini.</p>
        <button id="cardButton" class="btn btn-primary">Klik Saya</button>
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

</script>
@endpush
