<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>Movies Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* default for light mode */
        body {
            background-color: #ffffff;
            color: #000000;
        }
        .navbar {
            background-color: #343a40;
            color: #c0c0c0; /* Light gray text color for the navbar */
        }

        /* style for dark mode */
        body.dark-mode {
            background-color: #1a1a1a;
            color: #ffffff; /* White text color for dark mode */
        }
        .navbar.dark-mode {
            background-color: #333333;
            color: #c0c0c0; /* Light gray text color for the navbar in dark mode */
        }
        .form-check-label {
            color: #c0c0c0; /* Light gray text color for the "Dark Mode" label */
            
        /* Custom Navbar */
            .navbar {
                background-color: #e52d27;
                padding: 10px;
            }

            .navbar-brand {
                color: #fff;
                font-size: 24px;
                font-weight: bold;
            }

            .navbar ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .navbar li {
                display: inline-block;
                margin-right: 20px;
            }

            .navbar li a {
                color: #fff;
                text-decoration: none;
                transition: color 0.3s;
            }

            .navbar li a:hover {
                color: #f8f8f8;
        }
    </style>
    <script>
        // Check user preference from local storage and apply corresponding mode
        //retrieves the value of the darkModePreference key from the local storage. This key is used to store the user's preference for dark or light mode
        const darkModePreference = localStorage.getItem('darkModePreference');
        //gets a reference to the <body> element of the HTML document. It will be used to apply the dark mode styles to the entire page
        const body = document.body;
        //conditional statement checks if the user's preference stored in the darkModePreference variable is set to 'dark'. If it is, it adds the CSS class 'dark-mode' to the <body> element. This class applies the dark mode styles defined in the CSS
        if (darkModePreference === 'dark') {
            body.classList.add('dark-mode');
        }

        // Toggle function to switch between dark and light mode
        //function is triggered when the user clicks the dark mode toggle button
        function toggleDarkMode() {
            // line toggles the presence of the 'dark-mode' class on the <body> element. If the class is present, it will be removed; if not present, it will be added.
            body.classList.toggle('dark-mode');
            //sets the mode variable to either 'dark' or 'light' depending on whether the 'dark-mode' class is currently present on the <body> element
            const mode = body.classList.contains('dark-mode') ? 'dark' : 'light';

            // Save the user preference to local storage
            //After toggling the dark mode, this line updates the value stored in the darkModePreference key in the local storage to the new mode value. This stores the user's current mode preference for future visits
            localStorage.setItem('darkModePreference', mode);
        }
    </script>
</head>
<body>
    <!-- Navigation bar with Bootstrap styling -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Movies Review</a>
            <!-- Button for toggling the collapsed navbar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- Navigation links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="showmovies.php">Movies</a>
                    </li>
                    <!-- Display account-related links if user is logged in -->
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="userInfo.php?userId=<?php echo $_SESSION['userId']; ?>">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <!-- Display login/register link if user is not logged in -->
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login/Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- Toggle button for dark/light mode -->
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="darkModeToggle" onclick="toggleDarkMode()">
                    <label class="form-check-label" for="darkModeToggle">Dark Mode</label>
                </div>
            </div>
        </div>
    </nav>

    <!-- Load Bootstrap's JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>