// Load events for the dropdown
async function loadEvents() {
    try {
        const events = await api.get('events.php');
        const eventFilter = document.getElementById('eventFilter');
        const uploadEvent = document.getElementById('uploadEvent');
        
        const options = '<option value="">All Events</option>' +
            events.map(event => `
                <option value="${event.id}">${event.title} - ${formatDate(event.event_date)}</option>
            `).join('');
            
        eventFilter.innerHTML = options;
        uploadEvent.innerHTML = options;
    } catch (error) {
        showNotification('Failed to load events', 'danger');
    }
}

// Load gallery images
async function loadGallery() {
    const eventId = document.getElementById('eventFilter').value;
    const date = document.getElementById('dateFilter').value;

    try {
        const images = await api.get(`gallery.php?event_id=${eventId}&date=${date}`);
        const galleryGrid = document.getElementById('galleryGrid');
        
        galleryGrid.innerHTML = images.map(image => `
            <div class="col-md-4 col-lg-3">
                <div class="card h-100">
                    <a href="${image.image_path}" data-lightbox="gallery" data-title="${image.title}">
                        <img src="${image.image_path}" class="card-img-top" alt="${image.title}">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title">${image.title}</h6>
                        <p class="card-text small text-muted">${image.description || ''}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">${formatDate(image.created_at)}</small>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="viewImage(${image.id})">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-danger" onclick="deleteImage(${image.id})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    } catch (error) {
        showNotification('Failed to load gallery images', 'danger');
    }
}

// Filter gallery
function filterGallery() {
    loadGallery();
}

// Upload images
async function uploadImages() {
    const eventId = document.getElementById('uploadEvent').value;
    const title = document.getElementById('imageTitle').value;
    const description = document.getElementById('imageDescription').value;
    const files = document.getElementById('imageFiles').files;

    if (!eventId || !title || files.length === 0) {
        showNotification('Please fill in all required fields', 'warning');
        return;
    }

    const formData = new FormData();
    formData.append('event_id', eventId);
    formData.append('title', title);
    formData.append('description', description);
    
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    try {
        await fetch('/api/gallery.php', {
            method: 'POST',
            body: formData
        });
        
        showNotification('Images uploaded successfully');
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
        modal.hide();
        
        loadGallery();
    } catch (error) {
        showNotification('Failed to upload images', 'danger');
    }
}

// View image details
async function viewImage(id) {
    try {
        const image = await api.get(`gallery.php?id=${id}`);
        
        document.getElementById('previewImage').src = image.image_path;
        document.getElementById('previewTitle').textContent = image.title;
        document.getElementById('previewDescription').textContent = image.description || 'No description';
        document.getElementById('previewEvent').textContent = image.event_title;
        document.getElementById('previewDate').textContent = formatDate(image.created_at);
        
        const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        modal.show();
    } catch (error) {
        showNotification('Failed to load image details', 'danger');
    }
}

// Delete image
async function deleteImage(id) {
    if (confirm('Are you sure you want to delete this image?')) {
        try {
            await api.delete('gallery.php', id);
            showNotification('Image deleted successfully');
            
            const modal = bootstrap.Modal.getInstance(document.getElementById('imagePreviewModal'));
            modal.hide();
            
            loadGallery();
        } catch (error) {
            showNotification('Failed to delete image', 'danger');
        }
    }
}

// Initialize page
document.addEventListener('DOMContentLoaded', () => {
    loadEvents();
    loadGallery();
}); 