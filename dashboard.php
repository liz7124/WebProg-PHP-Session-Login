<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: login.php');
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto flex min-h-screen max-w-4xl items-center px-6 py-12">
        <div class="w-full rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200 md:p-10">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">Dashboard</p>
                    <h1 class="mt-2 text-3xl font-bold">Hello, <?php echo htmlspecialchars($user['name']); ?></h1>
                    <p class="mt-2 text-slate-600">You’re signed in as <?php echo htmlspecialchars($user['email']); ?>.</p>
                </div>
                <a href="logout.php" class="rounded-xl bg-rose-600 px-5 py-3 font-semibold text-white transition hover:bg-rose-500">Logout</a>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-slate-500">Session status</p>
                    <p class="mt-2 text-lg font-semibold text-slate-800">Protected area accessed</p>
                    <p class="mt-2 text-sm text-slate-600">This page only loads when the session is active.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
