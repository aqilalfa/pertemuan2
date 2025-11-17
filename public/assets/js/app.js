// Course Manager - JavaScript functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize delete modal
    initializeDeleteModal();
    
    // Form validation
    initializeFormValidation();
    
    // Add animation on page load
    animateCards();
});

/**
 * Initialize delete confirmation modal
 */
function initializeDeleteModal() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteCourseNameText = document.getElementById('deleteCourseNameText');
    
    if (!deleteModal || !deleteForm || !deleteCourseNameText) {
        return;
    }
    
    const modal = new bootstrap.Modal(deleteModal);
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const courseId = this.getAttribute('data-course-id');
            const courseName = this.getAttribute('data-course-name');
            
            // Update modal content
            deleteCourseNameText.textContent = courseName;
            deleteForm.setAttribute('action', `/courses/${courseId}/delete`);
            
            // Show modal
            modal.show();
        });
    });
}

/**
 * Initialize form validation
 */
function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const nameInput = this.querySelector('input[name="name"]');
            
            if (nameInput && nameInput.value.trim() === '') {
                e.preventDefault();
                showAlert('Course name is required!', 'danger');
                nameInput.focus();
                return false;
            }
            
            // Add loading state to submit button
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !this.id.includes('deleteForm')) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="loading"></span> Processing...';
            }
        });
    });
}

/**
 * Animate cards on page load
 */
function animateCards() {
    const cards = document.querySelectorAll('.card');
    
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

/**
 * Show alert message
 */
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <i class="bi bi-exclamation-circle"></i> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const main = document.querySelector('main');
    if (main) {
        main.insertBefore(alertDiv, main.firstChild);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
}

/**
 * Confirm navigation if form has unsaved changes
 */
function confirmUnsavedChanges() {
    const forms = document.querySelectorAll('form');
    let formChanged = false;
    
    forms.forEach(form => {
        form.addEventListener('change', function() {
            formChanged = true;
        });
        
        form.addEventListener('submit', function() {
            formChanged = false;
        });
    });
    
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
}

// Initialize unsaved changes warning
confirmUnsavedChanges();
