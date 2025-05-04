@extends('layouts.app')

@section('title', __('Specialty Settings'))

@section('content')
<div class="card p-4">
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link" href="{{ route('specialty.get', $specialty->id) }}"><span class="mdi mdi-cog-outline me-2"></span>{{ __('Edit Specialty') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('specialty.courses', $specialty->id) }}"><span class="mdi mdi-key-outline me-2"></span>{{ __('Courses') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('specialty.groups', $specialty->id) }}"><span class="mdi mdi-key-outline me-2"></span>{{ __('Groups') }}</a></li>
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><span class="mdi mdi-key-outline me-2"></span>{{ __('Table') }}</a></li>
    </ul>

    <div class="table-responsive card">
        <table class="schedule-table" id="scheduleTable">
            <thead>
                <tr>
                    <th rowspan="2">Day</th>
                    <th colspan="6" class="shift-header">Time Slots</th>
                </tr>
                <tr>
                    <!-- Time slots -->
                    <th>8:30-10:00</th>
                    <th>10:10-11:40</th>
                    <th>11:50-13:20</th>
                    <th>13:30-15:00</th>
                    <th>15:10-16:40</th>
                    <th>16:50-18:20</th>
                </tr>
            </thead>
            <tbody id="scheduleBody">
                <!-- Days will be inserted here -->
            </tbody>
        </table>
    </div>
    
    <!-- Bootstrap Modal -->
  <!-- Add Event Modal -->
  <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="eventForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- <div class="mb-3">
                    <label for="eventTitle" class="form-label">Event Title</label>
                    <input type="text" id="eventTitle" class="form-control" required>
                </div> --}}
                <div class="form-group form-group-floating mb-3">
                    <label for="course_id" class="form-label">{{ __('Course') }}</label>
                    <div class="custom-select-container">
                        <select class="form-select custom-select" id="course_id" name="course_id" required>
                            <option value="">{{ __('Select Course') }}</option>
                            @foreach($courses as $course) 
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group form-group-floating mb-3">
                    <label for="teacher_id" class="form-label">{{ __('Teacher') }}</label>
                    <div class="custom-select-container">
                        <select class="form-select custom-select" id="teacher_id" name="teacher_id" required>
                            <option value="">{{ __('Select Teacher') }}</option>
                            @foreach($teachers as $teacher) 
                                <option value="{{ $teacher->id }}">{{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group form-group-floating mb-3">
                    <label for="structure_id" class="form-label">{{ __('Structure') }}</label>
                    <div class="custom-select-container">
                        <select class="form-select custom-select" id="structure_id" name="structure_id" required>
                            <option value="">{{ __('Select Structure') }}</option>
                            @foreach($structures as $structure) 
                                <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group form-group-floating mb-3">
                    <label for="group_id" class="form-label">{{ __('Group') }}</label>
                    <div class="custom-select-container">
                        <select class="form-select custom-select" id="group_id" name="group_id" required>
                            <option value="">{{ __('Select Group') }}</option>
                            @foreach($groups as $group) 
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                            <option value="All">All Groups</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-group-floating mb-3">
                  <label for="sessions" class="form-label">{{ __('Sessions') }}</label>
                  <div class="custom-select-container">
                      <select class="form-select custom-select" id="sessions" name="sessions" required>
                          <option value="1">1 Session (1.5 hours)</option>
                          <option value="2">2 Sessions (3 hours)</option>
                      </select>
                  </div>
                </div>
                <div class="mb-3">
                    <label for="eventColor" class="form-label">Color</label>
                    <input type="color" id="eventColor" class="form-control form-control-color w-100" value="#3788d8" required>
                </div>
                <input type="hidden" id="selectedDay">
                <input type="hidden" id="selectedSlot">
                <!-- CSRF token for AJAX -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Event</button>
            </div>
        </form>
    </div>
  </div>


  <!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <form id="editEventForm" class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edit Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" id="editEventId">
              {{-- <div class="mb-3">
                  <label for="editEventTitle" class="form-label">Event Title</label>
                  <input type="text" id="editEventTitle" class="form-control" required>
              </div> --}}
              <div class="form-group form-group-floating mb-3">
                  <label for="editCourse_id" class="form-label">{{ __('Course') }}</label>
                  <div class="custom-select-container">
                      <select class="form-select custom-select" id="editCourse_id" name="editCourse_id" required>
                          <option value="">{{ __('Select Course') }}</option>
                          @foreach($courses as $course) 
                              <option value="{{ $course->id }}">{{ $course->name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="form-group form-group-floating mb-3">
                  <label for="editTeacher_id" class="form-label">{{ __('Teacher') }}</label>
                  <div class="custom-select-container">
                      <select class="form-select custom-select" id="editTeacher_id" name="editTeacher_id" required>
                          <option value="">{{ __('Select Teacher') }}</option>
                          @foreach($teachers as $teacher) 
                            <option value="{{ $teacher->id }}">{{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="form-group form-group-floating mb-3">
                  <label for="editStructure_id" class="form-label">{{ __('Structure') }}</label>
                  <div class="custom-select-container">
                      <select class="form-select custom-select" id="editStructure_id" name="editStructure_id" required>
                          <option value="">{{ __('Select Structure') }}</option>
                          @foreach($structures as $structure) 
                            <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="form-group form-group-floating mb-3">
                  <label for="editGroup_id" class="form-label">{{ __('Group') }}</label>
                  <div class="custom-select-container">
                      <select class="form-select custom-select" id="editGroup_id" name="editGroup_id" required>
                          <option value="">{{ __('Select Group') }}</option>
                          @foreach($groups as $group) 
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                          @endforeach
                          <option value="All">All Groups</option>
                      </select>
                  </div>
              </div>
              <div class="form-group form-group-floating mb-3">
                  <label for="editSessions" class="form-label">{{ __('Sessions') }}</label>
                  <div class="custom-select-container">
                      <select class="form-select custom-select" id="editSessions" name="editSessions" required>
                          <option value="1">1 Session (1.5 hours)</option>
                          <option value="2">2 Sessions (3 hours)</option>
                      </select>
                  </div>
              </div>
              <div class="mb-3">
                  <label for="editEventColor" class="form-label">Color</label>
                  <input type="color" id="editEventColor" class="form-control form-control-color w-100" value="#3788d8" required>
              </div>
              <input type="hidden" id="editSelectedDay">
              <input type="hidden" id="editSelectedSlot">
              <!-- CSRF token for AJAX -->
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </div>
          <div class="modal-footer">
              <button type="button" id="deleteEventBtn" class="btn btn-danger">Delete</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
      </form>
  </div>
</div>

<!-- Toast for notifications -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="scheduleToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto" id="toastTitle">Notification</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastMessage">
      Operation completed successfully.
    </div>
  </div>
</div>

</div>

<style>
    .nav-tabs {
        border-bottom: none;
    }
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }

    .schedule-container {
    max-width: 1200px;
    margin: 40px auto;
    overflow-x: auto;
}
.schedule-table {
    width: 100%;
    border-collapse: collapse;
}
.schedule-table th, .schedule-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    height: 80px; /* Increased height */
}
.schedule-table th {
    background-color: #f8f9fa;
    position: sticky;
    top: 0;
    z-index: 10;
}
.shift-header {
    background-color: #e9ecef;
}
.day-cell {
    font-weight: bold;
    background-color: #f8f9fa;
    width: 120px;
}
.schedule-cell {
    position: relative;
    vertical-align: top;
    cursor: pointer;
    min-width: 140px;
    padding: 4px;
}
.schedule-cell:hover {
    background-color: #f1f3f5;
}

/* Event styles */
.event-container {
    display: flex;
    flex-direction: column;
    gap: 4px;
    height: 100%;
}
.event {
    color: white;
    border-radius: 3px;
    padding: 4px;
    font-size: 11px;
    line-height: 1.1;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    height: 100%;
}
.event-title {
    font-weight: bold;
    margin-bottom: 1px;
}
.event-details {
    display: flex;
    justify-content: space-between;
    font-size: 10px;
}
.event-duration {
    font-size: 9px;
    font-style: italic;
    margin-top: 2px;
}

/* Hover effect for events */
.event-hover {
    transform: scale(1.05);
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    z-index: 100;
}

/* Double-session events */
.event-double {
    position: absolute;
    width: 190%;
    z-index: 10;
    height: 80%;
}

/* Loading indicator */
.spinner-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    visibility: hidden;
    opacity: 0;
    transition: all 0.3s;
}

.spinner-overlay.show {
    visibility: visible;
    opacity: 1;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}
</style>

<!-- Loading spinner overlay -->
<div class="spinner-overlay" id="loadingSpinner">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editEventModal'));
    const toast = new bootstrap.Toast(document.getElementById('scheduleToast'));
    const toastTitle = document.getElementById('toastTitle');
    const toastMessage = document.getElementById('toastMessage');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const speacilty_id = {{ $specialty->id }};
    let events = [];

    // Time slots configuration
    const timeSlots = [
        { code: 'TS1', display: '8:00-9:30' },
        { code: 'TS2', display: '9:40-11:10' },
        { code: 'TS3', display: '11:20-12:50' },
        { code: 'TS4', display: '13:00-14:30' },
        { code: 'TS5', display: '14:40-16:10' },
        { code: 'TS6', display: '16:20-17:50' }
    ];

    // Days configuration
    const days = [
        { id: 'SAT', name: 'Saturday', name_ar: 'السبت' },
        { id: 'SUN', name: 'Sunday', name_ar: 'الأحد' },
        { id: 'MON', name: 'Monday', name_ar: 'الإثنين' },
        { id: 'TUE', name: 'Tuesday', name_ar: 'الثلاثاء' },
        { id: 'WED', name: 'Wednesday', name_ar: 'الأربعاء' },
        { id: 'THU', name: 'Thursday', name_ar: 'الخميس' },
    ];

    // Show loading spinner
    function showLoading() {
        loadingSpinner.classList.add('show');
    }

    // Hide loading spinner
    function hideLoading() {
        loadingSpinner.classList.remove('show');
    }

    // Show toast notification
    function showToast(title, message, type = 'success') {
        toastTitle.textContent = title;
        toastMessage.textContent = message;
        
        // Change toast color based on type
        const toastEl = document.getElementById('scheduleToast');
        toastEl.className = 'toast';
        if (type === 'success') {
            toastEl.classList.add('bg-success', 'text-white');
        } else if (type === 'error') {
            toastEl.classList.add('bg-danger', 'text-white');
        } else if (type === 'warning') {
            toastEl.classList.add('bg-warning');
        }
        
        toast.show();
    }

    // Generate schedule with days in rows and time slots in columns
    function generateSchedule() {
        const tbody = document.getElementById('scheduleBody');
        tbody.innerHTML = '';
        
        days.forEach(day => {
            const tr = document.createElement('tr');
            
            // Add day cell
            const dayCell = document.createElement('td');
            dayCell.className = 'day-cell';
            dayCell.textContent = day.name;
            tr.appendChild(dayCell);
            
            // Add time slot cells
            timeSlots.forEach(slot => {
                const cell = document.createElement('td');
                cell.className = 'schedule-cell';
                cell.id = `cell-${day.id}-${slot.code}`;
                cell.dataset.dayId = day.id;
                cell.dataset.slotCode = slot.code;
                
                // Add event container to each cell
                const eventContainer = document.createElement('div');
                eventContainer.className = 'event-container';
                cell.appendChild(eventContainer);
                
                // Cell click handler (only triggers if the click was not on an event)
                cell.addEventListener('click', function(e) {
                    if (e.target === cell || e.target === eventContainer) {
                        document.getElementById('selectedDay').value = day.id;
                        document.getElementById('selectedSlot').value = slot.code;
                        
                        // Reset the form
                        document.getElementById('eventForm').reset();
                        document.getElementById('eventColor').value = '#3788d8';
                        
                        // Show Add Event modal
                        eventModal.show();
                    }
                });
                
                tr.appendChild(cell);
            });
            
            tbody.appendChild(tr);
        });
        
        // Load events from API
        fetchEvents();
    }

    // Find next time slot
    function getNextTimeSlot(currentSlot) {
        const slotIndex = timeSlots.findIndex(slot => slot.code === currentSlot);
        return (slotIndex < timeSlots.length - 1) ? timeSlots[slotIndex + 1].code : null;
    }

    // Display events on the schedule
    function displayEvents() {
        // Clear existing events
        document.querySelectorAll('.event-container').forEach(container => {
            container.innerHTML = '';
        });
        
        // Group events by day and slot
        const eventsByCell = {};
        events.forEach(event => {
            const cellId = `cell-${event.day}-${event.slot}`;
            if (!eventsByCell[cellId]) {
                eventsByCell[cellId] = [];
            }
            eventsByCell[cellId].push(event);
            
            // For 2-session events, we need to mark the next slot as occupied by this event
            if (event.sessions === 2 || event.sessions === '2') {
                const nextSlot = getNextTimeSlot(event.slot);
                if (nextSlot) {
                    const nextCellId = `cell-${event.day}-${nextSlot}`;
                    if (!eventsByCell[nextCellId]) {
                        eventsByCell[nextCellId] = [];
                    }
                    // Add a special flag to indicate this is a continuation
                    eventsByCell[nextCellId].push({...event, isSecondSession: true, hideInDisplay: true});
                }
            }
        });
        
        // Display events in their respective cells
        for (const [cellId, cellEvents] of Object.entries(eventsByCell)) {
            const cell = document.getElementById(cellId);
            if (cell) {
                const container = cell.querySelector('.event-container');
                
                cellEvents.forEach(event => {
                    // Skip display for continuation slots
                    if (event.hideInDisplay) {
                        return;
                    }
                    
                    const eventEl = document.createElement('div');
                    eventEl.className = 'event';
                    eventEl.dataset.eventId = event.id;
                    eventEl.style.backgroundColor = event.color;
                    
                    // For 2-session events, make them twice as tall
                    if (event.sessions === 2 || event.sessions === '2') {
                        eventEl.classList.add('event-double');
                    }
                    
                    // Structure the event content with title and details
                    // Show names instead of IDs
                    // console.log(event.course);
                    eventEl.innerHTML = `
                        <div class="event-title">${event.course.name}</div>
                        <div class="event-details">
                            <span>${event.group? event.group.name : null}</span>
                            <span>${event.structure? event.structure.name : null}</span>
                        </div>
                        <div class="event-details">
                            <span>${event.teacher? event.teacher.first_name + ' ' + event.teacher.last_name : null}</span>
                        </div>
                        ${(event.sessions > 1 || event.sessions === '2') ? '<div class="event-duration">' + event.sessions + ' sessions</div>' : ''}
                    `;
                    
                    // Add hover and click handlers
                    eventEl.addEventListener('mouseover', function() {
                        this.classList.add('event-hover');
                    });
                    
                    eventEl.addEventListener('mouseout', function() {
                        this.classList.remove('event-hover');
                    });
                    
                    eventEl.addEventListener('click', function(e) {
                        e.stopPropagation(); // Prevent cell click handler from firing
                        
                        // Find the event data
                        const eventId = this.dataset.eventId;
                        const eventData = events.find(e => e.id.toString() === eventId);
                        
                        if (eventData) {
                            // Populate edit form
                            document.getElementById('editEventId').value = eventData.id;
                            // document.getElementById('editEventTitle').value = eventData.title;
                            document.getElementById('editCourse_id').value = eventData.course_id || '';
                            document.getElementById('editTeacher_id').value = eventData.teacher_id || '';
                            document.getElementById('editStructure_id').value = eventData.structure_id || '';
                            document.getElementById('editGroup_id').value = eventData.group_id || eventData.group || '';
                            document.getElementById('editEventColor').value = eventData.color;
                            document.getElementById('editSessions').value = eventData.sessions;
                            document.getElementById('editSelectedDay').value = eventData.day;
                            document.getElementById('editSelectedSlot').value = eventData.slot;
                            
                            // Show edit modal
                            editModal.show();
                        }
                    });
                    
                    container.appendChild(eventEl);
                });
            }
        }
    }

    // Fetch events from API
    function fetchEvents() {
        showLoading();
        
        fetch(`/specialty/${speacilty_id}/events`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            events = data;
            // console.log(data);
            displayEvents();
            hideLoading();
        })
        .catch(error => {
            console.error('Error fetching events:', error);
            showToast('Error', 'Failed to load schedule events', 'error');
            hideLoading();
        });
    }

    // Save new event
    function saveEvent(eventData) {
        showLoading();
        // console.log(eventData);
        const formData = new FormData();
        for (const key in eventData) {
            formData.append(key, eventData[key]);
        }
        // formData.append('_method', 'POST');

        fetch(`/table/events`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            events.push(data);
            displayEvents();
            hideLoading();
            showToast('Success', 'Event added successfully');
        })
        .catch(error => {
            console.error('Error adding event:', error);
            showToast('Error', 'Failed to add event', 'error');
            hideLoading();
        });
    }

    // Update existing event
    function updateEvent(eventId, eventData) {
        showLoading();
        // console.log(eventData,eventId);
        const formData = new FormData();
        for (const key in eventData) {
            formData.append(key, eventData[key]);
        }
        formData.append('_method', 'PUT');
        // formData.append('teacher_id', eventData.teacher_id);

        fetch(`/table/events`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // console.log(data.data)
            // Find and update the event in the local array
            const index = events.findIndex(e => e.id == eventId);
            if (index !== -1) {
                events[index] = data.data;
            }
            displayEvents();
            hideLoading();
            showToast('Success', 'Event updated successfully');
        })
        .catch(error => {
            console.error('Error updating event:', error);
            showToast('Error', 'Failed to update event', 'error');
            hideLoading();
        });
    }

    // Delete event
    function deleteEvent(eventId) {
        showLoading();
        
        fetch(`/table/events/${eventId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Remove from local array
            events = events.filter(e => e.id != eventId);
            displayEvents();
            hideLoading();
            showToast('Success', 'Event deleted successfully');
        })
        .catch(error => {
            console.error('Error deleting event:', error);
            showToast('Error', 'Failed to delete event', 'error');
            hideLoading();
        });
    }

    // Handle add form submission
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const eventData = {
            // title: document.getElementById('eventTitle').value,
            course_id: document.getElementById('course_id').value,
            teacher_id: document.getElementById('teacher_id').value,
            structure_id: document.getElementById('structure_id').value,
            group_id: document.getElementById('group_id').value,
            day: document.getElementById('selectedDay').value,
            slot: document.getElementById('selectedSlot').value,
            color: document.getElementById('eventColor').value,
            sessions: parseInt(document.getElementById('sessions').value),
            speacilty_id: speacilty_id
        };
        
        saveEvent(eventData);
        eventModal.hide();
    });

    // Handle edit form submission
    document.getElementById('editEventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const eventId = document.getElementById('editEventId').value;
        const eventData = {
            // title: document.getElementById('editEventTitle').value,
            id: document.getElementById('editEventId').value,
            course_id: document.getElementById('editCourse_id').value,
            teacher_id: document.getElementById('editTeacher_id').value,
            structure_id: document.getElementById('editStructure_id').value,
            group_id: document.getElementById('editGroup_id').value,
            day: document.getElementById('editSelectedDay').value,
            slot: document.getElementById('editSelectedSlot').value,
            color: document.getElementById('editEventColor').value,
            sessions: parseInt(document.getElementById('editSessions').value),
            speacilty_id: speacilty_id
        };
        
        updateEvent(eventId, eventData);
        editModal.hide();
    });

    // Handle delete event
    document.getElementById('deleteEventBtn').addEventListener('click', function() {
        const eventId = document.getElementById('editEventId').value;
        
        if (confirm('Are you sure you want to delete this event?')) {
            deleteEvent(eventId);
            editModal.hide();
        }
    });

    // Initialize the schedule
    generateSchedule();
});
</script>
@endsection
