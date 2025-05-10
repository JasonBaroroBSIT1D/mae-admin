// Load events for the dropdown
async function loadEvents() {
    try {
        const events = await api.get('events.php');
        const eventSelect = document.getElementById('eventSelect');
        eventSelect.innerHTML = '<option value="">Choose an event...</option>' +
            events.map(event => `
                <option value="${event.id}">${event.title} - ${formatDate(event.event_date)}</option>
            `).join('');
    } catch (error) {
        showNotification('Failed to load events', 'danger');
    }
}

// Load attendance data
async function loadAttendance() {
    const eventId = document.getElementById('eventSelect').value;
    const date = document.getElementById('dateFilter').value;

    if (!eventId) {
        showNotification('Please select an event', 'warning');
        return;
    }

    try {
        const attendance = await api.get(`attendance.php?event_id=${eventId}&date=${date}`);
        const tbody = document.querySelector('#attendanceTable tbody');
        
        tbody.innerHTML = attendance.map(record => `
            <tr>
                <td>${record.member_name}</td>
                <td>${record.student_id}</td>
                <td>${record.course}</td>
                <td>
                    <span class="badge bg-${getStatusColor(record.status)}">
                        ${record.status}
                    </span>
                </td>
                <td>${record.time_in || 'N/A'}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary" onclick="editAttendance(${record.id})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteAttendance(${record.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    } catch (error) {
        showNotification('Failed to load attendance data', 'danger');
    }
}

// Get status color
function getStatusColor(status) {
    const colors = {
        present: 'success',
        absent: 'danger',
        late: 'warning'
    };
    return colors[status] || 'secondary';
}

// Edit attendance record
async function editAttendance(id) {
    try {
        const record = await api.get(`attendance.php?id=${id}`);
        
        document.getElementById('attendanceId').value = record.id;
        document.getElementById('attendanceStatus').value = record.status;
        document.getElementById('attendanceRemarks').value = record.remarks || '';
        
        const modal = new bootstrap.Modal(document.getElementById('attendanceModal'));
        modal.show();
    } catch (error) {
        showNotification('Failed to load attendance record', 'danger');
    }
}

// Update attendance record
async function updateAttendance() {
    const id = document.getElementById('attendanceId').value;
    const status = document.getElementById('attendanceStatus').value;
    const remarks = document.getElementById('attendanceRemarks').value;

    try {
        await api.put('attendance.php', { id, status, remarks });
        showNotification('Attendance updated successfully');
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('attendanceModal'));
        modal.hide();
        
        loadAttendance();
    } catch (error) {
        showNotification('Failed to update attendance', 'danger');
    }
}

// Delete attendance record
async function deleteAttendance(id) {
    if (confirm('Are you sure you want to delete this attendance record?')) {
        try {
            await api.delete('attendance.php', id);
            showNotification('Attendance record deleted successfully');
            loadAttendance();
        } catch (error) {
            showNotification('Failed to delete attendance record', 'danger');
        }
    }
}

// Initialize page
document.addEventListener('DOMContentLoaded', () => {
    loadEvents();
}); 