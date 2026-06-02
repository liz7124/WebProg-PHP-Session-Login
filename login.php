<?php
require_once 'controller.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $user = read_user($email);

    if ($user === null || !password_verify($password, $user['password'])) {
        $error = 'Invalid email or password.';
    } else {
        $_SESSION['user'] = [
            'name' => $user['full_name'],
            'email' => $user['email'],
        ];

        header('Location: dashboard.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto flex min-h-screen max-w-2xl items-center px-6 py-12">
        <div class="w-full rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200 md:p-10">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">Login</p>
                <h1 class="mt-2 text-3xl font-bold">Welcome back</h1>
                <p class="mt-2 text-slate-600">Enter your account details to continue.</p>
            </div>

            <?php if ($error !== ''): ?>
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-4">
                <div>
                    <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email address</label>
                    <input id="email" name="email" type="email" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="alex@example.com">
                </div>

                <div>
                    <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" name="password" type="password" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="••••••">
                </div>

                <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-500">Sign in</button>
            </form>

            <p class="mt-6 text-sm text-slate-600">
                New here?
                <a href="register.php" class="font-semibold text-emerald-700 underline">Create an account</a>
            </p>
        </div>
    </main>
</body>
</html>
