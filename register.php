<?php
require_once 'controller.php';

session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($name === '' || $email === '' || $password === '' || $confirmPassword === '') {
        $error = 'All fields are required.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } else {
        $users = read_all_users();

        foreach ($users as $user) {
            if (($user['email'] ?? '') === $email) {
                $error = 'An account with that email already exists.';
                break;
            }
        }

        if ($error === '') {
            insert_user($name, $email, password_hash($password, PASSWORD_DEFAULT));
            $success = 'Account created successfully. You can now sign in.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto flex min-h-screen max-w-2xl items-center px-6 py-12">
        <div class="w-full rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200 md:p-10">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">Register</p>
                <h1 class="mt-2 text-3xl font-bold">Create your account</h1>
                <p class="mt-2 text-slate-600">Sign up to access the protected dashboard.</p>
            </div>

            <?php if ($error !== ''): ?>
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success !== ''): ?>
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                    <?php echo htmlspecialchars($success); ?>
                    <a href="login.php" class="ml-2 font-semibold underline">Go to login</a>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-4">
                <div>
                    <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Full name</label>
                    <input id="name" name="name" type="text" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="Alex Morgan">
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email address</label>
                    <input id="email" name="email" type="email" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="alex@example.com">
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                        <input id="password" name="password" type="password" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="••••••">
                    </div>
                    <div>
                        <label for="confirm_password" class="mb-1 block text-sm font-medium text-slate-700">Confirm password</label>
                        <input id="confirm_password" name="confirm_password" type="password" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="••••••">
                    </div>
                </div>

                <button type="submit" class="w-full rounded-xl bg-slate-900 px-4 py-3 font-semibold text-white transition hover:bg-slate-800">Register</button>
            </form>

            <p class="mt-6 text-sm text-slate-600">
                Already have an account?
                <a href="login.php" class="font-semibold text-emerald-700 underline">Sign in</a>
            </p>
        </div>
    </main>
</body>
</html>
