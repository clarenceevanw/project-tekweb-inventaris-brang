<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title><?= $title ?? 'Inventaris'?></title>

    <?= $this->renderSection('header') ?>
</head>
<body>
    <?php if (!empty($flash['success'])): ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $flash['success'] ?>'
        })
        </script>
    <?php endif; ?>

    <?php if (!empty($flash['error'])): ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= $flash['error'] ?>'
        })
        </script>
    <?php endif; ?>

    <main class="min-h-screen">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->renderSection('script') ?>
</body>
</html>