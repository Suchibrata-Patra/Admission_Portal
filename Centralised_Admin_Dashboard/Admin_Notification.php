<?php $Notification_Counter = 0; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <style>
        .notification-panel {
            display: none;
            position: absolute;
            font-weight: 300;
            top: 95%;
            right: 5%;
            background: white;
            border: none;
            border-radius: 5px;
            width: 300px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .notification-panel h3 {
            margin: 0;
            padding: 10px;
            background: #c9d4df;
            border-bottom: 1px solid #597898;
            color: rgb(32, 104, 146);
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
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
            transition: transform 0.3s ease-out;
        }
        .refresh-icon.spin i {
            animation: spin 1s infinite linear;
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
            padding: 5px;
            border-bottom: 1px solid #ccc;
        }
        .notification-panel ul li:last-child {
            border-bottom: none;
        }
        table.notification-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        table.notification-table th,
        table.notification-table td {
            border:none;
            padding: 10px;
            text-align: left;
        }
        table.notification-table th {
            background-color: #f2f2f2;
            color: #333;
        }
        table.notification-table tr:hover {
            background-color: #f9f9f9;
        }
        table.notification-table td a button {
            border: none;
            background-color: #9bb7d4;
            color: white;
            border-radius: 3px;
            padding: 5px;
            cursor: pointer;
        }
        table.notification-table td a button:hover {
            background-color: #88a3bb;
        }
    </style>
    <title>Document</title>
</head>
<body>
<div class="notification-panel" id="notificationPanel">
    <h3>
        Notifications
        <a href="#" class="refresh-icon" title="Refresh" style="color:white;">
            <i class='bx bx-sync'></i>
        </a>
    </h3>
    <table class="notification-table">
        <?php 
        if ($user['Institution_Name'] == '') {
            $Notification_Counter++;
            echo '<tr>
                    <td>School Name is Not Set</td>
                    <td>
                        <a href="HOI_School_Preferences.php" style="text-decoration: none;">
                            <button>Edit</button>
                        </a>
                    </td>
                  </tr>';
        }
        if ($user['Institution_Address'] == '') {
            $Notification_Counter++;
            echo '<tr>
                    <td>Set School Address</td>
                    <td>
                        <a href="HOI_School_Preferences.php" style="text-decoration: none;">
                            <button>Edit</button>
                        </a>
                    </td>
                  </tr>';
        }
        if ($user['HOI_Name'] == '') {
            $Notification_Counter++;
            echo '<tr>
                    <td>Set H.M Name</td>
                    <td>
                        <a href="HOI_School_Preferences.php" style="text-decoration: none;">
                            <button>Edit</button>
                        </a>
                    </td>
                  </tr>';
        }
        ?>
    </table>
</div>

<a href="#" class="notification" id="notificationIcon">
    <i class='bx bxs-bell'></i>
    <span class="num"><?php echo $Notification_Counter ?></span>
</a>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const notificationIcon = document.getElementById('notificationIcon');
        const notificationPanel = document.getElementById('notificationPanel');
        const refreshIcon = document.querySelector('.refresh-icon');

        notificationIcon.addEventListener('click', (e) => {
            e.preventDefault();
            notificationPanel.style.display = notificationPanel.style.display === 'none' || notificationPanel.style.display === '' ? 'block' : 'none';
        });

        refreshIcon.addEventListener('click', () => {
            refreshIcon.classList.add('spin');

            setTimeout(() => {
                refreshIcon.classList.remove('spin');
            }, 2000);
        });

        document.addEventListener('click', (e) => {
            if (!notificationIcon.contains(e.target) && !notificationPanel.contains(e.target)) {
                notificationPanel.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>