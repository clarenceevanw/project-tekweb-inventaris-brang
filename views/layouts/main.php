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

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Three.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <!-- GSAP + ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <title><?= $title ?? 'Inventaris' ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: #25343B;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #FBEFDF 0%, #FBEFDF 100%);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #FBEFDF 0%, #FBEFDF 100%);
        }

        * {
            scrollbar-color: #FBEFDF #25343B;
            scrollbar-width: thin;
        }

        .toastify {
            padding: 16px 20px;
            color: #1f2937;
            display: inline-block;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            background: white;
            position: fixed;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            max-width: calc(100% - 20px);
            z-index: 2147483647;
            overflow: hidden;
            border: 1px solid #f3f4f6;
        }

        @media (min-width: 640px) {
            .toastify {
                max-width: 400px;
            }
        }

        .toastify::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 100%;
            animation: toast-progress 4000ms linear forwards;
        }

        /* Warna Progress Bar: Success (Biru) */
        .toast-success::after {
            background-color: #3b82f6;
            /* Blue-500 */
        }

        @keyframes toast-progress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .toastify:hover::after {
            animation-play-state: paused;
        }
    </style>

    <?= $this->renderSection('header') ?>
</head>

<body>
    <!-- <?php if (!empty($flash['success'])): ?>
        <script>
            Toastify({
                text: "<?= $flash['success'] ?>",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: "toast-success",
                style: {
                    background: "#ffffff",
                }
            }).showToast();
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
    <?php endif; ?> -->

    <main class="relative min-h-screen overflow-x-hidden">
        <?php
        $isLoggedIn = isset($_SESSION['user_id']);
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        include __DIR__ . '/navbarMain.php';
        ?>
        <?= $this->renderSection('content') ?>
        <?php include __DIR__ . '/footerMain.php'; ?>
    </main>

    <?= $this->renderSection('script') ?>
</body>

</html>