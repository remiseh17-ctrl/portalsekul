@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 fw-bold text-primary">
        <i class="bi bi-person-badge me-2"></i> Dashboard Guru
    </h1>

    <div class="row g-3 mb-4">
        <!-- Jadwal Mengajar Hari Ini -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-semibold text-dark d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                    <div>
                        <i class="bi bi-calendar-event me-2"></i> Jadwal Mengajar Hari Ini
                    </div>
                    <input type="text" id="searchJadwal" class="form-control form-control-sm" style="min-width: 200px;" placeholder="Cari jadwal...">
                </div>
                <div class="card-body p-0">
                    @if($jadwalHariIni->count())
                        <div class="list-group list-group-flush" id="jadwalList">
                            @foreach($jadwalHariIni as $jadwal)
                                <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                                    <div class="flex-grow-1 min-w-0">
                                        <i class="bi bi-easel me-1 text-secondary"></i>
                                        <strong>{{ $jadwal->kelas->nama ?? '-' }}</strong> - 
                                        <i class="bi bi-book me-1 text-primary"></i>
                                        {{ $jadwal->mapel }}
                                    </div>
                                    <div class="text-info fw-semibold text-nowrap">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="bi bi-calendar-x me-2"></i>Tidak ada jadwal hari ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Absensi Terbaru -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-semibold text-dark d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                    <div>
                        <i class="bi bi-clipboard-check me-2"></i> Absensi Terbaru
                    </div>
                    <input type="text" id="searchAbsensi" class="form-control form-control-sm" style="min-width: 200px;" placeholder="Cari absensi...">
                </div>
                <div class="card-body p-0">
                    @if($absensiTerbaru->count())
                        <div class="list-group list-group-flush" id="absensiList">
                            @foreach($absensiTerbaru as $absensi)
                                <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                                    <div class="flex-grow-1 min-w-0">
                                        <i class="bi bi-person-circle me-1 text-success"></i>
                                        <strong>{{ $absensi->siswa->nama ?? '-' }}</strong>
                                        <small class="text-muted d-block">
                                            <i class="bi bi-easel me-1"></i>({{ $absensi->jadwal->kelas->nama ?? '-' }})
                                        </small>
                                    </div>
                                    <div class="text-end text-nowrap">
                                        <div class="fw-semibold text-{{ $absensi->status == 'Hadir' ? 'success' : ($absensi->status == 'Sakit' ? 'warning' : 'danger') }}">
                                            {{ $absensi->status }}
                                        </div>
                                        <small class="text-muted d-block">
                                            <i class="bi bi-calendar me-1"></i>{{ $absensi->tanggal->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="bi bi-clipboard-x me-2"></i>Belum ada absensi terbaru.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Nilai Terbaru -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-semibold text-dark d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
            <div>
                <i class="bi bi-star me-2"></i> Nilai Terbaru
            </div>
            <input type="text" id="searchNilai" class="form-control form-control-sm" style="min-width: 200px;" placeholder="Cari nilai...">
        </div>
        <div class="card-body p-0">
            @if($nilaiTerbaru->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="nilaiTable">
                        <thead class="table-light">
                            <tr>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis</th>
                                <th class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilaiTerbaru as $nilai)
                                <tr>
                                    <td>
                                        <i class="bi bi-person-circle me-1 text-success"></i>
                                        <strong>{{ $nilai->siswa->nama ?? '-' }}</strong>
                                    </td>
                                    <td>
                                        <i class="bi bi-easel me-1 text-secondary"></i>
                                        {{ $nilai->jadwal->kelas->nama ?? '-' }}
                                    </td>
                                    <td>
                                        <div class="text-primary">{{ ucfirst($nilai->jenis) }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fw-semibold text-{{ $nilai->nilai >= 75 ? 'success' : ($nilai->nilai >= 60 ? 'warning' : 'danger') }}">
                                            {{ $nilai->nilai }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-3">
                    <i class="bi bi-star me-2"></i>Belum ada nilai terbaru.
                </div>
            @endif
        </div>
    </div>

    <!-- Pengumuman Admin Terbaru -->
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-white fw-semibold text-dark d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-megaphone me-2"></i> Pengumuman Admin Terbaru
            </div>
        </div>
        <div class="card-body p-0">
            @if($pengumumanAdminTerbaru->count())
                <div class="list-group list-group-flush">
                    @foreach($pengumumanAdminTerbaru as $p)
                        <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                            <div class="fw-semibold text-dark flex-grow-1 min-w-0">
                                <i class="bi bi-info-circle me-1 text-primary"></i>
                                {{ $p->judul }}
                            </div>
                            <small class="text-muted text-nowrap">
                                <i class="bi bi-calendar me-1"></i>{{ $p->tanggal?->format('d/m/Y') ?? $p->tanggal }}
                            </small>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-3">
                    <i class="bi bi-megaphone me-2"></i>Belum ada pengumuman admin.
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Style tambahan --}}
<style>
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .list-group-item {
            padding: 0.75rem 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }
        
        .table-responsive {
            font-size: 0.8rem;
        }
        
        .list-group-item {
            padding: 0.5rem 0.75rem;
        }
    }
</style>

@push('scripts')
<script>
    // Filter Jadwal
    document.getElementById('searchJadwal').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#jadwalList .list-group-item').forEach(function(item) {
            item.style.display = item.innerText.toLowerCase().includes(filter) ? '' : 'none';
        });
    });

    // Filter Absensi
    document.getElementById('searchAbsensi').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#absensiList .list-group-item').forEach(function(item) {
            item.style.display = item.innerText.toLowerCase().includes(filter) ? '' : 'none';
        });
    });

    // Filter Nilai
    document.getElementById('searchNilai').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#nilaiTable tbody tr').forEach(function(row) {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
