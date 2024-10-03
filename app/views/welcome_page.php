<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Flood Monitoring - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet" />
    <style>
        /* Water animation styling */
        .flood {
            position: relative;
            overflow: hidden;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1e3a8a;
            color: white;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 100%;
            background: #3b82f6;
            opacity: 0.6;
            border-radius: 100%;
            animation: rise 6s ease-in-out infinite;
            transform: translateY(100%);
        }

        .wave:nth-child(2) {
            background: #60a5fa;
            animation-delay: -3s;
        }

        @keyframes rise {
            0% {
                transform: translateY(100%);
            }

            50% {
                transform: translateY(20%);
            }

            100% {
                transform: translateY(100%);
            }
        }

        /* Responsive text styling for hero section */
        .flood-text {
            z-index: 10;
            text-align: center;
        }

        .flood h1 {
            font-size: 3rem;
        }

        @media (min-width: 640px) {
            .flood h1 {
                font-size: 4rem;
            }
        }

        @media (min-width: 768px) {
            .flood h1 {
                font-size: 5rem;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-900 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-semibold">Flood Monitoring</a>
            <div>
                <a
                    href="/logout"
                    class="text-white hover:text-gray-200 px-4">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Flood Animation -->
    <section class="flood">
        <div class="flood-text">
            <h1 class="font-bold text-4xl md:text-6xl">
                Stay Informed. Stay Safe.
            </h1>
            <p class="mt-4 text-lg">
                Monitor flood updates and be prepared to take action in case of
                emergency.
            </p>
            <a
                href="/report"
                class="mt-8 inline-block bg-yellow-500 text-blue-900 py-3 px-6 rounded-lg shadow hover:bg-yellow-400">Submit Reports</a>
        </div>

        <!-- Water animation layers -->
        <div class="wave"></div>
        <div class="wave"></div>
    </section>

    <!-- Current Flood Status -->
    <section class="py-12">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                Current Flood Status
            </h2>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-2xl text-red-600 font-semibold">
                    Severe Flood Warning
                </h3>
                <p class="mt-4 text-gray-700">
                    High water levels detected in multiple regions. Evacuation
                    recommended in affected areas.
                </p>
                <div class="mt-6">
                    <span
                        class="inline-block bg-red-600 text-white py-2 px-4 rounded-lg">Critical</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Alerts -->
    <section id="alerts" class="py-12 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                Recent Flood Alerts
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Alert Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold text-blue-800">
                        Flood Warning - City Center
                    </h3>
                    <p class="mt-4 text-gray-600">
                        Issued 2 hours ago. Water levels are rising rapidly in the City
                        Center area. Residents are advised to move to higher ground
                        immediately.
                    </p>
                    <a
                        href="{% url 'alert1' %}"
                        class="block mt-6 text-blue-600 hover:text-blue-800">View More</a>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold text-blue-800">
                        Evacuation Notice - Riverside
                    </h3>
                    <p class="mt-4 text-gray-600">
                        Issued 5 hours ago. Riverside neighborhoods are at risk of
                        flooding. Authorities recommend immediate evacuation.
                    </p>
                    <a
                        href="{% url 'alert3' %}"
                        class="block mt-6 text-blue-600 hover:text-blue-800">View More</a>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold text-blue-800">
                        Moderate Flood Alert - Northville
                    </h3>
                    <p class="mt-4 text-gray-600">
                        Issued 1 day ago. Northville has moderate flood levels. Residents
                        should stay alert and prepare for potential evacuation.
                    </p>
                    <a
                        href="{% url 'alert2' %}"
                        class="block mt-6 text-blue-600 hover:text-blue-800">View More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Report Flood Section -->
    <section id="report" class="py-12 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Report a Flood</h2>
            <p class="mb-6 text-lg text-gray-600">
                If you notice flooding in your area, please let us know. Your report
                helps keep everyone safe.
            </p>
            <a
                href="{% url 'flood_report' %}"
                class="inline-block bg-blue-800 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-700">Report Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Flood Monitoring | All Rights Reserved</p>
        </div>
    </footer>
    <a
        href="#"
        class="fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-500 transition duration-300 ease-in-out hidden"
        id="backToTop"
        aria-label="Back to Top">
        ↑
    </a>

    <script>
        const backToTopButton = document.getElementById("backToTop");
        const scrollThreshold = 300; // Change this value to set the scroll distance

        // Show or hide the button based on scroll position
        window.addEventListener("scroll", () => {
            if (
                document.body.scrollTop > scrollThreshold ||
                document.documentElement.scrollTop > scrollThreshold
            ) {
                backToTopButton.classList.remove("hidden");
            } else {
                backToTopButton.classList.add("hidden");
            }
        });

        // Smooth scroll to top when the button is clicked
        backToTopButton.addEventListener("click", (event) => {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
</body>

</html>