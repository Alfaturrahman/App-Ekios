@extends('layouts.app')

@section('title', 'Registrasi HP')

@section('content')
<div class="container">
    <div style="margin-left:-60px; margin-right: -60px">
        <h1 class="mb-4">Registrasi HP</h1>
        <div class="d-flex justify-content-end align-items-center mb-3">
            <!-- Search -->
            <form class="d-flex me-3" action="/search" method="GET" style="width: 250px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <!-- Add -->
            <button type="button" class="btn" style="background-color: #DCD135; color: black;" data-bs-toggle="modal" data-bs-target="#mmsModal">
                <i class="fas fa-plus" style="color: black;"></i> Daftar MMS
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mmsModal" tabindex="-1" aria-labelledby="mmsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mmsModalLabel">Registrasi Handphone</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="mmsForm">
                            @csrf
                            <div class="mb-3">
                                <label for="employee_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Insert Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="submission_type" class="form-label">HP</label>
                                <select class="form-control" id="submission_type" name="submission_type" required>
                                    <option value="Apple">Apple</option>
                                    <option value="Oppo">Oppo</option>
                                    <option value="Samsung">Samsung</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="hp_name" class="form-label">Type Hp</label>
                                <input type="text" class="form-control" id="hp_name" name="hp_name" placeholder="Insert Type Hp" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">OS</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Android</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Apple</label>
                                      </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="hp_name" class="form-label">IMEI 1</label>
                                <input type="text" class="form-control" id="hp_name" name="hp_name" placeholder="Insert Barcode Label" required>
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">IMEI 2</label>
                                <input type="text" class="form-control" id="department" name="department" placeholder="Insert Barcode Label" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Application Type</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">New Employee</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">New Phone Employee Edition</label>
                                      </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Foto Bagian Depan (JPG/PNG)</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Foto Bagian Belakang (JPG/PNG)</label>
                                <input class="form-control" type="file" id="formFile">
                              </div>
                            <button type="submit" class="btn" style="background-color: #ffffff; color: #DCD135;">Cancel</button>
                            <button type="submit" class="btn" style="background-color: #DCD135; color: black;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel-->
        <div class="table-responsive">
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
                            <a href="/detail/1" class="btn btn-link text-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
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
                            <a href="/detail/1" class="btn btn-link text-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
