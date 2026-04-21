document.addEventListener('DOMContentLoaded', function () {
    // ============ DOM ELEMENTS ============
    const calendarGrid = document.getElementById('calendar-grid');
    const currentMonthYear = document.getElementById('current-month-year');
    const prevMonthButton = document.getElementById('prev-month');
    const nextMonthButton = document.getElementById('next-month');
    const prevYearButton = document.getElementById('prev-year');
    const nextYearButton = document.getElementById('next-year');

    const productTypeSection = document.querySelector('.product-type-section');
    const meetingLinkSection = document.querySelector('.meeting-link-section');
    const actionButtons = document.querySelector('.action-buttons');
    const selectedDateDisplay = document.getElementById('selected-date-display');
    const selectedDateText = document.getElementById('selected-date-text');
    const infoMessage = document.getElementById('info-message');

    const productTypeSelect = document.getElementById('product-type');
    const meetingLinkInput = document.getElementById('meeting-link');
    const saveDateBtn = document.getElementById('save-date-btn');
    const deleteDateBtn = document.getElementById('delete-date-btn');
    const clearSelectionBtn = document.getElementById('clear-selection-btn');
    const selectedDatesHidden = document.getElementById('selected-dates-hidden');
    const formActionInput = document.getElementById('form-action');
    const dateForm = document.getElementById('date-selection-form');

    // ============ STATE VARIABLES ============
    let currentDate = new Date();
    let currentSelectedDate = null;
    let currentSelectedDateFormatted = null;
    let selectedDates = new Set(savedDates || []);

    // ============ CALENDAR RENDERING ============
    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const today = new Date();

        currentMonthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;
        calendarGrid.innerHTML = '';

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add empty cells before month starts
        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-day');
            calendarGrid.appendChild(emptyCell);
        }

        // Add day cells
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const dateString = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

            const dayElement = document.createElement('div');
            dayElement.classList.add('calendar-day');
            dayElement.textContent = day;
            dayElement.dataset.date = dateString;

            // Check if date is in past
            const todayWithoutTime = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            const dayWithoutTime = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            if (dayWithoutTime < todayWithoutTime) {
                dayElement.classList.add('disabled');
                dayElement.style.cursor = 'not-allowed';
            } else {
                dayElement.style.cursor = 'pointer';
                dayElement.addEventListener('click', () => handleDateClick(dayElement, dateString));

                // Highlight saved dates
                if (selectedDates.has(dateString)) {
                    dayElement.classList.add('selected');
                    dayElement.title = 'Saved date - click to edit or delete';
                }
            }

            calendarGrid.appendChild(dayElement);
        }
    }

    // ============ HANDLE DATE CLICK ============
    function handleDateClick(dayElement, dateString) {
        currentSelectedDate = dateString;
        currentSelectedDateFormatted = formatDateForDisplay(dateString);

        // Show selected date display
        selectedDateText.textContent = currentSelectedDateFormatted;
        selectedDateDisplay.style.display = 'block';

        // Check if date is already saved
        if (selectedDates.has(dateString)) {
            // Show saved data
            showSavedDateFields(dateString);
        } else {
            // Show blank fields for new date
            showNewDateFields();
        }
    }

    // ============ FORMAT DATE FOR DISPLAY ============
    function formatDateForDisplay(dateString) {
        const [year, month, day] = dateString.split('-');
        const date = new Date(year, month - 1, day);
        return date.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    // ============ SHOW SAVED DATE FIELDS ============
    function showSavedDateFields(dateString) {
        // Convert Y-m-d format to d-m-Y for database lookup
        const [year, month, day] = dateString.split('-');
        const readableDateFormat = `${day}-${month}-${year}`;

        // Build fetch URL - use the route provided by Blade
        let fetchUrl;
        if (typeof getPreferredDateDetailsUrl !== 'undefined') {
            fetchUrl = getPreferredDateDetailsUrl + '?date=' + encodeURIComponent(readableDateFormat);
        } else {
            // Fallback
            fetchUrl = '/admin/get-preferred-date-details?date=' + encodeURIComponent(readableDateFormat);
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log('=== FETCH REQUEST DEBUG ===');
        console.log('Date String (Y-m-d):', dateString);
        console.log('Readable Format (d-m-Y):', readableDateFormat);
        console.log('Fetch URL:', fetchUrl);
        console.log('CSRF Token:', csrfToken);
        console.log('==========================');

        fetch(fetchUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin'
        })
            .then(response => {
                console.log('=== RESPONSE DEBUG ===');
                console.log('Status:', response.status);
                console.log('Status Text:', response.statusText);
                console.log('OK:', response.ok);
                console.log('=====================');

                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Error Response Text:', text);
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('=== RECEIVED DATA ===');
                console.log('Success:', data.success);
                console.log('Full Data:', data);
                console.log('====================');

                if (data.success && data.data) {
                    // Set product type using the ID returned from backend
                    if (data.data.product_type_id) {
                        productTypeSelect.value = data.data.product_type_id;
                        console.log('✅ Set product type ID:', data.data.product_type_id);
                    } else {
                        // Fallback: find by name
                        console.warn('⚠️ No product_type_id, searching by name:', data.data.product_type);
                        const options = productTypeSelect.querySelectorAll('option');
                        let found = false;
                        for (let option of options) {
                            if (option.textContent.trim() === data.data.product_type.trim()) {
                                productTypeSelect.value = option.value;
                                console.log('✅ Set product type by name match:', option.value);
                                found = true;
                                break;
                            }
                        }
                        if (!found) {
                            console.error('❌ Could not find matching product type');
                        }
                    }

                    // Set meeting link
                    meetingLinkInput.value = data.data.meeting_link || '';
                    console.log('✅ Set meeting link:', data.data.meeting_link);

                    // Show all sections
                    productTypeSection.style.display = 'block';
                    meetingLinkSection.style.display = 'block';
                    actionButtons.style.display = 'block';

                    // Show info message
                    if (infoMessage) {
                        infoMessage.style.display = 'block';
                        infoMessage.innerHTML = '✏️ You can edit or delete this date.';
                        infoMessage.className = 'alert alert-info';
                    }

                    console.log('✅ All fields populated successfully');
                } else {
                    console.warn('⚠️ No saved data found or invalid response structure');
                    showNewDateFields();
                }
            })
            .catch(error => {
                console.error('=== FETCH ERROR ===');
                console.error('Error Name:', error.name);
                console.error('Error Message:', error.message);
                console.error('Error Stack:', error.stack);
                console.error('==================');

                alert('Error loading saved date details: ' + error.message + '\n\nPlease check the browser console for more details.');
                showNewDateFields();
            });
    }

    // ============ SHOW NEW DATE FIELDS ============
    function showNewDateFields() {
        console.log('📝 Showing new date fields (no saved data)');

        // Clear fields
        productTypeSelect.value = '';
        meetingLinkInput.value = '';

        // Show product type section
        productTypeSection.style.display = 'block';

        // Hide meeting link and buttons initially
        meetingLinkSection.style.display = 'none';
        actionButtons.style.display = 'none';

        // Show info message
        if (infoMessage) {
            infoMessage.style.display = 'block';
            infoMessage.textContent = '📅 Select product type and add meeting link below.';
            infoMessage.className = 'alert alert-info';
        }
    }

    // ============ PRODUCT TYPE CHANGE ============
    productTypeSelect.addEventListener('change', function () {
        console.log('Product type changed to:', this.value);

        if (this.value && currentSelectedDate) {
            meetingLinkSection.style.display = 'block';

            // If meeting link already has value, show buttons
            if (meetingLinkInput.value.trim()) {
                actionButtons.style.display = 'block';
            }

            if (infoMessage) {
                infoMessage.style.display = 'none';
            }
        } else {
            meetingLinkSection.style.display = 'none';
            actionButtons.style.display = 'none';
        }
    });

    // ============ MEETING LINK INPUT ============
    meetingLinkInput.addEventListener('input', function () {
        console.log('Meeting link changed to:', this.value);

        if (this.value.trim() && productTypeSelect.value && currentSelectedDate) {
            actionButtons.style.display = 'block';
            if (infoMessage) {
                infoMessage.style.display = 'none';
            }
        } else {
            actionButtons.style.display = 'none';
        }
    });

    // ============ SAVE DATE ============
    saveDateBtn.addEventListener('click', function () {
        if (!currentSelectedDate) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please select a date first.');
            } else {
                alert('Please select a date first.');
            }
            return;
        }

        if (!productTypeSelect.value) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please select a product type.');
            } else {
                alert('Please select a product type.');
            }
            return;
        }

        if (!meetingLinkInput.value.trim()) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please enter a meeting link.');
            } else {
                alert('Please enter a meeting link.');
            }
            return;
        }

        // Validate URL format
        try {
            new URL(meetingLinkInput.value);
        } catch (error) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please enter a valid meeting link (e.g., https://www.google.com).');
            } else {
                alert('Please enter a valid meeting link (e.g., https://www.google.com).');
            }
            return;
        }

        // Prepare form data
        selectedDatesHidden.value = JSON.stringify([currentSelectedDate]);
        formActionInput.value = 'save';

        console.log('💾 Submitting save form with date:', currentSelectedDate);

        // Submit form
        dateForm.submit();
    });

    // ============ DELETE DATE ============
    deleteDateBtn.addEventListener('click', function () {
        if (!currentSelectedDate) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please select a date first.');
            } else {
                alert('Please select a date first.');
            }
            return;
        }

        if (!selectedDates.has(currentSelectedDate)) {
            if (typeof toastr !== 'undefined') {
                toastr.error('This date is not saved.');
            } else {
                alert('This date is not saved.');
            }
            return;
        }

        if (confirm(`Are you sure you want to delete ${currentSelectedDateFormatted} and all its details?`)) {
            selectedDatesHidden.value = JSON.stringify([currentSelectedDate]);
            formActionInput.value = 'delete';

            console.log('🗑️ Submitting delete form for date:', currentSelectedDate);

            dateForm.submit();
        }
    });

    // ============ CLEAR SELECTION ============
    clearSelectionBtn.addEventListener('click', function () {
        console.log('🧹 Clearing selection');

        currentSelectedDate = null;
        currentSelectedDateFormatted = null;

        selectedDateDisplay.style.display = 'none';
        productTypeSection.style.display = 'none';
        meetingLinkSection.style.display = 'none';
        actionButtons.style.display = 'none';

        if (infoMessage) {
            infoMessage.style.display = 'none';
        }

        productTypeSelect.value = '';
        meetingLinkInput.value = '';

        if (typeof toastr !== 'undefined') {
            toastr.info('Selection cleared.');
        }
    });

    // ============ CALENDAR NAVIGATION ============
    prevMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    prevYearButton.addEventListener('click', () => {
        currentDate.setFullYear(currentDate.getFullYear() - 1);
        renderCalendar();
    });

    nextYearButton.addEventListener('click', () => {
        currentDate.setFullYear(currentDate.getFullYear() + 1);
        renderCalendar();
    });

    // ============ INITIALIZATION ============
    console.log('🚀 Calendar initialized');
    console.log('Saved dates from backend:', Array.from(selectedDates));
    console.log('Route URLs:', {
        save: adminPreferredDatesUrl,
        get: getPreferredDateDetailsUrl
    });
    renderCalendar();
});