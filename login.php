
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-0 m-0 h-[100vh]">
    <nav class="bg-gray-900 text-white py-4 px-24">
        <div class="container flex justify-between items-center">
            <a href="#" class="navbar-brand">
                <img src="imgs/navbar-brand.svg" alt="Restaurant Logo" class="h-[70px]">
            </a>
            <div class="flex items-center">
                <a href="#" class="text-orange-700">CALL US : <span class="text-gray-400 pl-2 text-sm">(123) 456 7890</span></a>
            </div>
        </div>
    </nav>

    <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('imgs/section.jpg');">
        <div class="absolute inset-0 brightness-50" style="background-image: url('imgs/section.jpg'); background-size: cover; background-position: center;"></div>
            <div class="absolute inset-0 bg-black opacity-50"></div>
                <div id="logModal" class="bg-gray-900 relative rounded-lg shadow p-8 w-[400px]">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-white ">
                            Login
                        </h3>
                    </div>
                    <form class="p-4 md:p-5" action="signInAccount.php" method="POST">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-white ">Email</label>
                                <input name="email" type="email" id="mail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"required=""/>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-white ">Password</label>
                                <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"required=""/>
                            </div>
                        </div>
                        <button type="submit" name="loginIntoPage" class="text-gray-900 inline-flex items-center bg-white hover:bg-gray-500 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Login
                        </button>
                    </form>
                    <div class="text-md font-semibold text-white">
                        Don't have an account ? <a href="" id="sign_up">Sign up!</a>
                    </div>
                </div>

                <div id="signModal" class="hidden bg-gray-900 relative rounded-lg shadow p-8 w-[400px]">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-white ">
                            Sign Up
                        </h3>
                    </div>
                    <form class="p-4 md:p-5" action="creatingAccount.php" method="POST">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-white ">Username</label>
                                <input name="username" type="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"required=""/>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-white ">Password</label>
                                <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"required=""/>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-white ">Email</label>
                                <input name="email" type="email" id="mail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"required=""/>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-white ">Phone</label>
                                <input name="phone" type="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"required=""/>
                            </div>
                        </div>
                        <button type="submit" class="text-gray-900 inline-flex items-center bg-white hover:bg-gray-500 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Sign Up
                        </button>
                    </form>
                    <div class="text-md font-semibold text-white">
                        Already have an account ?  <a href="" id="sign_in">Sign in!</a>
                    </div>
                </div>
    </section>

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

    <script src="login.js"></script>
</body>
</html>