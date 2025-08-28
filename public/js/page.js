//manajemen siswa

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Live Search & Filter Implementation
        const searchInput = document.getElementById('liveSearchInput');
        const kelasFilter = document.getElementById('kelasFilter');
        const tableRows = document.querySelectorAll('tbody tr:not([data-empty])');
        const emptyStateRow = document.querySelector('tbody tr[data-empty], tbody tr td[colspan]')?.closest('tr');
        const visibleCountElement = document.getElementById('visibleCount');
        const searchStatus = document.getElementById('searchStatus');
        const searchIcon = document.getElementById('searchIcon');
        const clearButton = document.getElementById('clearSearch');
        const activeFiltersContainer = document.getElementById('activeFilters');

        let searchTimeout;
        let isSearching = false;

        // Advanced table filter function
        function createAdvancedTableFilter() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedKelas = kelasFilter.value.toLowerCase().trim();
            
            let visibleCount = 0;
            let hasResults = false;

            // Show searching status
            if (searchTerm || selectedKelas) {
                updateSearchStatus('Mencari...', true);
            }

            tableRows.forEach((row, index) => {
                if (row.querySelector('td[colspan]')) return; // Skip empty state row
                
                const rowText = row.textContent.toLowerCase();
                const kelasCell = row.querySelector('td:nth-child(5)')?.textContent.toLowerCase() || '';
                
                const matchesSearch = !searchTerm || rowText.includes(searchTerm);
                const matchesKelas = !selectedKelas || kelasCell.includes(selectedKelas);
                
                if (matchesSearch && matchesKelas) {
                    row.style.display = '';
                    row.classList.remove('hidden');
                    
                    // Stagger animation for visible rows
                    setTimeout(() => {
                        row.style.opacity = '1';
                        row.style.transform = 'translateY(0)';
                    }, index * 30);
                    
                    visibleCount++;
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                    row.classList.add('hidden');
                    row.style.opacity = '0';
                    row.style.transform = 'translateY(10px)';
                }
            });

            // Update visible count
            if (visibleCountElement) {
                visibleCountElement.textContent = visibleCount;
            }

            // Handle empty state
            if (emptyStateRow) {
                if (!hasResults && (searchTerm || selectedKelas)) {
                    emptyStateRow.style.display = '';
                    emptyStateRow.querySelector('td p').textContent = 'Tidak ada siswa yang cocok dengan pencarian';
                    emptyStateRow.querySelector('td p + p').textContent = 'Coba ubah kata kunci pencarian Anda';
                } else if (!hasResults) {
                    emptyStateRow.style.display = '';
                } else {
                    emptyStateRow.style.display = 'none';
                }
            }

            // Update search status
            setTimeout(() => {
                if (searchTerm || selectedKelas) {
                    updateSearchStatus(`Menampilkan ${visibleCount} hasil`, false);
                } else {
                    updateSearchStatus('Pencarian real-time aktif', false);
                }
            }, 300);

            // Update active filters
            updateActiveFilters(searchTerm, selectedKelas);
        }

        // Update search status with visual indicators
        function updateSearchStatus(message, isLoading) {
            if (searchStatus) {
                searchStatus.textContent = message;
            }
            
            if (searchIcon) {
                if (isLoading) {
                    searchIcon.classList.remove('lucide-search');
                    searchIcon.classList.add('animate-spin');
                    searchIcon.innerHTML = '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>';
                } else {
                    searchIcon.classList.remove('animate-spin');
                    searchIcon.classList.add('lucide-search');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                }
            }
        }

        // Update active filters display
        function updateActiveFilters(searchTerm, selectedKelas) {
            activeFiltersContainer.innerHTML = '';
            
            if (searchTerm) {
                const searchTag = createFilterTag('Pencarian', `"${searchTerm}"`, () => {
                    searchInput.value = '';
                    createAdvancedTableFilter();
                });
                activeFiltersContainer.appendChild(searchTag);
            }
            
            if (selectedKelas) {
                const kelasTag = createFilterTag('Kelas', selectedKelas, () => {
                    kelasFilter.value = '';
                    createAdvancedTableFilter();
                });
                activeFiltersContainer.appendChild(kelasTag);
            }

            if (searchTerm || selectedKelas) {
                const clearAllTag = createFilterTag('Hapus Semua', '', () => {
                    searchInput.value = '';
                    kelasFilter.value = '';
                    createAdvancedTableFilter();
                }, 'clear-all');
                activeFiltersContainer.appendChild(clearAllTag);
            }
        }

        // Create filter tag element
        function createFilterTag(label, value, onRemove, type = 'normal') {
            const tag = document.createElement('div');
            const baseClasses = 'inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium transition-all duration-200 cursor-pointer hover:scale-105';
            
            if (type === 'clear-all') {
                tag.className = baseClasses + ' bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200 border border-red-200 dark:border-red-800 hover:bg-red-200 dark:hover:bg-red-900/50';
                tag.innerHTML = `
                    <i data-lucide="x-circle" class="w-3 h-3"></i>
                    <span>${label}</span>
                `;
            } else {
                tag.className = baseClasses + ' bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200 border border-blue-200 dark:border-blue-800 hover:bg-blue-200 dark:hover:bg-blue-900/50';
                tag.innerHTML = `
                    <span>${label}: ${value}</span>
                    <i data-lucide="x" class="w-3 h-3 hover:text-blue-600 dark:hover:text-blue-400"></i>
                `;
            }
            
            tag.addEventListener('click', onRemove);
            
            // Re-initialize icons for the new elements
            setTimeout(() => {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }, 100);
            
            return tag;
        }

        // Search input event listeners
        if (searchInput) {
            // Real-time search with debouncing
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                isSearching = true;
                
                // Show/hide clear button
                if (this.value.length > 0) {
                    clearButton.classList.remove('hidden');
                } else {
                    clearButton.classList.add('hidden');
                }
                
                searchTimeout = setTimeout(() => {
                    createAdvancedTableFilter();
                    isSearching = false;
                }, 300);
            });

            // Enhanced focus effects
            searchInput.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50', 'scale-[1.01]');
                updateSearchStatus('Mulai mengetik untuk mencari...', false);
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50', 'scale-[1.01]');
                if (!this.value && !kelasFilter.value) {
                    updateSearchStatus('Pencarian real-time aktif', false);
                }
            });

            // Clear search functionality
            if (clearButton) {
                clearButton.addEventListener('click', function() {
                    searchInput.value = '';
                    this.classList.add('hidden');
                    createAdvancedTableFilter();
                    searchInput.focus();
                });
            }
        }

        // Kelas filter event listener
        if (kelasFilter) {
            kelasFilter.addEventListener('change', function() {
                createAdvancedTableFilter();
            });
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
                searchInput.select();
            }
            
            // Escape to clear search
            if (e.key === 'Escape' && document.activeElement === searchInput) {
                searchInput.value = '';
                kelasFilter.value = '';
                clearButton.classList.add('hidden');
                createAdvancedTableFilter();
                searchInput.blur();
            }
        });

        // Add loading animation to table rows (non-search related)
        tableRows.forEach((row, index) => {
            if (!row.querySelector('[colspan]')) { // Skip empty state row
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    row.style.transition = 'all 0.6s ease-out';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            }
        });

        // Auto-dismiss success alerts after 5 seconds
        const successAlert = document.querySelector('.bg-green-50');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-100%)';
                setTimeout(() => successAlert.remove(), 300);
            }, 5000);
        }

        // Enhanced action button animations
        const actionButtons = document.querySelectorAll('tbody button, tbody a');
        actionButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.05)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Initialize search helper text
        setTimeout(() => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }, 100);
    });
//manajemen guru
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('liveSearchInput');
    const mapelFilter = document.getElementById('mapelFilter');
    const clearSearchBtn = document.getElementById('clearSearch');
    const tableBody = document.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    // Function to perform search and filter
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedMapel = mapelFilter.value.toLowerCase();

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty state row
            
            const nama = row.cells[3]?.textContent.toLowerCase() || '';
            const nip = row.cells[2]?.textContent.toLowerCase() || '';
            const mapel = row.cells[4]?.textContent.toLowerCase() || '';
            
            const matchesSearch = nama.includes(searchTerm) || nip.includes(searchTerm);
            const matchesMapel = !selectedMapel || mapel.includes(selectedMapel);
            
            row.style.display = matchesSearch && matchesMapel ? '' : 'none';
        });

        // Show/hide clear button
        clearSearchBtn.classList.toggle('hidden', !searchTerm);
    }

    // Event listeners
    searchInput.addEventListener('input', filterTable);
    mapelFilter.addEventListener('change', filterTable);
    
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterTable();
        searchInput.focus();
    });

    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
//  manajemen kelas

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('liveSearchInput');
    const waliKelasFilter = document.getElementById('waliKelasFilter');
    const clearSearchBtn = document.getElementById('clearSearch');
    const tableBody = document.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    // Function to perform search and filter
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedWaliKelas = waliKelasFilter.value.toLowerCase();

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty state row
            
            const namaKelas = row.cells[1]?.textContent.toLowerCase() || '';
            const jurusan = row.cells[2]?.textContent.toLowerCase() || '';
            const waliKelas = row.cells[3]?.textContent.toLowerCase() || '';
            
            const matchesSearch = namaKelas.includes(searchTerm) || jurusan.includes(searchTerm);
            const matchesWaliKelas = !selectedWaliKelas || waliKelas.includes(selectedWaliKelas);
            
            row.style.display = matchesSearch && matchesWaliKelas ? '' : 'none';
        });

        // Show/hide clear button
        clearSearchBtn.classList.toggle('hidden', !searchTerm);
    }

    // Event listeners
    searchInput.addEventListener('input', filterTable);
    waliKelasFilter.addEventListener('change', filterTable);
    
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterTable();
        searchInput.focus();
    });

    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});