<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyGarden - Prenez soin de vos plantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<header class="w-full bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-emerald-700">EasyGarden</h1>
        @auth
        <div class="space-x-4">
            <a href="/dashboard" class="text-gray-700 font-semibold hover:underline">Mon compte</a>
            <a href="/logout" class="text-red-600 font-semibold hover:underline">Déconnexion</a>
        </div>
        @else
        <div class="space-x-4">
            <a href="/login" class="text-emerald-700 font-semibold hover:underline">Connexion</a>
            <a href="/register"
               class="bg-green-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-700 transition">Inscription</a>
        </div>
        @endauth
    </div>
</header>

<!-- Hero Section avec image de fond -->
<section class="relative w-full h-screen flex items-center justify-center text-center bg-cover bg-center"
         style="background-image: url('/img/landing.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 text-white max-w-3xl px-6">
        <h2 class="text-4xl font-bold leading-tight">Prenez soin de vos plantes avec facilité</h2>
        <p class="mt-4 text-lg">Recevez des rappels d’arrosage, obtenez des conseils personnalisés et identifiez vos
            plantes instantanément.</p>
        <div class="mt-6 space-x-4">
            <a href="/register"
               class="bg-green-600 text-white px-6 py-3 rounded-lg text-lg shadow-md hover:bg-green-700 transition">Commencer</a>
            <a href="#features"
               class="bg-white text-emerald-700 px-6 py-3 rounded-lg text-lg shadow-md hover:bg-gray-200 transition">En
                savoir plus</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Pourquoi choisir EasyGarden ?</h2>
        <p class="mt-3 text-gray-600">Découvrez les fonctionnalités qui rendent le jardinage simple et agréable.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
            <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-emerald-700">📅 Rappels d’entretien</h3>
                <p class="mt-2 text-gray-600">Ne ratez plus un arrosage ou une taille importante grâce à des
                    notifications personnalisées.</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-emerald-700">🌿 Reconnaissance des plantes</h3>
                <p class="mt-2 text-gray-600">Prenez une photo et identifiez vos plantes instantanément grâce à
                    l’intelligence artificielle.</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-emerald-700">💬 Communauté</h3>
                <p class="mt-2 text-gray-600">Posez vos questions et échangez avec d'autres passionnés de jardinage.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-green-700 text-white text-center">
    <h2 class="text-3xl font-bold">Rejoignez EasyGarden dès aujourd’hui</h2>
    <p class="mt-4 text-lg">Créez votre compte gratuitement et commencez à prendre soin de vos plantes.</p>
    <div class="mt-6">
        <a href="/register"
           class="bg-white text-emerald-700 px-6 py-3 rounded-lg text-lg shadow-md hover:bg-gray-200 transition">Créer un
            compte</a>
    </div>
</section>

<!-- Footer -->
<footer class="py-10 text-center">
    <p>© 2025 EasyGarden. Tous droits réservés. Made with ❤️ by Ayatooo & MattéoDinville.</p>
</footer>

</body>
</html>
