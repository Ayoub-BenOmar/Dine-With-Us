<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <nav class="bg-gray-900 text-white py-4 px-24">
        <div class="container flex justify-around items-center">
            <a href="home.html" class="navbar-brand">
                <img src="imgs/navbar-brand.svg" alt="Restaurant Logo" class="h-[70px]">
            </a>
            <div class="flex items-center justify-center w-full">
                <div class="flex space-x-4">
                    <a href="menu.php" class="hover:text-orange-700">Menu</a>
                    <a href="plat.php" class="hover:text-orange-700">Plat</a>
                    <a href="dashboard.php" class="hover:text-orange-700">Dashboard</a>
                </div>
            </div>
            <div class="flex items-center">
                <a href="#" class="text-orange-700">CALL US : <span class="text-gray-400 pl-2 text-sm">(123) 456 7890</span></a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-900">Chef's Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Statistiques -->
            <div class="bg-gray-900 shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-300">Statistics</h2>
                <div class="space-y-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Pending Requests</p>
                        <p class="text-2xl font-bold text-blue-600" id="pendingRequestsCount">3</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Approved Requests (Today)</p>
                        <p class="text-2xl font-bold text-green-600" id="todayApprovedCount">2</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Approved Requests (Tomorrow)</p>
                        <p class="text-2xl font-bold text-yellow-600" id="tomorrowApprovedCount">1</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Registered Clients</p>
                        <p class="text-2xl font-bold text-purple-600" id="totalClientsCount">42</p>
                    </div>
                </div>
            </div>

            <!-- Prochain Client -->
            <div class="bg-gray-900 shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-300">Next Client</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold" id="nextClientName">Marie Dupont</p>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm text-gray-600">Menu</p>
                        <p class="font-semibold" id="nextClientMenu">Couscous</p>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm text-gray-600">Date</p>
                        <p class="font-semibold" id="nextClientDate">16/03/2024</p>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-sm text-gray-600">Hour</p>
                        <p class="font-semibold" id="nextClientTime">19:30</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-600">Seats</p>
                        <p class="font-semibold" id="nextClientGuests">4</p>
                    </div>
                </div>
            </div>

            <!-- Gestion des Réservations -->
            <div class="bg-gray-900 shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-300">Pending Reservations</h2>
                <div class="space-y-4 max-h-96 overflow-y-auto" id="pendingReservationsList">
                    <!-- Réservation Item Template -->
                    <div class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Jean Martin</p>
                            <p class="text-sm text-gray-600">16/03/2024 - 20:00 | 2 Seats</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-900 text-white px-3 py-1 rounded-md hover:bg-green-600 transition">Accepter</button>
                            <button class="bg-gray-900 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Refuser</button>
                        </div>
                    </div>
                    <!-- Autre réservation -->
                    <div class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Sophie Dubois</p>
                            <p class="text-sm text-gray-600">17/03/2024 - 19:30 | 3 Seats</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-900 text-white px-3 py-1 rounded-md hover:bg-green-600 transition">Accepter</button>
                            <button class="bg-gray-900 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Refuser</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pt-16">
        <div class="bg-gray-900 px-16 py-8">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <img src="imgs/navbar-brand.svg" alt="Logo" class="h-10">
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-orange-700">Our Company</a>
                    <a href="#" class="text-white hover:text-orange-700">Our Location</a>
                    <a href="#" class="text-white hover:text-orange-700">Help Center</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white px-16 py-8">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <p class="mb-4 md:mb-0">&copy; 2024, All rights reserved</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-orange-700"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white hover:text-orange-700"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white hover:text-orange-700"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white hover:text-orange-700"><i class="fab fa-google"></i></a>
                </div>
            </div>
        </footer>
    </section>
</body>     
</html>