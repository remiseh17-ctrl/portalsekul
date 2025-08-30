// Utility: Debounce
function debounce(func, delay = 300) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

// Init Lucide Icons
function initializeLucideIcons() {
    if (window.lucide) lucide.createIcons();
}

// Table Filter
function createTableFilter(inputId, tableId, additionalFilters = [], clearBtnId = 'clearSearch') {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);
    const clearButton = document.getElementById(clearBtnId);

    if (!input || !table) return;

    const rows = table.querySelectorAll('tbody tr:not([data-empty])');

    const filterTable = () => {
        const searchTerm = input.value.toLowerCase().trim();
        const additionalValues = additionalFilters.map(id => document.getElementById(id)?.value.toLowerCase() || '');

        let visibleCount = 0;

        rows.forEach(row => {
            const matchesSearch = row.textContent.toLowerCase().includes(searchTerm);
            const matchesAdditional = additionalValues.every((value, index) => {
                return !value || row.cells[index + 1]?.textContent.toLowerCase().includes(value);
            });

            row.style.display = matchesSearch && matchesAdditional ? '' : 'none';
            if (matchesSearch && matchesAdditional) visibleCount++;
        });

        if (clearButton) clearButton.classList.toggle('hidden', !searchTerm);
    };

    input.addEventListener('input', debounce(filterTable, 300));
    additionalFilters.forEach(filterId => {
        document.getElementById(filterId)?.addEventListener('change', filterTable);
    });

    if (clearButton) {
        clearButton.addEventListener('click', () => {
            input.value = '';
            filterTable();
            input.focus();
        });
    }
}

// Tooltip Init
function initializeTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].forEach(el => new bootstrap.Tooltip(el));
}

// Animation Init (Lightweight)
function animateOnLoad(selector, delay = 100) {
    const elements = document.querySelectorAll(selector);
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease-out';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * delay);
    });
}

// Main Init
document.addEventListener('DOMContentLoaded', function () {
    initializeLucideIcons();
    initializeTooltips();

    // Kondisi per page
    const body = document.body;
    
    // Dashboard Admin
    if (body.classList.contains('page-dashboard')) {
        createTableFilter("searchJadwal", "tableJadwal");
        createTableFilter("searchPengumuman", "tablePengumuman");
        animateOnLoad('.stat-card', 100);
    }

    // Halaman Siswa
    if (body.classList.contains('page-siswa')) {
        createTableFilter("liveSearchInput", "tableSiswa", ["kelasFilter"], "clearSearch");
        animateOnLoad('#tableSiswa tbody tr', 60);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
    }

    // Halaman Kelas
    if (body.classList.contains('page-kelas')) {
        createTableFilter("liveSearchInput", "tableKelas", ["waliKelasFilter"], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru
    if (body.classList.contains('page-guru')) {
        createTableFilter("liveSearchInput", "tableGuru", ["mapelFilter"], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Jadwal
    if (body.classList.contains('page-jadwal')) {
        createTableFilter("liveSearchInput", "tableJadwal", ["kelasFilter", "hariFilter"], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Pengumuman
    if (body.classList.contains('page-pengumuman')) {
        createTableFilter("liveSearchInput", "tablePengumuman", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Dashboard Siswa
    if (body.classList.contains('page-dashboard-siswa')) {
        createTableFilter("searchJadwalSiswa", "tableJadwalSiswa", [], null);
        createTableFilter("searchPengumumanSiswa", "tablePengumumanSiswa", [], null);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Siswa - Jadwal
    if (body.classList.contains('page-siswa-jadwal')) {
        createTableFilter("searchJadwalSiswa", "tableJadwalSiswa", [], null);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Siswa - Absensi
    if (body.classList.contains('page-siswa-absensi')) {
        createTableFilter("searchAbsensiSiswa", "tableAbsensiSiswa", [], null);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Siswa - Materi
    if (body.classList.contains('page-siswa-materi')) {
        createTableFilter("searchMateriSiswa", "tableMateriSiswa", [], null);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Siswa - Pengumuman
    if (body.classList.contains('page-siswa-pengumuman')) {
        createTableFilter("searchPengumumanAdmin", "tablePengumumanAdmin", [], null);
        createTableFilter("searchPengumumanKelas", "tablePengumumanKelas", [], null);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Siswa - Nilai
    if (body.classList.contains('page-siswa-nilai')) {
        createTableFilter("searchNilaiSiswa", "tableNilaiSiswa", [], null);
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru - Jadwal Mengajar
    if (body.classList.contains('page-guru-jadwal')) {
        createTableFilter("liveSearchInput", "tableJadwalGuru", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru - Absensi
    if (body.classList.contains('page-guru-absensi')) {
        createTableFilter("liveSearchInput", "tableAbsensiGuru", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru - Absensi Guru
    if (body.classList.contains('page-guru-absensi-guru')) {
        createTableFilter("liveSearchInput", "tableRiwayatAbsensi", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru - Materi
    if (body.classList.contains('page-guru-materi')) {
        createTableFilter("liveSearchInput", "tableMateriGuru", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru - Nilai
    if (body.classList.contains('page-guru-nilai')) {
        createTableFilter("liveSearchInput", "tableNilaiGuru", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Guru - Pengumuman Kelas
    if (body.classList.contains('page-guru-pengumuman-kelas')) {
        createTableFilter("liveSearchInput", "tablePengumumanKelas", [], "clearSearch");
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Halaman Dashboard Guru
    if (body.classList.contains('page-dashboard-guru')) {
        animateOnLoad('.bg-white.dark\\:bg-gray-800.rounded-xl', 100);
        animateOnLoad('tbody tr', 80);
    }

    // Global animations untuk semua halaman
    animateOnLoad('.stat-card', 100);
    animateOnLoad('.card', 120);
});
