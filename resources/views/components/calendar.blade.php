<div class="flex min-h-full overflow-hidden" >
    <!-- Calendar Section -->
    <div id="calendar" class="w-1/4 p-4 bg-white dark:bg-gray-700" style="max-width: 360px">
        <h2 id="monthYear" class="text-lg font-semibold mb-4 dark:text-white"></h2>
        <!-- Calendar content will be dynamically generated here -->
        <div id="calendarGrid" class="grid grid-cols-7 gap-2 dark:text-gray-100">
            <!-- Calendar cells will be added dynamically here -->
        </div>
        <div class="mt-4 flex flex-row justify-between my-4">
            <button id="prevBtn" class="py-2 px-4 bg-blue-500 text-white rounded-md">Previous</button>
            <button id="nextBtn" class="py-2 px-4 bg-blue-500 text-white rounded-md ml-2">Next</button>
            <button id="todayBtn" class="py-2 px-4 bg-blue-500 text-white rounded-md ml-2">Today</button>
        </div>
        @include('task.addtask')
    </div>
    <a></a>
    <!-- Task List Section -->
    <div id="taskList" class="flex-1 p-4 bg-gray-200 dark:bg-gray-800 overflow-y-auto">
        <!-- Fetched task list content will be displayed here -->
        <h2 class="text-lg font-semibold mb-4">No Tasks for the Day</h2>
        <!-- Remaining content or component here -->
    </div>
</div>

<script>
    // Declare currentMonth, currentYear, and selectedDay outside the function for global access
    let currentMonth;
    let currentYear;
    let selectedDay;

    function fetchTasks() {
        const currentDate = new Date();
        const formattedDate =
            `${currentYear}-${currentMonth.toString().padStart(2, '0')}-${selectedDay.toString().padStart(2, '0')}`;

        fetch(`/tasks/${formattedDate}`)
            .then(response => response.json())
            .then(data => {
                // Update the task list content
                const taskListContainer = document.getElementById('taskList');
                taskListContainer.innerHTML = ''; // Clear existing content
                
                if (data.tasks.length > 0) {
                    console.log(data.tasks);
                    data.tasks.forEach(task => {
                        // Create a task card based on the Blade template
                        const taskCard = document.createElement('div');
                        taskCard.innerHTML = `
                        <div name="${task.type}" class="task-card overflow-hidden h-24 bg-white p-4 mb-2 rounded-lg border-1 shadow "
                            id="${task.id}">
                            <div class="flex flex-row">
                            ${task.type === 'Simple Task'?
                                `
                                    <h2 class="w-full">${task.title}</h2>
                                    
                                `
                            :
                                `<h2 class="w-full">${task.title}</h2>
                                `
                            }
                            ${task.status === 'To-Do'?
                                `
                                <form method="POST" action="/update-task-status/${task.id}">
                                <input type="hidden" name="taskId" value="${task.id}">
                                <input type="hidden" name="newStatus" value="Done">
                                @csrf
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg h-3.5 w-3.5 mr-2" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                    </svg>
                                </button>
                            </form>
                                    
                                `
                            :
                                `
                                `
                            }
                            
                            </div>
                            <p class="truncate h-8" id="${task.type}"> ${task.description} </p>
                        </div>

                        `;

                        // Append the task card to the task list container
                        taskListContainer.appendChild(taskCard);
                    });
                } else {
                    const noTasksMessage = document.createElement('div');
                    noTasksMessage.textContent = 'No tasks for the selected day.';
                    taskListContainer.appendChild(noTasksMessage);
                }
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    // Function to generate and update the calendar
    function generateCalendar() {
        const calendarContainer = document.getElementById('calendar');
        const calendarGrid = document.getElementById('calendarGrid');
        const monthYearElement = document.getElementById('monthYear');

        // Clear existing content
        calendarGrid.innerHTML = '';

        // Set the month and year in the header
        monthYearElement.textContent = `${getMonthName(currentMonth)} ${currentYear}`;

        // Create the grid for the calendar
        const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Weekday headers
        weekdays.forEach(weekday => {
            const header = document.createElement('div');
            header.classList.add('text-center', 'text-gray-500');
            header.textContent = weekday;
            calendarGrid.appendChild(header);
        });

        // Days in the month
        const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('text-center', 'cursor-pointer', 'py-2', 'relative');
            dayCell.textContent = day;

            // Highlight the selected day
            if (day === selectedDay) {
                dayCell.classList.add('bg-blue-500', 'text-white', 'rounded-full');
            }

            // Add event listener to update the selected day
            dayCell.addEventListener('click', () => {
                selectedDay = day;
                generateCalendar();
            });

            calendarGrid.appendChild(dayCell);
        }

        console.log(`${selectedDay}/${currentMonth}/${currentYear}`);
        fetchTasks();
    }

    // Function to get the name of the month
    function getMonthName(month) {
        const options = {
            month: 'long'
        };
        return new Intl.DateTimeFormat('en-US', options).format(new Date(2000, month - 1, 1));
    }

    // Function to update the calendar for the next month
    function nextMonth() {
        if (currentMonth == 12) {
            currentYear++;
        }
        currentMonth = (currentMonth % 12) + 1;

        generateCalendar();
    }

    // Function to update the calendar for the previous month
    function prevMonth() {
        if (currentMonth == 1) {
            currentYear--;
        }
        currentMonth = ((currentMonth - 2 + 12) % 12) + 1;

        generateCalendar();
    }

    // Function to update the calendar to the current month
    function today() {
        const currentDate = new Date();
        currentMonth = currentDate.getMonth() + 1;
        currentYear = new Date().getFullYear();
        selectedDay = currentDate.getDate();
        generateCalendar();
    }

    // Event listeners for navigation buttons
    document.getElementById('prevBtn').addEventListener('click', prevMonth);
    document.getElementById('nextBtn').addEventListener('click', nextMonth);

    // Event listener for the "Today" button
    document.getElementById('todayBtn').addEventListener('click', today);

    // Initialize currentMonth and selectedDay, and call the function to generate the initial calendar
    currentMonth = new Date().getMonth() + 1;
    currentYear = new Date().getFullYear();
    selectedDay = new Date().getDate();
    generateCalendar();
</script>


</body>

</html>
