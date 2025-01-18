@extends('layouts.app')

@section('title', 'Registrasi HP')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Registrasi HP</h1>

        <!-- Tabel Registrasi HP -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>HP Brand</th>
                    <th>HP Type</th>
                    <th>IMEI Number 1</th>
                    <th>Submission Type</th>
                    <th>Submission Time</th>
                    <th>Submission Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data 1 -->
                <tr>
                    <td>1</td>
                    <td>Junnada Hermani(275349)</td>
                    <td>Xiaomi</td>
                    <td>IPHONE</td>
                    <td>IPHONE 13</td>
                    <td>3312675534552</td>
                    <td>Karyawan Baru</td>
                    <td>22 Juni 2024, 17:11</td>
                    <td>Complete</td>
                    <td>
                        <button class="btn btn-success">✅️</button>
                    </td>
                </tr>
                <!-- Data 2 -->
                <tr>
                    <td>2</td>
                    <td>Haiden Niehu(200400)</td>
                    <td>DOT</td>
                    <td>XUQAN</td>
                    <td>REALME 6</td>
                    <td>3312675534557</td>
                    <td>Karyawan Baru</td>
                    <td>25 Juli 2024, 12:16</td>
                    <td>Waiting Approve QNSE Manager</td>
                    <td>
                        <button class="btn btn-success">✅️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
