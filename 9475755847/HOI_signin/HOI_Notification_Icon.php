<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Add these styles to your existing stylesheet or create a new one */
        .notification-panel {
            display: none;
            position: absolute;
            top: 95%; /* Adjust as needed */
            right: 5%; /* Adjust as needed */
            background: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 300px; /* Adjust width as needed */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000; /* Ensure it's above other content */
        }

        .notification-panel h3 {
            margin: 0;
            padding: 10px;
            background: #1d71c5;
            border-bottom: 1px solid #216db9;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            position: relative;
        }

        .notification-panel h3 a.refresh-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: white;
            
            text-decoration: none;
        }

        .refresh-icon i {
            transition: transform 0.3s ease-out; /* Smooth transition for the spinning effect */
        }

        .refresh-icon.spin i {
            animation: spin 1s infinite linear; /* Define the spinning animation */
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .notification-panel ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .notification-panel ul li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .notification-panel ul li:last-child {
            border-bottom: none;
        }
    </style>
    <title>Document</title>
</head>
<body>

<!-- Notification Panel -->
<div class="notification-panel" id="notificationPanel">
    <h3>
        Notifications
        <a href="#" class="refresh-icon" title="Refresh" style="color: white;">
            <i class='bx bx-sync'></i>
        </a>
        
    </h3>
    <ul>
        <li>No new notifications</li>
    </ul>
</div>

<a href="#" class="notification" id="notificationIcon">
    <i class='bx bxs-bell'></i>
    <span class="num">0</span>
</a>

<script>
    // Add this script to your existing script or create a new one
    document.addEventListener('DOMContentLoaded', () => {
        const notificationIcon = document.getElementById('notificationIcon');
        const notificationPanel = document.getElementById('notificationPanel');
        const refreshIcon = document.querySelector('.refresh-icon');

        notificationIcon.addEventListener('click', (e) => {
            e.preventDefault();
            notificationPanel.style.display = notificationPanel.style.display === 'none' || notificationPanel.style.display === '' ? 'block' : 'none';
        });

        refreshIcon.addEventListener('click', () => {
            refreshIcon.classList.add('spin'); // Start spinning animation

            // Simulate loading delay (replace with actual loading logic)
            setTimeout(() => {
                // Stop spinning animation after loading is complete
                refreshIcon.classList.remove('spin');
            }, 2000); // Replace 2000 with actual loading time in milliseconds
        });

        // Optional: Hide the panel if the user clicks outside of it
        document.addEventListener('click', (e) => {
            if (!notificationIcon.contains(e.target) && !notificationPanel.contains(e.target)) {
                notificationPanel.style.display = 'none';
            }
        });
    });

</script>
</body>
</html>