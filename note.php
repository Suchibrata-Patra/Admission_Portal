<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 20px;
        }
        .sidebar, .main-content, .right-panel {
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
            margin: 10px;
            flex-grow: 1;
            min-width: 250px;
        }
        .main-content {
            flex-grow: 2;
            min-width: 400px;
        }
        .welcome {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .course-card {
            background-color: #e3f2fd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            transition: transform 0.3s;
        }
        .course-card:hover {
            transform: translateY(-5px);
        }
        .course-card h3 {
            margin: 0;
        }
        .assignment, .progress, .task-schedule, .hours-activity {
            margin-bottom: 20px;
        }
        .calendar {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        .calendar div {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #e0e0e0;
            transition: background-color 0.3s, transform 0.3s;
        }
        .calendar div:hover {
            background-color: #90caf9;
            transform: scale(1.1);
        }
        .calendar .selected {
            background-color: #ffcc80;
        }
        .bar-chart {
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }
        .bar {
            width: 20px;
            background-color: #2196f3;
            border-radius: 5px;
            transition: height 0.3s, background-color 0.3s;
        }
        .bar:hover {
            background-color: #64b5f6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="welcome">Welcome back! Darlene 👋</div>
            <div class="course-card">
                <h3>Content Writing</h3>
                <p>12 Lessons</p>
                <p>Type: Data Research</p>
            </div>
            <div class="course-card">
                <h3>Usability Testing</h3>
                <p>15 Lessons</p>
                <p>Type: UI/UX Design</p>
            </div>
            <div class="course-card">
                <h3>Photography</h3>
                <p>8 Lessons</p>
                <p>Type: Art & Design</p>
            </div>
        </div>
        <div class="main-content">
            <div class="assignment">
                <h3>Assignment</h3>
                <p>Methods of Data - In Progress</p>
                <p>Market Research - Completed</p>
                <p>Data Collection - Upcoming</p>
            </div>
            <div class="progress">
                <h3>Progress</h3>
                <p>Data Research</p>
                <p>UI/UX Design</p>
                <p>Photography</p>
            </div>
        </div>
        <div class="right-panel">
            <div class="hours-activity">
                <h3>Hours Activity</h3>
                <p>+3% Increase than last week</p>
                <p>8h 45min</p>
                <div class="bar-chart">
                    <div class="bar" style="height: 60px;"></div>
                    <div class="bar" style="height: 80px;"></div>
                    <div class="bar" style="height: 40px;"></div>
                    <div class="bar" style="height: 70px;"></div>
                    <div class="bar" style="height: 50px;"></div>
                </div>
            </div>
            <div class="task-schedule">
                <h3>Task Schedule</h3>
                <div class="calendar">
                    <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div>
                    <div>6</div><div>7</div><div>8</div><div>9</div><div>10</div>
                    <div>11</div><div>12</div><div>13</div><div class="selected">14</div><div>15</div>
                    <div>16</div><div>17</div><div>18</div><div>19</div><div>20</div>
                    <div>21</div><div>22</div><div>23</div><div>24</div><div>25</div>
                    <div>26</div><div>27</div><div>28</div><div>29</div><div>30</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
