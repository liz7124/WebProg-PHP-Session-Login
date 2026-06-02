<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Session Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto flex min-h-screen max-w-5xl flex-col justify-center px-6 py-12">
        <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200 md:p-12">
            <p class="mb-3 inline-flex rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">PHP + Tailwind</p>
            <h1 class="text-3xl font-bold sm:text-4xl">Simple session-based authentication</h1>
            <p class="mt-4 max-w-2xl text-slate-600">
                This starter uses PHP sessions and a MySQL database to store users, with a clean Tailwind UI for registration and login.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="register.php" class="rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white transition hover:bg-slate-800">Create an account</a>
                <a href="login.php" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">Sign in</a>
            </div>
            <?php if (!empty($_SESSION['user'])): ?>
                <div class="mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                    You are signed in as <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>.
                    <a href="dashboard.php" class="ml-2 font-semibold underline">Go to dashboard</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
