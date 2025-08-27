@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 fw-bold text-primary"><i class="bi bi-megaphone me-2"></i> Pengumuman</h1>

    <div class="row g-4">
        <!-- Pengumuman Admin -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-semibold text-dark">
                    <i class="bi bi-megaphone me-2"></i> Pengumuman Admin
                </div>
                <div class="card-body p-0">
                    @if(isset($pengumumanAdmin) && $pengumumanAdmin->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Isi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengumumanAdmin as $index => $p)
                                        <tr>
                                            <td>{{ $pengumumanAdmin->firstItem() + $index }}</td>
                                            <td><strong>{{ $p->judul }}</strong></td>
                                            <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ Str::limit($p->isi, 80) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($pengumumanAdmin->hasPages())
                            <div class="d-flex justify-content-center p-3">
                                {{ $pengumumanAdmin->appends(['kelas_page' => request('kelas_page')])->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-megaphone display-1"></i>
                            <h5 class="mt-3">Belum ada pengumuman admin</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pengumuman Kelas -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-semibold text-dark">
                    <i class="bi bi-megaphone me-2"></i> Pengumuman Kelas
                </div>
                <div class="card-body p-0">
                    @if($pengumumanKelas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Guru</th>
                                        <th>Tanggal</th>
                                        <th>Isi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengumumanKelas as $index => $pengumuman)
                                        <tr>
                                            <td>{{ $pengumumanKelas->firstItem() + $index }}</td>
                                            <td>
                                                <i class="bi bi-megaphone me-1 text-primary"></i>
                                                <strong>{{ $pengumuman->judul }}</strong>
                                            </td>
                                            <td>
                                                <i class="bi bi-person-badge me-1 text-success"></i>
                                                {{ $pengumuman->guru->nama ?? '-' }}
                                            </td>
                                            <td>
                                                <i class="bi bi-calendar me-1 text-info"></i>
                                                {{ $pengumuman->tanggal->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <i class="bi bi-chat-text me-1 text-secondary"></i>
                                                {{ Str::limit($pengumuman->isi, 80) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($pengumumanKelas->hasPages())
                            <div class="d-flex justify-content-center p-3">
                                {{ $pengumumanKelas->appends(['admin_page' => request('admin_page')])->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-megaphone display-1"></i>
                            <h5 class="mt-3">Belum ada pengumuman</h5>
                            <p>Pengumuman kelas akan muncul setelah guru membuat pengumuman untuk kelas Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 