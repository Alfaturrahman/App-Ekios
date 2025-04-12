@extends('layouts.app')

@section('title', 'Dashboard Registrasi HP')

@section('content')
<div class="container">
    <h3 class="mb-4">Registrasi HP</h3>
    <ul class="nav nav-tabs mb-4" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab">Dashboard</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="registrasi-tab" data-bs-toggle="tab" data-bs-target="#registrasi" type="button" role="tab">List Registrasi</button>
        </li>
    </ul>

    <div class="tab-content" id="dashboardTabsContent">
        <!-- Tab dashboard -->
        <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div>
                <div class="d-flex justify-content-end mb-4">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-building me-2"></i> All Department
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                            <li><a class="dropdown-item" href="#">All Department</a></li>
                            <li><a class="dropdown-item" href="#">IT</a></li>
                            <li><a class="dropdown-item" href="#">HR</a></li>
                            <li><a class="dropdown-item" href="#">Finance</a></li>
                            <li><a class="dropdown-item" href="#">Marketing</a></li>
                        </ul>
                    </div>
                </div>
        
                <!-- Line Chart -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                            <h5 class="mb-3 mb-md-0">New Registered Mobile</h5>
                            <div class="input-group" style="max-width: 180px;">
                                <input type="text" id="year" class="form-control" placeholder="Select Year" readonly>
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                        </div>
                        <div id="registerChart"></div>
                    </div>
                </div>
        
                <!-- Donut Charts -->
                <div class="row">
                    <!-- Register HP -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Register HP</h6>
                                <div class="row align-items-center">
                                    <div class="col-md-7 col-12 mb-3 mb-md-0 text-center">
                                        <div id="statusChart"></div>
                                    </div>
                                    <div class="col-md-5 col-12 text-center text-md-start">
                                        <ul class="list-unstyled mb-5">
                                            <li><i class="fas fa-check-circle text-success me-1"></i> Registered: <span id="statusRegistered">0</span></li>
                                            <li><i class="fas fa-spinner text-warning me-1"></i> Checking: <span id="statusChecking">0</span></li>
                                            <li><i class="fas fa-times-circle text-danger me-1"></i> Rejected: <span id="statusRejected">0</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- OS Device -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">OS Device</h6>
                                <div class="row align-items-center">
                                    <div class="col-md-7 col-12 mb-3 mb-md-0 text-center">
                                        <div id="osChart"></div>
                                    </div>
                                    <div class="col-md-5 col-12 text-center text-md-start">
                                        <ul class="list-unstyled mb-5">
                                            <li><i class="fab fa-apple text-purple me-1"></i> iOS: <span id="osIOS">0</span></li>
                                            <li><i class="fab fa-android text-success me-1"></i> Android: <span id="osAndroid">0</span></li>
                                            <li><i class="fas fa-question-circle text-muted me-1"></i> Unknown: <span id="osUnknown">0</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Registrasi -->
        <div class="tab-pane fade" id="registrasi" role="tabpanel" aria-labelledby="registrasi-tab">
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
                        <form id="mmsForm" enctype="multipart/form-data">
                            @csrf
                        
                            <input type="hidden" name="employee_id" value="{{ auth('employee')->user()->employee_id }}">
                        
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ auth('employee')->user()->employee_name }}" disabled>
                            </div>
                        
                            <!-- Merk HP (brand_type) -->
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">HP</label>
                                    <select class="form-select" name="brand_type" required>
                                        <option selected disabled>Pilih Merk</option>
                                        <option value="Apple">Apple</option>
                                        <option value="Oppo">Oppo</option>
                                        <option value="Samsung">Samsung</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">&nbsp;</label>
                                    <input type="text" class="form-control" name="nama_hp" placeholder="Iphone 13 PRO" required>
                                </div>
                            </div>
                        
                            <!-- OS -->
                            <div class="mb-3">
                                <label class="form-label">OS :</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="os_type" value="Android" required>
                                    <label class="form-check-label">Android</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="os_type" value="Apple" required>
                                    <label class="form-check-label">Apple</label>
                                </div>
                            </div>
                        
                            <!-- IMEI -->
                            <div class="mb-3">
                                <label class="form-label">IMEI 1</label>
                                <input type="text" class="form-control" name="imei1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">IMEI 2</label>
                                <input type="text" class="form-control" name="imei2" required>
                            </div>
                        
                            <!-- Application Type (submission_type) -->
                            <div class="mb-3">
                                <label class="form-label">Application Type</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="submission_type" value="New Employee" required>
                                    <label class="form-check-label">New Employee</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="submission_type" value="New Mobile Phone Addition" required>
                                    <label class="form-check-label">New Mobile Phone Addition</label>
                                </div>
                            </div>
                        
                            <!-- Submission Reason -->
                            <div class="mb-3">
                                <label class="form-label">Submission Reason</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="submission_reason" value="Upload Foto" required>
                                    <label class="form-check-label">Upload Foto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="submission_reason" value="Take Photo" required>
                                    <label class="form-check-label">Take Photo</label>
                                </div>
                            </div>
                        
                            <!-- Upload -->
                            <div class="mb-3">
                                <label class="form-label">Foto Depan</label>
                                <input type="file" class="form-control" name="foto_depan" accept=".jpg,.jpeg,.png" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Belakang</label>
                                <input type="file" class="form-control" name="foto_belakang" accept=".jpg,.jpeg,.png" required>
                            </div>
                        
                            <div class="mt-4 d-flex justify-content-end gap-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Submit</button>
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
                                @foreach ($pengajuan as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item->employee->employee_name }}</td>
                                    <td>{{ $item->employee->department->department_name ?? '-' }}</td>
                                    <td>{{ $item->brand_type }}</td>
                                    <td>{{ $item->nama_hp }}</td>
                                    <td>{{ $item->imei1 }}</td>
                                    <td>{{ $item->submission_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                                    <td>
                                        @php
                                            $status = $item->status;
                                            $badgeClass = match ($status) {
                                                'Disetujui' => 'success',
                                                'Ditolak HRD', 'Ditolak QHSE' => 'danger',
                                                'Menunggu HRD', 'Menunggu QHSE' => 'warning',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">{{ $status }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-sm btn-outline-dark btn-detail"
                                            data-id="{{ $item->pengajuan_id }}"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#detailOffcanvas"
                                        >
                                            <i class="fas fa-eye text-dark"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
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
                    <h4 class="mb-2" id="detailTitle">-</h4>
                    <span id="detailMeta" style="margin-bottom: 5px">-</span>
            
                    <!-- Badges -->
                    <div class="mb-3">
                        <span class="badge bg-light text-dark me-2" id="detailSubmissionType">-</span>
                        <span class="badge" id="detailStatus">-</span>
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
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneCanvas">
                                            Employee Information
                                        </button>
                                    </h2>
                                    <div id="collapseOneCanvas" class="accordion-collapse collapse" data-bs-parent="#accordionInfoCanvas">
                                        <div class="accordion-body">
                                            <div class="row mb-2">
                                                <div class="col-md-4"><strong>Employee Name</strong></div>
                                                <div class="col-md-8" id="detailEmployeeName">-</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4"><strong>Department</strong></div>
                                                <div class="col-md-8" id="detailDepartment">-</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4"><strong>Jabatan</strong></div>
                                                <div class="col-md-8" id="detailEmail">-</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4"><strong>Phone Number</strong></div>
                                                <div class="col-md-8" id="detailPhone">-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Device Info -->
                            <h6 class="fw-bold mb-3">Device Information</h6>
                            <p><strong>HP:</strong> <span id="detailBrand">-</span></p>
                            <p><strong>Barcode Label:</strong> <span id="detailBarcode">-</span></p>
                            <p><strong>IMEI 1:</strong> <span id="detailIMEI1">-</span></p>
                            <p><strong>IMEI 2:</strong> <span id="detailIMEI2">-</span></p>
                            <p><strong>Application Type:</strong> <span id="detailSubmission">-</span></p>
                            <p><strong>Submission Time:</strong> <span id="detailWaktu">-</span></p>
                            <p><strong>Status:</strong> <span id="detailStatusText">-</span></p>
            
                            <!-- Images -->
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <img id="detailFotoBelakang" class="img-fluid rounded mb-2" style="max-height: 200px;" src="https://via.placeholder.com/200x300?text=Back+Phone">
                                    <p>Photo of the back of the phone</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <img id="detailFotoDepan" class="img-fluid rounded mb-2" style="max-height: 200px;" src="https://via.placeholder.com/200x300?text=Front+Phone">
                                    <p>Photo of the front of the phone</p>
                                </div>
                            </div>
            
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn btn-danger me-3" id="btnReject">Reject</button>
                                <button class="btn btn-success" id="btnApprove">Approve</button>
                            </div>
                        </div>
            
                        <!-- Tab History -->
                        <div class="tab-pane fade" id="historyTabCanvas">
                            <div id="historyContent" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Reject -->
            <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-focus="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="rejectForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rejectModalLabel">Reject</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="rejectReason" class="form-label">Remark</label>
                                    <textarea class="form-control" id="rejectReason" name="rejectReason" rows="4" placeholder="Insert Remark" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const currentUserRole = "{{ auth('employee')->user()->jabatan->name ?? '-' }}";

    let registerChart, statusChart, osChart;

    $(document).ready(function () {
        /** ==================== MODAL REJECT ==================== **/
        $('#btnReject').on('click', function () {
            $('#rejectModal').modal('show');
        });

        $('#rejectForm').on('submit', function (e) {
            e.preventDefault();

            const reason = $('#rejectReason').val().trim();
            const id = $('#detailOffcanvas').data('id');

            if (!reason) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Silakan isi alasan penolakan.',
                    confirmButtonColor: '#dc3545'
                });
                return;
            }

            $('#rejectModal').modal('hide');

            $.ajax({
                url: `/pengajuan/${id}/reject`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    reason: reason
                },
                success: function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ditolak',
                        text: 'Permintaan telah berhasil ditolak.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => location.reload());

                    const instance = bootstrap.Offcanvas.getInstance(document.getElementById('detailOffcanvas'));
                    instance.hide();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menolak permintaan.',
                    });
                }
            });
        });

        $('#rejectModal .btn-secondary').on('click', function () {
            $('#rejectModal').modal('hide');
            setTimeout(() => {
                Swal.fire({
                    icon: 'info',
                    title: 'Dibatalkan',
                    text: 'Penolakan dibatalkan.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }, 300);
        });

        $('#rejectModal').on('hidden.bs.modal', function () {
            $('#rejectForm')[0].reset();
        });

        /** ==================== APPROVE ==================== **/
        $('#btnApprove').on('click', function () {
            const id = $('#detailOffcanvas').data('id');

            Swal.fire({
                title: 'Yakin ingin menyetujui?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`/pengajuan/${id}/approve`, function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Disetujui!',
                            text: 'Permintaan telah disetujui.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => setTimeout(() => location.reload(), 500));

                        const instance = bootstrap.Offcanvas.getInstance(document.getElementById('detailOffcanvas'));
                        instance.hide();
                    }).fail(function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyetujui.',
                        });
                    });
                }
            });
        });

        /** ==================== FORM PENGAJUAN ==================== **/
        $('#mmsForm').on('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ route('pengajuan.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    Swal.fire('Success', 'Pengajuan berhasil dikirim!', 'success');
                    $('#mmsModal').modal('hide');
                    $('#mmsForm')[0].reset();
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Gagal mengirim pengajuan!', 'error');
                    console.error(xhr.responseText);
                }
            });
        });

        /** ==================== DETAIL OFFCANVAS ==================== **/
        $(document).on('click', '.btn-detail', function () {
            const id = $(this).data('id');
            $('#detailOffcanvas').data('id', id);
        });

        $('#detailOffcanvas').on('shown.bs.offcanvas', function () {
            const id = $(this).data('id');
            if (!id) return;

            $.get(`/pengajuan/${id}`, function (data) {
                const emp = data.employee;
                const waktu = new Date(data.created_at).toLocaleString('id-ID', {
                    weekday: 'long', day: 'numeric', month: 'long', year: 'numeric',
                    hour: '2-digit', minute: '2-digit'
                });

                // Set data
                $('#detailTitle').text(`${data.brand_type ?? '-'} - ${data.nama_hp ?? '-'}`);
                $('#detailMeta').text(`by ${emp.employee_name ?? '-'} (${emp.employee_badge ?? '-'}), ${waktu}`);
                $('#detailSubmissionType').text(data.submission_type ?? '-');

                let statusText = data.status;
                let statusClass = 'bg-secondary';
                switch (statusText) {
                    case 'Disetujui': statusClass = 'bg-success'; break;
                    case 'Ditolak QHSE':
                    case 'Ditolak HRD': statusClass = 'bg-danger'; break;
                    case 'Menunggu QHSE':
                    case 'Menunggu HRD': statusClass = 'bg-warning'; break;
                }

                $('#detailStatus').text(statusText).removeClass().addClass(`badge ${statusClass}`);
                $('#detailStatusText').text(statusText);
                $('#detailEmployeeName').text(`${emp.employee_name ?? '-'} (${emp.employee_badge ?? '-'})`);
                $('#detailDepartment').text(emp.department?.department_name ?? '-');
                $('#detailEmail').text(emp.jabatan?.name ?? '-');
                $('#detailPhone').parent().hide();
                $('#detailBrand').text(data.brand_type ?? '-');
                $('#detailBarcode').text(data.barcode_label ?? '-');
                $('#detailIMEI1').text(data.imei1 ?? '-');
                $('#detailIMEI2').text(data.imei2 ?? '-');
                $('#detailSubmission').text(data.submission_type ?? '-');
                $('#detailWaktu').text(waktu);

                $('#detailFotoDepan').attr('src', data.foto_depan ? `/storage/${data.foto_depan}` : 'https://via.placeholder.com/200x300?text=Front+Phone');
                $('#detailFotoBelakang').attr('src', data.foto_belakang ? `/storage/${data.foto_belakang}` : 'https://via.placeholder.com/200x300?text=Back+Phone');

                const $historyContent = $('#historyContent');
                $historyContent.empty();

                const histories = data.histories || [];

                if (histories.length > 0) {
                    const timelineItems = histories.map((item, index) => {
                        const tanggal = new Date(item.created_at).toLocaleString('id-ID', {
                            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric',
                            hour: '2-digit', minute: '2-digit'
                        });

                        return `
                            <div class="row align-items-center mb-4">
                                <div class="col-md-3">
                                    <div class="fw-semibold">${tanggal.split(',')[0]}</div>
                                    <div class="text-muted small">${tanggal}</div>
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center position-relative">
                                    <div class="timeline-dot"></div>
                                </div>
                                <div class="col-md-8">
                                    <div class="fw-semibold">${item.status}</div>
                                    <div class="text-muted small">${item.by_name ?? '-'} (${item.user_badge ?? '-'})</div>
                                </div>
                            </div>
                        `;
                    }).join('');

                    // Bungkus semua item dengan garis vertikal 1x
                    $historyContent.html(`
                        <div class="position-relative">
                            <div class="vertical-line-full"></div>
                            ${timelineItems}
                        </div>
                    `);
                } else {
                    $historyContent.html('<div class="text-muted">Tidak ada data.</div>');
                }
                $('#btnApprove, #btnReject').hide();

                if (currentUserRole === 'QHSE' && statusText === 'Menunggu QHSE') {
                    $('#btnApprove, #btnReject').show();
                }
                if (currentUserRole === 'HRD' && statusText === 'Menunggu HRD') {
                    $('#btnApprove, #btnReject').show();
                }
            });
        });

        /** ==================== CLOSE OFFCANVAS BY CLICK OUTSIDE ==================== **/
        $(document).on('click', function (e) {
            const $offcanvas = $('#detailOffcanvas');
            const isOpen = $offcanvas.hasClass('show');
            const isInside = $(e.target).closest('#detailOffcanvas').length > 0;

            if (isOpen && !isInside) {
                const instance = bootstrap.Offcanvas.getOrCreateInstance($offcanvas[0]);
                instance.hide();
            }
        });

        /** ==================== DASHBOARD CHART & TABLE ==================== **/
        $('#year').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
            endDate: new Date()
        }).datepicker('setDate', new Date());

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
                $('#customSearchWrapper').html(`<input type="text" id="customSearchInput" class="form-control" placeholder="Cari...">`);
                $('#customSearchInput').on('keyup', function () {
                    hpTable.search(this.value).draw();
                });
            }
        });

        $('#hpTable_filter').hide();

        const monthlyRegister = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            counts: [20, 30, 50, 60, 55, 48, 52, 45, 28, 60, 58, 22]
        };

        const registerStatus = { registered: 36, checking: 54, rejected: 10 };
        const totalStatus = registerStatus.registered + registerStatus.checking + registerStatus.rejected;

        const osDevices = { ios: 6721, android: 165, unknown: 114 };
        const totalOS = osDevices.ios + osDevices.android + osDevices.unknown;

        registerChart = new ApexCharts(document.querySelector("#registerChart"), {
            chart: { type: 'line', height: 300, toolbar: { show: false } },
            series: [{ name: 'New Registered', data: monthlyRegister.counts }],
            xaxis: { categories: monthlyRegister.labels },
            stroke: { curve: 'smooth', width: 3 },
            markers: { size: 4 },
            colors: ['#00b894']
        });
        registerChart.render();

        statusChart = new ApexCharts(document.querySelector("#statusChart"), {
            chart: { type: 'donut', height: 300 },
            series: Object.values(registerStatus),
            labels: ['Registered', 'Checking', 'Rejected'],
            colors: ['#27ae60', '#f1c40f', '#e74c3c'],
            legend: { position: 'bottom' },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: () => totalStatus
                            }
                        }
                    }
                }
            }
        });
        statusChart.render();

        osChart = new ApexCharts(document.querySelector("#osChart"), {
            chart: { type: 'donut', height: 300 },
            series: Object.values(osDevices),
            labels: ['iOS', 'Android', 'Unknown'],
            colors: ['#9b59b6', '#2ecc71', '#95a5a6'],
            legend: { position: 'bottom' },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: () => totalOS
                            }
                        }
                    }
                }
            }
        });
        osChart.render();

        $('#statusRegistered').text(registerStatus.registered);
        $('#statusChecking').text(registerStatus.checking);
        $('#statusRejected').text(registerStatus.rejected);
        $('#osIOS').text(osDevices.ios);
        $('#osAndroid').text(osDevices.android);
        $('#osUnknown').text(osDevices.unknown);
    });
</script>



<style>
    /* Sembunyikan filter default DataTables */
    #hpTable_filter {
        display: none;
    }

    /* Tab aktif */
    .nav-tabs .nav-link.active {
        color: #DCD135 !important;
        font-weight:600; 
    }

    .nav-tabs .nav-link {
        color: #000;
        font-weight: 400;
    }

    /* Table container (jika pakai card wrapper) */
    .card-table-wrapper {
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        padding: 1rem;
        background-color: #fff;
    }

    /* Tabel style */
    #hpTable {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        font-size: 13.5px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        overflow: hidden;
    }

    /* Header */
    #hpTable thead {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #343a40;
    }

    #hpTable th {
        padding: 6px 8px;
    }

    #hpTable td {
        padding: 6px 8px;
    }

    /* Row lines */
    #hpTable tbody tr {
        border-bottom: 1px solid #e4e6e8;
        transition: background-color 0.2s ease;
    }

    #hpTable tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Badge styling */
    .badge {
        font-size: 13px;
        padding: 4px 10px;
        border-radius: 12px;
        font-weight: 500;
    }

    .badge.bg-success {
        background-color: #27ae60 !important;
        color: white;
    }

    .badge.bg-danger {
        background-color: #e57373 !important;
        color: white;
    }

    .badge.bg-warning {
        background-color: #f39c12 !important;
        color: white;
    }

    .badge.bg-info {
        background-color: #5dade2 !important;
        color: white;
    }

    .badge.bg-secondary {
        background-color: #e67e22 !important;
        color: white;
    }

    /* Detail icon (mata) */
    .btn-link {
        color: #adb5bd;
        transition: color 0.2s ease;
    }

    .btn-link:hover {
        color: #343a40;
        text-decoration: none;
    }

    /* Center alignment (untuk kolom tertentu) */
    .text-center {
        text-align: center !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #hpTable th, #hpTable td {
            padding: 10px;
            font-size: 13px;
        }
    }

    .tab-pane {
        transition: opacity 0.3s ease-in-out;
    }
    #historyDateList > div,
    #historyLine > div,
    #historyStatusList > div {
        min-height: 70px; /* Atur tinggi tetap agar semua kolom sejajar */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .timeline-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #F6B543;
        z-index: 2;
        flex-shrink: 0;
    }

    .vertical-line-full {
        position: absolute;
        top: 0;
        bottom: 0;
        left:226px;
        width: 3px;
        background-color: #F6B543;
        z-index: 0;
    }
</style>


@endpush
