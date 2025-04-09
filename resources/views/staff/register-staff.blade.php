@extends('layouts.app')

@section('title', 'Registrasi HP')

@section('content')
<div class="container">
    <div style="margin-left:-60px; margin-right: -60px">
        <h1 class="mb-4">Registrasi HP</h1>
        <div class="d-flex justify-content-end align-items-center mb-3">
            <div id="customSearchWrapper" class="me-3" style="width: 250px;"></div>
            <button type="button" class="btn" style="background-color: #DCD135; color: black;" data-bs-toggle="modal" data-bs-target="#mmsModal">
                <i class="fas fa-plus"></i> Daftar MMS
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mmsModal" tabindex="-1" aria-labelledby="mmsModalLabel" aria-hidden="true" data-bs-backdrop="false">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="mmsModalLabel">Register Handphone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="mmsForm">
                    @csrf
                    <div class="mb-3">
                    <label for="employee_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Insert Name" required>
                    </div>
        
                    <!-- HP Merk dan Tipe -->
                    <div class="row g-2 mb-3">
                    <div class="col-md-6">
                        <label for="submission_type" class="form-label">HP</label>
                        <select class="form-select" id="submission_type" name="submission_type" required>
                        <option selected disabled>Apple</option>
                        <option value="Apple">Apple</option>
                        <option value="Oppo">Oppo</option>
                        <option value="Samsung">Samsung</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="hp_name" class="form-label">&nbsp;</label>
                        <input type="text" class="form-control" id="hp_name" name="hp_name" placeholder="Iphone 13 PRO" required>
                    </div>
                    </div>
        
                    <!-- OS -->
                    <div class="mb-3">
                    <label class="form-label">OS : </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="os" id="osAndroid" value="Android" required>
                        <label class="form-check-label" for="osAndroid">Android</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="os" id="osApple" value="Apple" required>
                        <label class="form-check-label" for="osApple">Apple</label>
                    </div>
                    </div>
        
                    <!-- IMEI -->
                    <div class="mb-3">
                    <label for="imei1" class="form-label">IMEI 1</label>
                    <input type="text" class="form-control" id="imei1" name="imei1" placeholder="Insert Barcode Label" required>
                    </div>
                    <div class="mb-3">
                    <label for="imei2" class="form-label">IMEI 2</label>
                    <input type="text" class="form-control" id="imei2" name="imei2" placeholder="Insert Barcode Label" required>
                    </div>
        
                    <!-- Application Type -->
                    <div class="mb-3">
                    <label class="form-label">Select Application Type</label>
                        <div class="column">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="app_type" id="newEmployee" value="New Employee" required>
                                <label class="form-check-label" for="newEmployee">New Employee</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="app_type" id="newPhone" value="New Mobile Phone Addition" required>
                                <label class="form-check-label" for="newPhone">New Mobile Phone Addition</label>
                            </div>
                        </div>
                    </div>
        
                    <!-- Submission Reason -->
                    <div class="mb-3">
                    <label class="form-label">Submission Reason</label>
                        <div class="column">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="submission_reason" id="uploadFoto" value="Upload Foto" required>
                                <label class="form-check-label" for="uploadFoto">Upload Foto</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="submission_reason" id="takePhoto" value="Take Photo" required>
                                <label class="form-check-label" for="takePhoto">Take Photo</label>
                            </div>
                        </div>
                    </div>
        
                    <!-- Upload -->
                    <div class="mb-3">
                    <label for="foto_depan" class="form-label">Upload foto bagian depan (JPG/PNG)</label>
                    <input class="form-control" type="file" id="foto_depan" name="foto_depan" accept=".jpg,.jpeg,.png" required>
                    </div>
                    <div class="mb-3">
                    <label for="foto_belakang" class="form-label">Upload foto bagian belakang (JPG/PNG)</label>
                    <input class="form-control" type="file" id="foto_belakang" name="foto_belakang" accept=".jpg,.jpeg,.png" required>
                    </div>
        
                    <!-- Action -->
                    <div class="mt-4 d-flex justify-content-end gap-3">
                    <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning text-dark fw-semibold">Submit</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card card-table-wrapper mb-4 shadow-sm">
            <div class="card-body" style="padding: 0px;">
                <div class="table-responsive pt-2">
                    <table id="hpTable" class="table table-bordered table-hover table-sm text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Employee</th>
                                <th>Departemen</th>
                                <th>HP Brand</th>
                                <th>HP Type</th>
                                <th>IMEI 1</th>
                                <th>Tipe Pengajuan</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- contoh data -->
                            <tr>
                                <td class="text-center">1</td>
                                <td>Junanda Herman (375345)</td>
                                <td>Xiaomi</td>
                                <td>IPHONE</td>
                                <td>IPHONE 13</td>
                                <td>3312678534552</td>
                                <td>Karyawan Baru</td>
                                <td>22 Juni 2024, 17.11</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="offcanvas" data-bs-target="#detailOffcanvas">
                                        <i class="fas fa-eye text-dark"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Slebew (375345)</td>
                                <td>Xiaomi</td>
                                <td>IPHONE</td>
                                <td>IPHONE 13</td>
                                <td>3312678534552</td>
                                <td>Karyawan Baru</td>
                                <td>22 Juni 2024, 17.11</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="offcanvas" data-bs-target="#detailOffcanvas">
                                        <i class="fas fa-eye text-dark"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Offcanvas Detail -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="detailOffcanvas" aria-labelledby="detailOffcanvasLabel" style="width: 70vh;" data-bs-backdrop="false">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="detailOffcanvasLabel">Detail Registrasi HP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <!-- Judul -->
                <h4 class="mb-2">OPPO - OPPO A37</h4>

                <span style="margin-bottom: 5px"> by Febby Fakhrian (221345), Monday, 8 Oktober 2024, 17:00 </span>

                <!-- Badges -->
                <div class="mb-3">
                    <span class="badge bg-light text-dark me-2">Penambahan HP Baru</span>
                    <span class="badge bg-success">Completed</span>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3" id="detailTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#infoTabCanvas">Information</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#historyTabCanvas">History Status</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Tab Info -->
                    <div class="tab-pane fade show active" id="infoTabCanvas">
                        <!-- Accordion -->
                        <div class="accordion mb-4" id="accordionInfoCanvas">
                            <div class="accordion-item border">
                                <h2 class="accordion-header" id="headingOneCanvas">
                                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneCanvas" aria-expanded="false" aria-controls="collapseOneCanvas">
                                        Employee Information
                                    </button>
                                </h2>
                                <div id="collapseOneCanvas" class="accordion-collapse collapse" aria-labelledby="headingOneCanvas" data-bs-parent="#accordionInfoCanvas">
                                    <div class="accordion-body">
                                        <div class="row mb-2"><div class="col-md-4"><strong>Employee Name</strong></div><div class="col-md-8">Jassy (200457)</div></div>
                                        <div class="row mb-2"><div class="col-md-4"><strong>Department</strong></div><div class="col-md-8">DIGI</div></div>
                                        <div class="row mb-2"><div class="col-md-4"><strong>Email</strong></div><div class="col-md-8">jassy@example.com</div></div>
                                        <div class="row mb-2"><div class="col-md-4"><strong>Phone Number</strong></div><div class="col-md-8">+62 812 3456 7890</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Device Info -->
                        <h6 class="fw-bold mb-3">Device Information</h6>
                        <p><strong>HP:</strong> OPPO</p>
                        <p><strong>Barcode Label:</strong> -</p>
                        <p><strong>IMEI 1:</strong> 92823132191</p>
                        <p><strong>IMEI 2:</strong> 92823132320</p>
                        <p><strong>Application Type:</strong> New Employee</p>
                        <p><strong>Submission Time:</strong> 8 Oktober 2024, 17.00</p>
                        <p><strong>Status:</strong> Waiting Approve QHSE</p>

                        <!-- Images -->
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="https://via.placeholder.com/200x300?text=Back+Phone" class="img-fluid rounded mb-2" style="max-height: 200px;">
                                <p>Photo of the back of the phone</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="https://via.placeholder.com/200x300?text=Front+Phone" class="img-fluid rounded mb-2" style="max-height: 200px;">
                                <p>Photo of the front of the phone</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-danger me-3" id="btnReject">Reject</button>
                            <button class="btn btn-success">Approve</button>
                        </div>
                    </div>

                    <!-- Tab History -->
                    <div class="tab-pane fade" id="historyTabCanvas">
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="mb-5"><div class="fw-semibold">Thursday</div><div class="text-muted small">4 Oktober 2024 09.47</div></div>
                                <div class="mb-5"><div class="fw-semibold">Wednesday</div><div class="text-muted small">3 Oktober 2024 17.46</div></div>
                                <div class="mb-5"><div class="fw-semibold">Tuesday</div><div class="text-muted small">1 Oktober 2024 19.00</div></div>
                                <div class="mb-5"><div class="fw-semibold">Tuesday</div><div class="text-muted small">2 Oktober 2024 17.16</div></div>
                                <div><div class="fw-semibold">Monday</div><div class="text-muted small">1 Oktober 2024 17.00</div></div>
                            </div>
                            <div class="col-md-1 d-flex flex-column align-items-center position-relative">
                                <div class="position-absolute top-0 start-50 translate-middle-x bg-warning" style="width: 4px; height: 100%; z-index: 1;"></div>
                                <div class="bg-warning rounded-circle" style="width: 14px; height: 14px; margin-top: 4px; z-index: 2;"></div>
                                <div class="bg-warning rounded-circle" style="width: 14px; height: 14px; margin-top: 66px; z-index: 2;"></div>
                                <div class="bg-warning rounded-circle" style="width: 14px; height: 14px; margin-top: 66px; z-index: 2;"></div>
                                <div class="bg-warning rounded-circle" style="width: 14px; height: 14px; margin-top: 66px; z-index: 2;"></div>
                                <div class="bg-warning rounded-circle" style="width: 14px; height: 14px; margin-top: 66px; z-index: 2;"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-5"><div class="fw-semibold">Completed</div><div class="text-muted small">-</div></div>
                                <div class="mb-5"><div class="fw-semibold">Approved by QHSE</div><div class="text-muted small">Hadian Nelvi (039902)</div></div>
                                <div class="mb-5"><div class="fw-semibold">Waiting Approve QHSE</div><div class="text-muted small">-</div></div>
                                <div class="mb-5"><div class="fw-semibold">Approved by HRD</div><div class="text-muted small">Hadian Nelvi (039902)</div></div>
                                <div><div class="fw-semibold">Register MMS</div><div class="text-muted small">-</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Tab Dashboard
    $(document).ready(function () {
        // Inisialisasi DataTable
        const hpTable = $('#hpTable').DataTable({
            paging: true,
            pageLength: 10,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: false,
            language: {
                search: "Cari:",
                zeroRecords: "Tidak ada data ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            },
            initComplete: function () {
                $('#customSearchWrapper').html(`
                    <input type="text" id="customSearchInput" class="form-control" placeholder="Cari...">
                `);
                $('#customSearchInput').on('keyup', function () {
                    hpTable.search(this.value).draw();
                });
            }
        });

        // Sembunyikan search default
        $('#hpTable_filter').hide();
    });
        // Buka Offcanvas & isi data
    $(document).on('click', '[data-bs-toggle="offcanvas"]', function () {
        const row = $(this).closest('tr');
        const nama = row.find('td:eq(1)').text();
        const brand = row.find('td:eq(2)').text();
        const tipe = row.find('td:eq(4)').text();
        const imei = row.find('td:eq(5)').text();
        const tipePengajuan = row.find('td:eq(6)').text();
        const waktu = row.find('td:eq(7)').text();

        const $offcanvas = $('#detailOffcanvas');
        $offcanvas.find('h4').text(`${brand} - ${tipe}`);
        $offcanvas.find('p:contains("HP:")').html(`<strong>HP:</strong> ${brand}`);
        $offcanvas.find('p:contains("IMEI 1:")').html(`<strong>IMEI 1:</strong> ${imei}`);
        $offcanvas.find('p:contains("Application Type:")').html(`<strong>Application Type:</strong> ${tipePengajuan}`);
        $offcanvas.find('p:contains("Submission Time:")').html(`<strong>Submission Time:</strong> ${waktu}`);
        $offcanvas.find('.badge.bg-light').text(tipePengajuan);
    });

    // Bersihkan backdrop dobel
    $(document).on('shown.bs.offcanvas', function () {
        const $backdrops = $('.offcanvas-backdrop');
        if ($backdrops.length > 1) {
            $backdrops.slice(1).remove();
        }
    });

    // Klik luar area untuk tutup offcanvas
    $(document).on('click', function (e) {
        const $offcanvas = $('#detailOffcanvas');
        const isOpen = $offcanvas.hasClass('show');
        const isInside = $(e.target).closest('#detailOffcanvas').length > 0;

        if (isOpen && !isInside) {
            const instance = bootstrap.Offcanvas.getOrCreateInstance($offcanvas[0]);
            instance.hide();
        }
    });

    // Reset konten saat offcanvas ditutup
    $('#detailOffcanvas').on('hidden.bs.offcanvas', function () {
        const $offcanvas = $(this);
        $offcanvas.find('h4').text(``);
        $offcanvas.find('p:contains("HP:")').html(`<strong>HP:</strong> -`);
        $offcanvas.find('p:contains("IMEI 1:")').html(`<strong>IMEI 1:</strong> -`);
        $offcanvas.find('p:contains("Application Type:")').html(`<strong>Application Type:</strong> -`);
        $offcanvas.find('p:contains("Submission Time:")').html(`<strong>Submission Time:</strong> -`);
        $offcanvas.find('.badge.bg-light').text('-');
    });
    $(document).ready(function () {
        
    });
</script>

<!-- Tambahkan di sini -->
<style>
    #hpTable_filter {
        margin-bottom: 20px;
    }
</style>
@endpush


