<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaksha Academic Ticketing System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Open Sans; /* Updated font-family */
            background-color: #f4f4f4;
            margin-top: 0px;
        }
        .navbar-custom {
            background-color: #0056b3;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 30px;
        }
        .iframe-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        .faq-item {
            background: #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .faq-item strong {
            display: block;
            color: #14a2b8;
        }
        h2 {
            color: #14a2b8;
        }
        .option-blue {
		  color: #14a2b8;
		}
    .card-deck .card {
        flex: 1 0 auto;
        display: flex;
        flex-direction: column;
    }

    .card-deck .card .card-body {
        flex-grow: 1;
    }

   .team-image {
        height: 200px; 
        object-fit: cover; 
        object-position: center; 
    }
    .card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: start; 
    }
    .card-title, .card-text {
        margin-bottom: 0.5rem;
    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    @media (min-width: 992px) {
        .card-deck .card {
            max-width: calc(33.333% - 30px); 
        }
    }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <a class="navbar-brand" href="#">Plaksha Academic Ticketing System</a>
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Home Page</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Raiseaticket.php">Raise a Ticket</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="tickethistory.php">Ticket History</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="FAQ.php">FAQ</a>
    </li>
  </ul>
</nav>


    <div class="container">
        <h1 class="text-center mb-4">Welcome to Plaksha Academic Ticketing System</h1>

        <div class="section">
            <h2>Semester Timetable</h2>
            <select id="semesterSelect" class="form-control mb-3" onchange="updateTimetable()">
				<option value="pdfs/TT_Sem1.pdf">Semester 1</option>
                <option value="pdfs/TT_Sem3.pdf">Semester 3</option>
                <option value="pdfs/TT_Sem5.pdf">Semester 5</option>
                
                <!-- Add other semesters -->
            </select>
            <div class="iframe-container">
                <iframe id="timetableFrame" src="pdfs/TT_Sem1.pdf"></iframe>
            </div>
        </div>

        <div class="section">
            <h2>Academic Calendar</h2>
            <div class="iframe-container">
                <iframe src="pdfs/Plaksha_Academic_CALENDER.pdf"></iframe>
            </div>
        </div>
        
        <div class="section">
            <h2>General Knowledge</h2>
            <div class="faq-item">
                <strong>Which rooms are open for 20 hours?</strong>
                Room 101, 102, and 103 are available 24/7.
            </div>
            <div class="faq-item">
                <strong>Library Timings:</strong>
                8 AM to 10 PM on weekdays, 9 AM to 5 PM on weekends.
            </div>
            <!-- Add more FAQs -->
        </div>
        <section class="team-section my-5">
    <div class="text-center mb-5">
        <h2 style="color: #14a2b8;">Meet the Academic Team</h2>
    </div>
    <div class="container">
        <div class="card-deck">

            <!-- Team Member 1 -->
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="imgs/nandini_maam_image.png" alt="Dr. Nandini Kannan">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #14a2b8;">Dr. Nandini Kannan</h5>
                    <p class="card-text"> <strong>Dean of Academics & Director of Data Science Institute</strong></p>
                    <p class="card-text">Professor, Plaksha University</p>
<p class="card-text">
    Email: 
    <a href="mailto:nandini.kannan@plaksha.edu.in" style="color: #14a2b8;">nandini.kannan@plaksha.edu.in</a>
</p>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="imgs/manojsir_image.png" alt="Dr. Manoj Kannan">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #14a2b8;">Dr. Manoj Kannan</h5>
                    <p class="card-text"><strong> Associate Dean, Academics & Student Life</strong></p>
                    <p class="card-text">Associate Professor, Plaksha University</p>
<p class="card-text">
    Email: 
    <a href="mailto:manoj.kannan@plaksha.edu.in" style="color: #14a2b8;">manoj.kannan@plaksha.edu.in</a>
</p>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="imgs/Manan_image.png" alt="Manan Chawla">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #14a2b8;">Manan Chawla</h5>
                    <p class="card-text"><strong>Academic Secretary</strong></p>
                    <p class="card-text">Student from Ug26 Cohort</p>
<p class="card-text" style="color: #14a2b8;">
    Email: 
    <a href="mailto:manan.chawla@plaksha.edu.in" style="color: #14a2b8;">manan.chawla@plaksha.edu.in</a>
</p>
                </div>
            </div>

        </div>
    </div>
</section>



        <div class="section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <strong>Which rooms are open for 20 hours?</strong>
                Room 101, 102, and 103 are available 24/7.
            </div>
            <div class="faq-item">
                <strong>Library Timings:</strong>
                8 AM to 10 PM on weekdays, 9 AM to 5 PM on weekends.
            </div>
            <!-- Add more FAQs -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateTimetable() {
            var selectedSemester = document.getElementById('semesterSelect').value;
            document.getElementById('timetableFrame').src = selectedSemester;
        }
    </script>
</body>
</html>