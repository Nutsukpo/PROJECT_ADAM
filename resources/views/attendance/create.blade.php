<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Clock-In/Clock-Out System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #17a2b8;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --light: #f8f9fa;
            --dark: #343a40;
        }
        
        body {
            background-color: #f5f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(45deg, var(--primary), #138496);
            color: white;
            padding: 1.2rem 1.5rem;
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .webcam-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        
        #webcam, #capturedImage {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .camera-overlay {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 2px dashed #fff;
            border-radius: 6px;
            pointer-events: none;
        }
        
        .webcam-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        
        .status-indicator {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }
        
        .status-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid var(--danger);
        }
        
        .status-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid var(--success);
        }
        
        .status-warning {
            background-color: #fff3cd;
            color: #856404;
            border-left: 4px solid var(--warning);
        }
        
        .preview-container {
            position: relative;
            display: inline-block;
        }
        
        .capture-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            opacity: 0;
            border-radius: 8px;
            animation: flash 0.5s ease-out;
        }
        
        @keyframes flash {
            0% { opacity: 0; }
            50% { opacity: 0.7; }
            100% { opacity: 0; }
        }
        
        .attendance-details {
            background-color: #e9f7fe;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary);
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #cee9f3;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--primary);
        }
        
        .btn-custom {
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .employee-info {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            display: none;
            border-left: 4px solid var(--primary);
        }
        
        .employee-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .attendance-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            background-color: var(--secondary);
            color: white;
        }
        
        .status-present {
            background-color: var(--success);
        }
        
        .status-absent {
            background-color: var(--danger);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(23, 162, 184, 0.25);
        }
        
        #captureBtn, #startCameraBtn {
            position: relative;
            overflow: hidden;
        }
        
        .instructions {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        
        .instructions ul {
            padding-left: 20px;
            margin-bottom: 0;
        }
        
        .instructions li {
            margin-bottom: 5px;
        }
        
        .attendance-history {
            margin-top: 30px;
        }
        
        .history-item {
            border-left: 4px solid var(--primary);
            padding-left: 15px;
            margin-bottom: 15px;
        }
        
        .clock-in {
            border-left-color: var(--success);
        }
        
        .clock-out {
            border-left-color: var(--danger);
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .btn-clock-in {
            background: linear-gradient(45deg, var(--success), #1e7e34);
            border: none;
        }
        
        .btn-clock-out {
            background: linear-gradient(45deg, var(--danger), #c82333);
            border: none;
        }
        
        .today-summary {
            background-color: #e9f7fe;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .time-display {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0"><i class="fas fa-user-clock me-2"></i>Smart Clock-In/Clock-Out System</h5>
                            <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="attendanceForm" action="{{ route('attendance.store') }}" method="POST">
                            @csrf
                            
                            <!-- Employee selection -->
                            <div class="mb-4">
                                <h6 class="section-title"><i class="fas fa-user me-2"></i>Employee Information</h6>
                                <div class="form-group">
                                    <label for="employee_id" class="form-label fw-semibold">Select Employee</label>
                                    <select class="form-select @error('employee_id') is-invalid @enderror"
                                            name="employee_id" id="employee_id" required>
                                        <option value="">Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                                data-firstname="{{ $employee->firstname }}"
                                                data-lastname="{{ $employee->lastname }}"
                                                data-position="{{ $employee->position }}"
                                                data-department="{{ $employee->department }}"
                                                data-image="{{ $employee->picture ?? 'https://via.placeholder.com/80' }}">
                                                {{ $employee->firstname }} {{ $employee->lastname }} - {{ $employee->department }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Employee info display -->
                                <div id="employeeInfo" class="employee-info mt-3">
                                    <div class="d-flex align-items-center">
                                        <img id="employeeImage" src="" class="employee-avatar me-3">
                                        <div>
                                            <h5 id="employeeName" class="mb-1"></h5>
                                            <p class="mb-1" id="employeePosition"></p>
                                            <p class="mb-0 text-muted" id="employeeDepartment"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Today's Summary -->
                            <div class="today-summary mb-4">
                                <h6 class="section-title"><i class="fas fa-calendar-day me-2"></i>Today's Summary</h6>
                                <div class="summary-item">
                                    <span class="detail-label">Date:</span>
                                    <span id="currentDate">{{ date('F j, Y') }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="detail-label">Current Time:</span>
                                    <span id="currentTime" class="time-display">{{ date('h:i A') }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="detail-label">Status:</span>
                                    <span id="statusBadge" class="attendance-status status-absent">Not Clocked-In</span>
                                </div>
                                <div class="summary-item" id="clockInTimeContainer">
                                    <span class="detail-label">Clock-In Time:</span>
                                    <span id="clockInTime">--:--</span>
                                </div>
                                <div class="summary-item" id="clockOutTimeContainer">
                                    <span class="detail-label">Clock-Out Time:</span>
                                    <span id="clockOutTime">--:--</span>
                                </div>
                                <div class="summary-item" id="hoursWorkedContainer">
                                    <span class="detail-label">Hours Worked:</span>
                                    <span id="hoursWorked">--:--</span>
                                </div>
                            </div>

                            <!-- Action Selection -->
                            <div class="mb-4">
                                <h6 class="section-title"><i class="fas fa-tasks me-2"></i>Select Action</h6>
                                <div class="action-buttons">
                                    <button type="button" id="clockInBtn" class="btn btn-clock-in btn-custom">
                                        <i class="fas fa-sign-in-alt me-2"></i> Clock-In
                                    </button>
                                    <button type="button" id="clockOutBtn" class="btn btn-clock-out btn-custom" disabled>
                                        <i class="fas fa-sign-out-alt me-2"></i> Clock-Out
                                    </button>
                                </div>
                                <input type="hidden" id="attendanceAction" name="action" value="">
                            </div>

                            <!-- Webcam Section -->
                            <div class="mb-4" id="webcamSection" style="display: none;">
                                <h6 class="section-title"><i class="fas fa-camera me-2"></i>Capture Image for <span id="actionType">Action</span></h6>
                                
                                <div id="webcamStatus" class="status-indicator status-warning">
                                    <i class="fas fa-info-circle me-2"></i>Webcam not started. Click "Start Camera" to begin.
                                </div>
                                
                                <div class="webcam-container mb-3">
                                    <div class="preview-container">
                                        <video id="webcam" autoplay playsinline class="d-none"></video>
                                        <div id="cameraOverlay" class="camera-overlay d-none"></div>
                                        <canvas id="canvas" class="d-none"></canvas>
                                        <img id="capturedImage" src="" class="d-none img-thumbnail">
                                        <div id="captureEffect" class="capture-effect d-none"></div>
                                    </div>
                                    
                                    <div class="webcam-controls">
                                        <button type="button" id="startCameraBtn" class="btn btn-success btn-custom">
                                            <i class="fas fa-play me-1"></i> Start Camera
                                        </button>
                                        <button type="button" id="captureBtn" class="btn btn-primary btn-custom d-none">
                                            <i class="fas fa-camera me-1"></i> Capture
                                        </button>
                                        <button type="button" id="retakeBtn" class="btn btn-warning btn-custom d-none">
                                            <i class="fas fa-redo me-1"></i> Retake
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="instructions">
                                    <p class="mb-2"><strong>Instructions:</strong></p>
                                    <ul>
                                        <li>Ensure your face is clearly visible in the camera</li>
                                        <li>Make sure there is adequate lighting</li>
                                        <li>Click capture to take your attendance photo</li>
                                        <li>Action will be recorded only after successful capture</li>
                                    </ul>
                                </div>
                                
                                <!-- Hidden input to store base64 snapshot -->
                                <input type="hidden" id="snapshot" name="snapshot">
                            </div>

                            <!-- Notes -->
                            <div class="mb-4">
                                <h6 class="section-title"><i class="fas fa-sticky-note me-2"></i>Additional Information</h6>
                                <div class="form-group">
                                    <label for="notes" class="form-label fw-semibold">Notes (Optional)</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror"
                                           name="notes" id="notes" placeholder="Add any additional notes here"
                                           rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Hidden fields for timestamps -->
                            <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                            <input type="hidden" id="clockInTimeInput" name="clock_in" value="">
                            <input type="hidden" id="clockOutTimeInput" name="clock_out" value="">
                            <input type="hidden" id="statusInput" name="status" value="absent">

                            <!-- Submit -->
                            <div class="form-group mt-4 text-center">
                                <button type="submit" id="submitBtn" class="btn btn-info btn-lg btn-custom" disabled>
                                    <i class="fas fa-save me-2"></i> Save Attendance Record
                                </button>
                            </div>
                        </form>

                        <!-- Attendance History -->
                        <div class="attendance-history mt-5">
                            <h6 class="section-title"><i class="fas fa-history me-2"></i>Today's Activity</h6>
                            <div id="activityLog">
                                <p class="text-center text-muted">No activity recorded yet today.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const webcam = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const capturedImage = document.getElementById('capturedImage');
            const captureBtn = document.getElementById('captureBtn');
            const retakeBtn = document.getElementById('retakeBtn');
            const startCameraBtn = document.getElementById('startCameraBtn');
            const snapshotInput = document.getElementById('snapshot');
            const webcamStatus = document.getElementById('webcamStatus');
            const cameraOverlay = document.getElementById('cameraOverlay');
            const captureEffect = document.getElementById('captureEffect');
            const employeeSelect = document.getElementById('employee_id');
            const employeeInfo = document.getElementById('employeeInfo');
            const employeeImage = document.getElementById('employeeImage');
            const employeeName = document.getElementById('employeeName');
            const employeePosition = document.getElementById('employeePosition');
            const employeeDepartment = document.getElementById('employeeDepartment');
            const submitBtn = document.getElementById('submitBtn');
            const currentTime = document.getElementById('currentTime');
            const statusBadge = document.getElementById('statusBadge');
            const statusInput = document.getElementById('statusInput');
            const clockInBtn = document.getElementById('clockInBtn');
            const clockOutBtn = document.getElementById('clockOutBtn');
            const webcamSection = document.getElementById('webcamSection');
            const actionType = document.getElementById('actionType');
            const attendanceAction = document.getElementById('attendanceAction');
            const clockInTime = document.getElementById('clockInTime');
            const clockOutTime = document.getElementById('clockOutTime');
            const clockInTimeInput = document.getElementById('clockInTimeInput');
            const clockOutTimeInput = document.getElementById('clockOutTimeInput');
            const hoursWorked = document.getElementById('hoursWorked');
            const activityLog = document.getElementById('activityLog');
            
            let stream = null;
            let currentAction = '';
            let clockInTimestamp = null;
            let clockOutTimestamp = null;

            // Update time every second
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-US', { 
                    hour: 'numeric', 
                    minute: '2-digit',
                    second: '2-digit', 
                    hour12: true 
                });
                currentTime.textContent = timeString;
                
                // Update hours worked if clocked in but not out
                if (clockInTimestamp && !clockOutTimestamp) {
                    updateHoursWorked();
                }
                
                return now;
            }
            
            setInterval(updateClock, 1000);
            updateClock(); // Initialize

            // Update hours worked
            function updateHoursWorked() {
                const now = new Date();
                const diffMs = now - clockInTimestamp;
                const diffHrs = Math.floor(diffMs / 3600000);
                const diffMins = Math.floor((diffMs % 3600000) / 60000);
                
                hoursWorked.textContent = `${diffHrs.toString().padStart(2, '0')}:${diffMins.toString().padStart(2, '0')}`;
            }

            // Update webcam status
            function updateWebcamStatus(message, type) {
                webcamStatus.textContent = message;
                webcamStatus.className = 'status-indicator';
                webcamStatus.classList.add(`status-${type}`);
                
                if (type === 'success') {
                    webcamStatus.innerHTML = `<i class="fas fa-check-circle me-2"></i> ${message}`;
                } else if (type === 'error') {
                    webcamStatus.innerHTML = `<i class="fas fa-exclamation-triangle me-2"></i> ${message}`;
                } else if (type === 'warning') {
                    webcamStatus.innerHTML = `<i class="fas fa-info-circle me-2"></i> ${message}`;
                }
            }

            // Update attendance status
            function updateAttendanceStatus(status) {
                if (status === 'clocked-in') {
                    statusBadge.textContent = 'Clocked-In';
                    statusBadge.classList.remove('status-absent');
                    statusBadge.classList.add('status-present');
                    statusInput.value = 'present';
                    clockInBtn.disabled = true;
                    clockOutBtn.disabled = false;
                } else if (status === 'clocked-out') {
                    statusBadge.textContent = 'Clocked-Out';
                    statusBadge.classList.remove('status-present');
                    statusBadge.classList.add('status-absent');
                    statusInput.value = 'present'; // Still present for the day
                    clockInBtn.disabled = true;
                    clockOutBtn.disabled = true;
                } else {
                    statusBadge.textContent = 'Not Clocked-In';
                    statusBadge.classList.remove('status-present');
                    statusBadge.classList.add('status-absent');
                    statusInput.value = 'absent';
                    clockInBtn.disabled = false;
                    clockOutBtn.disabled = true;
                }
            }

            // Add activity to log
            function addActivityLog(action, time) {
                const timeString = time.toLocaleTimeString('en-US', { 
                    hour: 'numeric', 
                    minute: '2-digit',
                    second: '2-digit', 
                    hour12: true 
                });
                
                if (activityLog.querySelector('.text-muted')) {
                    activityLog.innerHTML = '';
                }
                
                const activityItem = document.createElement('div');
                activityItem.className = `history-item ${action === 'clock-in' ? 'clock-in' : 'clock-out'}`;
                activityItem.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <strong>${action === 'clock-in' ? 'Clock-In' : 'Clock-Out'}</strong>
                        <span class="text-muted">${timeString}</span>
                    </div>
                    <div class="text-muted">Recorded with image capture</div>
                `;
                
                activityLog.prepend(activityItem);
            }

            // Start webcam
            async function startWebcam() {
                try {
                    updateWebcamStatus('Accessing webcam...', 'warning');
                    stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { 
                            width: { ideal: 640 },
                            height: { ideal: 480 },
                            facingMode: 'user' 
                        }, 
                        audio: false 
                    });
                    
                    webcam.srcObject = stream;
                    webcam.classList.remove('d-none');
                    cameraOverlay.classList.remove('d-none');
                    startCameraBtn.classList.add('d-none');
                    captureBtn.classList.remove('d-none');
                    
                    updateWebcamStatus(`Webcam is active. Position yourself in the frame and click Capture to ${currentAction}.`, 'success');
                    
                    // Play event listener to handle video ready state
                    webcam.onplaying = function() {
                        // Set canvas dimensions to match video
                        canvas.width = webcam.videoWidth;
                        canvas.height = webcam.videoHeight;
                    };
                } catch (err) {
                    console.error('Error accessing webcam:', err);
                    updateWebcamStatus('Unable to access webcam. Please check permissions and try again.', 'error');
                    startCameraBtn.classList.remove('d-none');
                    captureBtn.classList.add('d-none');
                }
            }

            // Capture image
            function captureImage() {
                // Show flash effect
                captureEffect.classList.remove('d-none');
                setTimeout(() => {
                    captureEffect.classList.add('d-none');
                }, 500);
                
                const context = canvas.getContext('2d');
                
                // Draw image to canvas
                context.drawImage(webcam, 0, 0, canvas.width, canvas.height);
                
                // Convert to base64 and store in hidden input
                const imageData = canvas.toDataURL('image/jpeg', 0.8);
                snapshotInput.value = imageData;
                
                // Show preview
                capturedImage.src = imageData;
                capturedImage.classList.remove('d-none');
                
                // Hide video and switch buttons
                webcam.classList.add('d-none');
                cameraOverlay.classList.add('d-none');
                captureBtn.classList.add('d-none');
                retakeBtn.classList.remove('d-none');
                
                // Set the action and timestamp
                const now = new Date();
                attendanceAction.value = currentAction;
                
                if (currentAction === 'clock-in') {
                    clockInTimestamp = now;
                    const timeString = now.toLocaleTimeString('en-US', { 
                        hour: 'numeric', 
                        minute: '2-digit',
                        hour12: true 
                    });
                    clockInTime.textContent = timeString;
                    clockInTimeInput.value = now.getHours().toString().padStart(2, '0') + ':' + 
                                           now.getMinutes().toString().padStart(2, '0');
                    updateAttendanceStatus('clocked-in');
                    addActivityLog('clock-in', now);
                } else if (currentAction === 'clock-out') {
                    clockOutTimestamp = now;
                    const timeString = now.toLocaleTimeString('en-US', { 
                        hour: 'numeric', 
                        minute: '2-digit',
                        hour12: true 
                    });
                    clockOutTime.textContent = timeString;
                    clockOutTimeInput.value = now.getHours().toString().padStart(2, '0') + ':' + 
                                            now.getMinutes().toString().padStart(2, '0');
                    updateAttendanceStatus('clocked-out');
                    addActivityLog('clock-out', now);
                    
                    // Calculate total hours worked
                    const diffMs = clockOutTimestamp - clockInTimestamp;
                    const diffHrs = Math.floor(diffMs / 3600000);
                    const diffMins = Math.floor((diffMs % 3600000) / 60000);
                    hoursWorked.textContent = `${diffHrs.toString().padStart(2, '0')}:${diffMins.toString().padStart(2, '0')}`;
                }
                
                updateWebcamStatus(`Image captured successfully for ${currentAction}. You can retake if needed.`, 'success');
                
                // Enable submit button if employee is selected
                if (employeeSelect.value) {
                    submitBtn.disabled = false;
                }
            }

            // Retake photo
            function retakePhoto() {
                webcam.classList.remove('d-none');
                cameraOverlay.classList.remove('d-none');
                capturedImage.classList.add('d-none');
                captureBtn.classList.remove('d-none');
                retakeBtn.classList.add('d-none');
                snapshotInput.value = "";
                
                updateWebcamStatus(`Webcam is active. Position yourself in the frame and click Capture to ${currentAction}.`, 'success');
                
                // Disable submit button until new capture is taken
                submitBtn.disabled = true;
            }

            // Stop webcam
            function stopWebcam() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
            }

            // Update employee info when selected
            employeeSelect.addEventListener('change', function() {
                if (this.value) {
                    const selectedOption = this.options[this.selectedIndex];
                    employeeImage.src = selectedOption.dataset.image;
                    employeeName.textContent = `${selectedOption.dataset.firstname} ${selectedOption.dataset.lastname}`;
                    employeePosition.textContent = selectedOption.dataset.position;
                    employeeDepartment.textContent = selectedOption.dataset.department;
                    employeeInfo.style.display = 'block';
                    
                    // Enable submit button if image is already captured
                    if (snapshotInput.value) {
                        submitBtn.disabled = false;
                    }
                } else {
                    employeeInfo.style.display = 'none';
                    submitBtn.disabled = true;
                }
            });

            // Clock-In button handler
            clockInBtn.addEventListener('click', function() {
                if (!employeeSelect.value) {
                    alert('Please select an employee first.');
                    return;
                }
                
                currentAction = 'clock-in';
                actionType.textContent = 'Clock-In';
                webcamSection.style.display = 'block';
                
                // Scroll to webcam section
                webcamSection.scrollIntoView({ behavior: 'smooth' });
                
                // Reset webcam if already active
                if (stream) {
                    stopWebcam();
                }
                
                updateWebcamStatus('Webcam not started. Click "Start Camera" to begin.', 'warning');
                startCameraBtn.classList.remove('d-none');
                captureBtn.classList.add('d-none');
                retakeBtn.classList.add('d-none');
                webcam.classList.add('d-none');
                cameraOverlay.classList.add('d-none');
                capturedImage.classList.add('d-none');
            });

            // Clock-Out button handler
            clockOutBtn.addEventListener('click', function() {
                currentAction = 'clock-out';
                actionType.textContent = 'Clock-Out';
                webcamSection.style.display = 'block';
                
                // Scroll to webcam section
                webcamSection.scrollIntoView({ behavior: 'smooth' });
                
                // Reset webcam if already active
                if (stream) {
                    stopWebcam();
                }
                
                updateWebcamStatus('Webcam not started. Click "Start Camera" to begin.', 'warning');
                startCameraBtn.classList.remove('d-none');
                captureBtn.classList.add('d-none');
                retakeBtn.classList.add('d-none');
                webcam.classList.add('d-none');
                cameraOverlay.classList.add('d-none');
                capturedImage.classList.add('d-none');
            });

            // Event listeners
            startCameraBtn.addEventListener('click', startWebcam);
            captureBtn.addEventListener('click', captureImage);
            retakeBtn.addEventListener('click', retakePhoto);
            
            // Clean up when leaving the page
            window.addEventListener('beforeunload', () => {
                stopWebcam();
            });
            
            // Form validation
            document.getElementById('attendanceForm').addEventListener('submit', function(e) {
                if (!snapshotInput.value) {
                    e.preventDefault();
                    updateWebcamStatus('Please capture your image before submitting.', 'error');
                    // Scroll to webcam section
                    webcamSection.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center'
                    });
                    return false;
                }
                
                if (!employeeSelect.value) {
                    e.preventDefault();
                    alert('Please select an employee before submitting.');
                    return false;
                }
                
                if (!attendanceAction.value) {
                    e.preventDefault();
                    alert('Please complete a clock-in or clock-out action before submitting.');
                    return false;
                }
            });
            
            // Initialize with a warning if webcam is not started
            updateWebcamStatus('Webcam not started. Click "Start Camera" to begin.', 'warning');
            updateAttendanceStatus('not-started');
        });
    </script>
</body>
</html>