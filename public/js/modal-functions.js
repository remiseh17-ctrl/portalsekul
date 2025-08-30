// Modal Functions
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modals
    initializeModals();
    
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize modal animations
    initializeModalAnimations();
});

function initializeModals() {
    // Auto-focus first input in modal when opened
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            const firstInput = this.querySelector('input, select, textarea');
            if (firstInput) {
                firstInput.focus();
            }
        });
        
        // Clear form when modal is hidden
        modal.addEventListener('hidden.bs.modal', function() {
            const form = this.querySelector('form');
            if (form) {
                form.reset();
                // Clear validation errors
                clearValidationErrors(form);
            }
        });
    });
}

function initializeFormValidation() {
    // Add real-time validation to form inputs
    const forms = document.querySelectorAll('.modal form');
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });
        
        // Form submission validation
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                showFormErrors(this);
            }
        });
    });
}

function validateField(field) {
    const value = field.value.trim();
    const isRequired = field.hasAttribute('required');
    const minLength = field.getAttribute('minlength');
    const maxLength = field.getAttribute('maxlength');
    const pattern = field.getAttribute('pattern');
    
    // Clear previous errors
    clearFieldError(field);
    
    // Required field validation
    if (isRequired && !value) {
        showFieldError(field, 'Field ini wajib diisi');
        return false;
    }
    
    // Min length validation
    if (minLength && value.length < parseInt(minLength)) {
        showFieldError(field, `Minimal ${minLength} karakter`);
        return false;
    }
    
    // Max length validation
    if (maxLength && value.length > parseInt(maxLength)) {
        showFieldError(field, `Maksimal ${maxLength} karakter`);
        return false;
    }
    
    // Pattern validation
    if (pattern && value && !new RegExp(pattern).test(value)) {
        showFieldError(field, 'Format tidak sesuai');
        return false;
    }
    
    return true;
}

function showFieldError(field, message) {
    // Remove existing error
    clearFieldError(field);
    
    // Create error element
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-red-500 text-sm mt-1';
    errorDiv.textContent = message;
    
    // Insert error after field
    field.parentNode.appendChild(errorDiv);
    
    // Add error class to field
    field.classList.add('border-red-500');
}

function clearFieldError(field) {
    // Remove error class
    field.classList.remove('border-red-500');
    
    // Remove error message
    const errorDiv = field.parentNode.querySelector('.text-red-500');
    if (errorDiv) {
        errorDiv.remove();
    }
}

function validateForm(form) {
    const inputs = form.querySelectorAll('input, select, textarea');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function showFormErrors(form) {
    // Scroll to first error
    const firstError = form.querySelector('.text-red-500');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function clearValidationErrors(form) {
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        clearFieldError(input);
    });
}

function initializeModalAnimations() {
    // Add smooth transitions to modal content
    const modalContents = document.querySelectorAll('.modal-content');
    modalContents.forEach(content => {
        content.style.transition = 'all 0.3s ease-in-out';
    });
    
    // Add loading state to submit buttons
    const submitButtons = document.querySelectorAll('.modal form button[type="submit"]');
    submitButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.form && this.form.checkValidity()) {
                this.disabled = true;
                this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
            }
        });
    });
}

// Utility functions
function showModal(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
}

function hideModal(modalId) {
    const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
    if (modal) {
        modal.hide();
    }
}

// Export functions for global use
window.ModalFunctions = {
    showModal,
    hideModal,
    validateField,
    validateForm
};
