@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<style>

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
      height: 40px;
      width: calc(100% / 8);
    }
    .schedule-table th {
      background-color: #f8f9fa;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    .time-cell {
      width: 80px;
      font-weight: bold;
      background-color: #f8f9fa;
    }
    .schedule-cell {
      position: relative;
      vertical-align: top;
      cursor: pointer;
    }
    .schedule-cell:hover {
      background-color: #f1f3f5;
    }
    .event {
      color: white;
      border-radius: 3px;
      padding: 2px 4px;
      margin-bottom: 2px;
      font-size: 12px;
      overflow: hidden;
      position: absolute;
      left: 0;
      right: 0;
      z-index: 5;
    }
</style>



<div class="schedule-container">
  <div class="table-responsive card">
    <table class="schedule-table" id="scheduleTable">
      <thead>
        <tr id="dateHeader">
          <th>Time</th>
          <th>Saturday</th>
          <th>Sunday</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
        </tr>
      </thead>
      <tbody id="scheduleBody">
        <!-- Time slots will be inserted here -->
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="eventForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="duration" class="form-label">Duration (in hours)</label>
          <select id="duration" class="form-select" required>
            <option value="1">1 hour</option>
            <option value="1.5">1.5 hours</option>
            <option value="2">2 hours</option>
          </select>
        </div>
        <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
            <label for="teacher_id" class="form-label">{{ __('Teacher') }}</label>
            <div class="custom-select-container">
                <select class="form-select custom-select" id="teacher_id" name="teacher_id" data-v="required" required>
                    <option value="">{{ __('Select Teacher') }}</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
          <label for="edit_model_id" class="form-label">{{ __('Model') }}</label>
          <div class="custom-select-container">
              <select class="form-select custom-select" id="model_id" name="model_id" data-v="required" required>
                  <option value="">{{ __('Select Model') }}</option>
              </select>
          </div>
        </div>
        <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
          <label for="room_id" class="form-label">{{ __('Room') }}</label>
          <div class="custom-select-container">
              <select class="form-select custom-select" id="room_id" name="room_id" data-v="required" required>
                  <option value="">{{ __('Select Room') }}</option>
              </select>
          </div>
        </div>
        <div class="mb-3">
          <label for="eventColor" class="form-label">Color</label>
          <input type="color" id="eventColor" class="form-control form-control-color" value="#3788d8" required>
        </div>
        <input type="hidden" id="selectedDay">
        <input type="hidden" id="selectedTime">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Event</button>
      </div>
    </form>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    const events = [];
    
    function formatTime(hours, minutes) {
      return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
    }
    
    // Generate time slots from 8:00 AM to 8:00 PM
    function generateTimeSlots() {
      const tbody = document.getElementById('scheduleBody');
      tbody.innerHTML = '';
      
      for (let hour = 8; hour < 20; hour++) {
        for (let minute of [0, 30]) {
          const tr = document.createElement('tr');
          const timeCell = document.createElement('td');
          timeCell.className = 'time-cell';
          timeCell.textContent = formatTime(hour, minute);
          tr.appendChild(timeCell);
          
          // Add cells for each day (Sat to Fri)
          for (let day = 0; day < 7; day++) {
            const cell = document.createElement('td');
            cell.className = 'schedule-cell';
            cell.id = `cell-${day}-${hour}-${minute}`;
            
            cell.addEventListener('click', function() {
              document.getElementById('selectedDay').value = day;
              document.getElementById('selectedTime').value = `${hour}:${minute}`;
              modal.show();
            });
            
            tr.appendChild(cell);
          }
          
          tbody.appendChild(tr);
        }
      }
    }
    
    // Calculate how many 30-minute slots an event covers
    function calculateSlotSpan(duration) {
      return Math.ceil(duration * 2) + 1; // 1 hour = 3 slots, 1.5 hours = 4 slots,2 hours = 5 slots, 2.5 hours = 6 slots etc.
    }
    
    // Get position of a time slot
    function getSlotPosition(hour, minute) {
      const cell = document.getElementById(`cell-0-${hour}-${minute}`);
      if (!cell) return null;
      const rect = cell.getBoundingClientRect();
      return { top: rect.top, height: rect.height };
    }
    
    // Display events on the schedule
    function displayEvents() {
      // Clear existing events
      document.querySelectorAll('.event').forEach(el => el.remove());
      
      // Display each event
      events.forEach(event => {
        const day = event.day;
        const [startHour, startMinute] = event.startTime.split(':').map(Number);
        const slotSpan = calculateSlotSpan(event.duration);
        
        // Find the start cell
        const startCell = document.getElementById(`cell-${day}-${startHour}-${startMinute}`);
        
        if (startCell) {
          const eventEl = document.createElement('div');
          eventEl.className = 'event';
          eventEl.textContent = `${event.model} - ${event.teacher} - ${event.room}`;
          eventEl.style.backgroundColor = event.color;
          
          // Calculate height based on duration
          const cellHeight = startCell.offsetHeight;
          eventEl.style.height = `${cellHeight * slotSpan - 2}px`;
          
          startCell.appendChild(eventEl);
        }
      });
    }
    
    // Handle form submission
    document.getElementById('eventForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const duration = parseFloat(document.getElementById('duration').value);
      const teacher = document.getElementById('teacher_id').selectedOptions[0].textContent;
      const model = document.getElementById('model_id').selectedOptions[0].textContent;
      const room = document.getElementById('room_id').selectedOptions[0].textContent;
      const color = document.getElementById('eventColor').value;
      const day = document.getElementById('selectedDay').value;
      const startTime = document.getElementById('selectedTime').value;
      
      events.push({
        title: `${model} - ${teacher} - ${room}`,
        model: model,
        teacher: teacher,
        room: room,
        day: parseInt(day),
        startTime: startTime,
        duration: duration,
        color: color
      });
      
      displayEvents();
      modal.hide();
      e.target.reset();
      document.getElementById('eventColor').value = '#3788d8';
    });
    
    // Initialize the schedule
    generateTimeSlots();
  });

  $(document).ready(function() {
    new SearchableSelect({
        selectId: 'teacher_id',
        url: '/teacher/all',
        method: 'GET',
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        renderOption: (option) => `
            <div class="d-flex align-items-center">
                <span>${option.name}</span>
            </div>
        `
    });

    // new SearchableSelect({
    //     selectId: 'edit_teacher_id',
    //     url: '/teacher/all',
    //     method: 'GET',
    //     csrfToken: document.querySelector('meta[name="csrf-token"]').content,
    //     renderOption: (option) => `
    //         <div class="d-flex align-items-center">
    //             <span>${option.name}</span>
    //         </div>
    //     `
    // });

    new SearchableSelect({
        selectId: 'model_id',
        url: '/model/all',
        method: 'GET',
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        renderOption: (option) => `
            <div class="d-flex align-items-center">
                <span>${option.name}</span>
            </div>
        `
    });

    // new SearchableSelect({
    //     selectId: 'edit_model_id',
    //     url: '/model/all',
    //     method: 'GET',
    //     csrfToken: document.querySelector('meta[name="csrf-token"]').content,
    //     renderOption: (option) => `
    //         <div class="d-flex align-items-center">
    //             <span>${option.name}</span>
    //         </div>
    //     `
    // });

    new SearchableSelect({
        selectId: 'room_id',
        url: '/room/all',
        method: 'GET',
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        renderOption: (option) => `
            <div class="d-flex align-items-center">
                <span>${option.name}</span>
            </div>
        `
    });

    // new SearchableSelect({
    //     selectId: 'edit_room_id',
    //     url: '/room/all',
    //     method: 'GET',
    //     csrfToken: document.querySelector('meta[name="csrf-token"]').content,
    //     renderOption: (option) => `
    //         <div class="d-flex align-items-center">
    //             <span>${option.name}</span>
    //         </div>
    //     `
    // });

  });
</script>


@endsection
