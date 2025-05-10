// Utility functions
const formatDate = (date) => {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const showNotification = (message, type = 'success') => {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
};

// API calls
const api = {
    async get(endpoint) {
        const response = await fetch(`/api/${endpoint}`);
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    },
    
    async post(endpoint, data) {
        const response = await fetch(`/api/${endpoint}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    },
    
    async put(endpoint, data) {
        const response = await fetch(`/api/${endpoint}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    },
    
    async delete(endpoint, id) {
        const response = await fetch(`/api/${endpoint}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id })
        });
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    }
};

// Members management
const members = {
    async loadMembers() {
        try {
            const data = await api.get('members.php');
            const tbody = document.querySelector('#membersTable tbody');
            tbody.innerHTML = data.map(member => `
                <tr>
                    <td>${member.name}</td>
                    <td>${member.email}</td>
                    <td>${member.student_id}</td>
                    <td>${member.course}</td>
                    <td>${member.year_level}</td>
                    <td>
                        <span class="badge bg-${member.status === 'active' ? 'success' : 'secondary'}">
                            ${member.status}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" onclick="members.editMember(${member.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-outline-danger" onclick="members.deleteMember(${member.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            showNotification('Failed to load members', 'danger');
        }
    },
    
    async addMember(formData) {
        try {
            await api.post('members.php', formData);
            showNotification('Member added successfully');
            this.loadMembers();
        } catch (error) {
            showNotification('Failed to add member', 'danger');
        }
    },
    
    async editMember(id) {
        try {
            const member = await api.get(`members.php?id=${id}`);
            // Populate form with member data
            document.getElementById('memberId').value = member.id;
            document.getElementById('memberName').value = member.name;
            document.getElementById('memberEmail').value = member.email;
            document.getElementById('memberStudentId').value = member.student_id;
            document.getElementById('memberCourse').value = member.course;
            document.getElementById('memberYearLevel').value = member.year_level;
            document.getElementById('memberStatus').value = member.status;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('memberModal'));
            modal.show();
        } catch (error) {
            showNotification('Failed to load member data', 'danger');
        }
    },
    
    async updateMember(formData) {
        try {
            await api.put('members.php', formData);
            showNotification('Member updated successfully');
            this.loadMembers();
        } catch (error) {
            showNotification('Failed to update member', 'danger');
        }
    },
    
    async deleteMember(id) {
        if (confirm('Are you sure you want to delete this member?')) {
            try {
                await api.delete('members.php', id);
                showNotification('Member deleted successfully');
                this.loadMembers();
            } catch (error) {
                showNotification('Failed to delete member', 'danger');
            }
        }
    }
};

// Events management
const events = {
    async loadEvents() {
        try {
            const data = await api.get('events.php');
            const tbody = document.querySelector('#eventsTable tbody');
            tbody.innerHTML = data.map(event => `
                <tr>
                    <td>${event.title}</td>
                    <td>${formatDate(event.event_date)}</td>
                    <td>${event.location}</td>
                    <td>
                        <span class="badge bg-${this.getStatusColor(event.status)}">
                            ${event.status}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" onclick="events.editEvent(${event.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-outline-danger" onclick="events.deleteEvent(${event.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            showNotification('Failed to load events', 'danger');
        }
    },
    
    getStatusColor(status) {
        const colors = {
            upcoming: 'primary',
            ongoing: 'success',
            completed: 'secondary',
            cancelled: 'danger'
        };
        return colors[status] || 'secondary';
    }
};

// Initialize tooltips
document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Load initial data if on specific pages
    if (document.getElementById('membersTable')) {
        members.loadMembers();
    }
    if (document.getElementById('eventsTable')) {
        events.loadEvents();
    }
}); 