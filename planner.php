<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Eventz LOGO AI-04.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventzPlan | Planner</title>
    <link rel="stylesheet" href="style_2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMrGLb2O3o5pIRYjx3Ghbi7p8Yk6Xnt9vdc4Vsf" crossorigin="anonymous">
    <style>
        @media (max-width: 1200px) {
            .hideOnMobile {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div id="preloader"></div>
    
    <nav class="navbar">
        <div class="logo">
            <a href="#"><img src="Eventz LOGO AI-01.png" alt="logo"></a>
        </div>
        <ul class="pcbar">
            <li class="hideOnMobile"><a href="home.php">Home</a></li>
            <li class="hideOnMobile"><a href="home.php#evetype">Event type</a></li>
            <li class="hideOnMobile"><a href="home.php#about">About</a></li>
            <li class="hideOnMobile"><a href="home.php#git">Contact</a></li>
            <li class="hideOnMobile"><a href="planner.php">Planner</a></li>
            <li onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul> 

        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="home.php#evetype">Event type</a></li>
            <li><a href="home.php#about">About</a></li>
            <li><a href="home.php#git">Contact</a></li>
            <li><a href="planner.php">Planner</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>

    <script>
        function showSidebar(){
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex';
        }
        function hideSidebar(){
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none';
        }

        function updateSelectBackground(selectElement) {
            const status = selectElement.value;
            if (status === 'in-progress') {
                selectElement.style.backgroundColor = '#f44336';  
            } else if (status === 'ongoing') {
                selectElement.style.backgroundColor = '#ffeb3b';  
            } else if (status === 'complete') {
                selectElement.style.backgroundColor = '#4caf50';  
            }
        }

        function toggleOtherEventType() {
            const eventType = document.getElementById('event-type').value;
            const otherEventTypeInput = document.getElementById('other-event-type');
            otherEventTypeInput.style.display = eventType === 'other' ? 'block' : 'none';
        }
    </script>

    <h1>EVENTZPLANNER</h1>
    <h2>Start Planning Your Event</h2>
    <form id="event-form">
        <input type="text" id="event-name" placeholder="Event Name" required>
        <input type="date" id="event-date" required>
        <input type="text" id="event-location" placeholder="Event Location" required>
        <input type="time" id="event-time" required>
        <select id="event-status" required>
            <option value="in-progress">In-Progress</option>
        </select>
        <select id="event-type" required onchange="toggleOtherEventType()">
            <option value="party">Party</option>
            <option value="special-occasion">Special Occasion</option>
            <option value="event">Event</option>
            <option value="other">Other</option>
        </select>
        <input type="text" id="other-event-type" placeholder="Specify Event Type" style="display: none;">
        <button type="submit">ADD EVENT</button>
    </form>
    
    <div style="margin-top: 20px; margin-bottom: 20px; text-align: center;">
        <div style="position: relative; width: 80%; max-width: 400px; margin: 0 auto;">
            <i class="fas fa-search" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #aaa; font-size: 18px;"></i>
            <input type="text" id="search-bar" placeholder="Search Events..." oninput="filterEvents()" 
                   style="padding: 8px 8px 8px 35px; font-size: 16px; width: 100%; box-sizing: border-box;">
        </div>
        <div id="no-results" style="color: red; margin-top: 5px; margin-bottom: 5px; display: none;">No results found</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Location</th>
                <th>Event Time</th>
                <th>Status</th>
                <th>Event Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="event-list"></tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eventForm = document.getElementById('event-form');
            const eventList = document.getElementById('event-list');
            const otherEventTypeInput = document.getElementById('other-event-type');

            let events = JSON.parse(localStorage.getItem('events')) || [];

            function saveEvents() {
                localStorage.setItem('events', JSON.stringify(events));
            }

            function renderEvents(eventArray = events) {
                eventList.innerHTML = '';
                eventArray.forEach((event, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><input type="text" value="${event.name}" data-index="${index}" class="update-event-name"></td>
                        <td><input type="date" value="${event.date}" data-index="${index}" class="update-event-date"></td>
                        <td><input type="text" value="${event.location}" data-index="${index}" class="update-event-location"></td>
                        <td><input type="time" value="${event.time}" data-index="${index}" class="update-event-time"></td>
                        <td>
                            <select data-index="${index}" class="update-event-status" onchange="updateSelectBackground(this)">
                                <option value="in-progress" ${event.status === 'in-progress' ? 'selected' : ''}>In-Progress</option>
                                <option value="ongoing" ${event.status === 'ongoing' ? 'selected' : ''}>Ongoing</option>
                                <option value="complete" ${event.status === 'complete' ? 'selected' : ''}>Complete</option>
                            </select>
                        </td>
                        <td><input type="text" value="${event.type}" data-index="${index}" class="update-event-type"></td>
                        <td><button class="delete-event" data-index="${index}">Delete</button></td>
                    `;
                    eventList.appendChild(row);

                    const statusSelect = row.querySelector('.update-event-status');
                    updateSelectBackground(statusSelect);
                });
            }

            eventForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const eventName = document.getElementById('event-name').value;
                const eventDate = document.getElementById('event-date').value;
                const eventLocation = document.getElementById('event-location').value;
                const eventTime = document.getElementById('event-time').value;
                const eventStatus = document.getElementById('event-status').value;
                const eventTypeSelect = document.getElementById('event-type');
                let eventType = eventTypeSelect.value;
                if (eventType === 'other') {
                    eventType = document.getElementById('other-event-type').value;
                }

                const isNameTaken = events.some(event => event.name === eventName);
                if (isNameTaken) {
                    alert("An event with this name already exists.");
                    return;
                }

                const isDateTaken = events.some(event => event.date === eventDate);
                if (isDateTaken) {
                    alert("This date is already taken for another event.");
                    return;
                }

                events.push({
                    name: eventName,
                    date: eventDate,
                    location: eventLocation,
                    time: eventTime,
                    status: eventStatus,
                    type: eventType
                });
                saveEvents();
                renderEvents();
                eventForm.reset();
                otherEventTypeInput.style.display = 'none';
            });

            eventList.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-event')) {
                    const index = e.target.getAttribute('data-index');
                    events.splice(index, 1);
                    saveEvents();
                    renderEvents();
                }
            });

            eventList.addEventListener('input', function(e) {
                const index = e.target.getAttribute('data-index');
                const field = e.target.classList[0]; 
                const value = e.target.value;

                if (field === 'update-event-name') {
                    events[index].name = value;
                } else if (field === 'update-event-date') {
                    events[index].date = value;
                } else if (field === 'update-event-location') {
                    events[index].location = value;
                } else if (field === 'update-event-time') {
                    events[index].time = value;
                } else if (field === 'update-event-status') {
                    events[index].status = value;
                } else if (field === 'update-event-type') {
                    events[index].type = value;
                }

                saveEvents();
            });

            function filterEvents() {
                const query = document.getElementById("search-bar").value.toLowerCase();
                const filteredEvents = events.filter(event => event.name.toLowerCase().includes(query));
                const noResults = document.getElementById("no-results");

                if (filteredEvents.length === 0) {
                    noResults.style.display = "block";
                } else {
                    noResults.style.display = "none";
                    renderEvents(filteredEvents);
                }
            }

            document.getElementById("search-bar").addEventListener("input", filterEvents);

            renderEvents();
        });
    </script>
</body>
</html>