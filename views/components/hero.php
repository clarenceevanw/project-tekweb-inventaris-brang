<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes shimmerHover {
        0% {
            background-position: -1000px 0;
        }

        100% {
            background-position: 1000px 0;
        }
    }

    .hero-section {
        min-height: 100vh;
        min-width: 100vW;
        overflow: hidden;
        user-select: none;
        position: fixed;
        z-index: 1;
    }

    #canvas-container {
        position: absolute;
        inset: 0;
        cursor: grab;
    }

    #canvas-container:active {
        cursor: grabbing;
    }

    .hero-title {
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-subtitle {
        animation: fadeInUp 0.8s ease-out 0.1s both;
    }

    .hero-buttons {
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .btn-hero {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn-secondary-hero {
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        box-shadow: 0 8px 32px rgba(255, 255, 255, 0.1), inset 0 0 20px rgba(255, 255, 255, 0.2);
    }

    .btn-secondary-hero:hover {
        transform: scale(1.02);
        background: rgba(255, 255, 255, 1) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 12px 40px rgba(255, 255, 255, 0.3), inset 0 0 30px rgba(255, 255, 255, 0.4) !important;
        color: #7a6bb8 !important;
    }

    .btn-primary-hero {
        background: rgba(255, 255, 255, 0.95) !important;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(122, 107, 184, 0.2);
    }

    .btn-primary-hero:hover {
        transform: translateY(-3px) scale(1.02);
        background: #7a6bb8 !important;
        box-shadow: 0 12px 40px rgba(122, 107, 184, 0.4) !important;
        color: rgba(255, 255, 255, 0.95) !important;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }

        .hero-subtitle {
            font-size: 16px;
        }

        .btn-hero {
            padding: 10px 24px;
            font-size: 14px;
        }
    }
</style>

<section id="hero" class="hero-section">
    <div id="canvas-container"></div>

    <div class="relative z-10 h-screen flex flex-col items-center justify-center text-center pointer-events-none">
        <h1 class="hero-title text-6xl font-black text-white mb-4 tracking-tight drop-shadow-lg">GUDANGPINTAR</h1>
        <p class="hero-subtitle text-lg text-white text-opacity-95 mb-10 leading-relaxed max-w-2xl mx-auto">Solusi manajemen inventaris terpadu yang mengubah cara Anda mengelola gudang dengan teknologi cerdas dan efisien.</p>

        <div class="hero-buttons flex gap-4 justify-center flex-wrap pointer-events-auto">
            <a href="/#features" class="btn-hero btn-secondary-hero active:scale-95 px-9 py-3.5 text-base font-semibold rounded-xl relative overflow-hidden user-select-none text-white">Learn More</a>
            <a href="auth/select/signup" class="btn-hero btn-primary-hero active:scale-95 px-9 py-3.5 text-base font-semibold rounded-xl border-none relative overflow-hidden user-select-none text-[#7a6bb8]">Get Started</a>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true
    });

    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0x000000, 0);
    document.getElementById('canvas-container').appendChild(renderer.domElement);

    camera.position.z = 5;

    const colors = [0xd4c5f9, 0xe0d4f7, 0xf9f1ff, 0xc9b8e4, 0xb8a8d8];
    const boxes = [];
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();
    const prevMouse = new THREE.Vector2();
    let selectedBox = null;
    let dragPlane = new THREE.Plane(new THREE.Vector3(0, 0, 1), 0);
    let dragPoint = new THREE.Vector3();

    const wallColor = 0x877acc; // dinding kiri/kanan
    const wallDark = 0x7a6bb8; // dinding belakang
    const floorColor = 0x6d60b0; // lantai
    const ceilingColor = 0x9b8fd9; // plafon

    const wallMaterial = new THREE.MeshPhongMaterial({
        color: wallColor
    });
    const wallDarkMaterial = new THREE.MeshPhongMaterial({
        color: wallDark
    });
    const floorMaterial = new THREE.MeshPhongMaterial({
        color: floorColor
    });
    const ceilingMaterial = new THREE.MeshPhongMaterial({
        color: ceilingColor
    });

    const ROOM_W = 20; // lebar kiri kanan
    const ROOM_H = 9; // tinggi
    const ROOM_D = 8; // kedalaman

    const backWall = new THREE.Mesh(
        new THREE.PlaneGeometry(ROOM_W, ROOM_H),
        wallDarkMaterial
    );
    backWall.position.set(0, 0, -ROOM_D / 2);
    scene.add(backWall);

    // ==== FLOOR ====
    const floor = new THREE.Mesh(
        new THREE.PlaneGeometry(ROOM_W, ROOM_D),
        floorMaterial
    );
    floor.rotation.x = -Math.PI / 2;
    floor.position.y = -ROOM_H / 2;
    scene.add(floor);

    // ==== CEILING ====
    const ceiling = new THREE.Mesh(
        new THREE.PlaneGeometry(ROOM_W, ROOM_D),
        ceilingMaterial
    );
    ceiling.rotation.x = Math.PI / 2;
    ceiling.position.y = ROOM_H / 2;
    scene.add(ceiling);

    // ==== LEFT WALL ====
    const leftWall = new THREE.Mesh(
        new THREE.PlaneGeometry(ROOM_D, ROOM_H),
        wallMaterial
    );
    leftWall.rotation.y = Math.PI / 2;
    leftWall.position.x = -ROOM_W / 2;
    scene.add(leftWall);

    // ==== RIGHT WALL ====
    const rightWall = new THREE.Mesh(
        new THREE.PlaneGeometry(ROOM_D, ROOM_H),
        wallMaterial
    );
    rightWall.rotation.y = -Math.PI / 2;
    rightWall.position.x = ROOM_W / 2;
    scene.add(rightWall);

    // ==== OPTIONAL LIGHT ====
    const ambientLight2 = new THREE.AmbientLight(0x7a6bb8, 0.1);
    scene.add(ambientLight2);

    const dirLight = new THREE.DirectionalLight(0x6d60b0, 0.2);
    dirLight.position.set(5, 10, 8);
    scene.add(dirLight);

    function cameraShake(duration = 300, intensity = 0.05) {
        const startTime = performance.now();
        const originalPos = camera.position.clone();

        function shake() {
            const elapsed = performance.now() - startTime;

            if (elapsed < duration) {
                const power = 1 - (elapsed / duration); // makin lama makin kecil

                camera.position.x = originalPos.x + (Math.random() - 0.5) * intensity * power;
                camera.position.y = originalPos.y + (Math.random() - 0.5) * intensity * power;
                camera.position.z = originalPos.z + (Math.random() - 0.5) * intensity * power;

                requestAnimationFrame(shake);
            } else {
                // Kembalikan posisi kamera
                camera.position.copy(originalPos);
            }
        }

        shake();
    }

    // ini atur kardus nya brp
    for (let i = 0; i < 30; i++) {
        const geometry = new THREE.BoxGeometry(0.8, 0.8, 0.8);
        const material = new THREE.MeshPhongMaterial({
            color: colors[i % colors.length],
            shininess: 100
        });
        const box = new THREE.Mesh(geometry, material);

        // === SPAWN KOTAK DI TENGAH ===
        box.position.set(
            (Math.random() - 0.5) * 0.3,
            (Math.random() - 0.5) * 0.3,
            (Math.random() - 0.5) * 0.3
        );

        // === VELOCITY LEDAKAN AWAL ===
        const explodePower = 0.12;
        const dir = new THREE.Vector3(
            (Math.random() - 0.5),
            (Math.random() - 0.5),
            (Math.random() - 0.5)
        ).normalize();

        box.velocity = {
            x: dir.x * explodePower,
            y: dir.y * explodePower,
            z: dir.z * explodePower,

            // rotasi saat ledakan
            rx: (Math.random() - 0.5) * 0.06,
            ry: (Math.random() - 0.5) * 0.06,
            rz: (Math.random() - 0.5) * 0.06
        };

        box.collisionCooldown = 0;

        scene.add(box);
        boxes.push(box);
    }
    cameraShake(300, 0.4);

    const light = new THREE.DirectionalLight(0xffffff, 0.8);
    light.position.set(5, 5, 5);
    scene.add(light);

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambientLight);

    document.addEventListener('mousedown', (e) => {
        if (e.target.classList.contains('btn-hero')) return;

        mouse.x = (e.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(e.clientY / window.innerHeight) * 2 + 1;
        prevMouse.copy(mouse);

        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObjects(boxes);

        if (intersects.length > 0) {
            selectedBox = intersects[0].object;
            dragPlane.setFromNormalAndCoplanarPoint(camera.getWorldDirection(new THREE.Vector3()), selectedBox.position);
        }
    });

    document.addEventListener('mousemove', (e) => {
        if (selectedBox) {
            prevMouse.copy(mouse);
            mouse.x = (e.clientX / window.innerWidth) * 2 - 1;
            mouse.y = -(e.clientY / window.innerHeight) * 2 + 1;

            raycaster.setFromCamera(mouse, camera);
            raycaster.ray.intersectPlane(dragPlane, dragPoint);

            selectedBox.position.copy(dragPoint);
        }
    });

    document.addEventListener('mouseup', () => {
        if (selectedBox) {
            const momentum = 0.3;
            selectedBox.velocity.x = (mouse.x - prevMouse.x) * momentum;
            selectedBox.velocity.y = (mouse.y - prevMouse.y) * momentum;
            selectedBox.velocity.z = 0;
        }
        selectedBox = null;
    });

    const MAX_SPEED = 0.06;
    const COLLISION_DAMPING = 0.95;
    const MIN_DISTANCE = 0.9;

    function clampSpeed(vel) {
        const speed = Math.sqrt(vel.x * vel.x + vel.y * vel.y + vel.z * vel.z);
        if (speed > MAX_SPEED) {
            const scale = MAX_SPEED / speed;
            vel.x *= scale;
            vel.y *= scale;
            vel.z *= scale;
        }
    }

    function animate() {
        requestAnimationFrame(animate);

        boxes.forEach((box, i) => {
            if (box !== selectedBox) {
                clampSpeed(box.velocity);

                box.position.x += box.velocity.x;
                box.position.y += box.velocity.y;
                box.position.z += box.velocity.z;
            }

            box.rotation.x += box.velocity.rx;
            box.rotation.y += box.velocity.ry;
            box.rotation.z += box.velocity.rz;

            // Setengah ukuran room
            const halfW = ROOM_W / 2 - 0.5;
            const halfH = ROOM_H / 2 - 0.5;
            const halfD = ROOM_D / 2 - 0.5;

            // X collision (left/right walls)
            if (box.position.x < -halfW) {
                box.position.x = -halfW;
                box.velocity.x *= -1;
            }
            if (box.position.x > halfW) {
                box.position.x = halfW;
                box.velocity.x *= -1;
            }

            // Y collision (floor/ceiling)
            if (box.position.y < -halfH) {
                box.position.y = -halfH;
                box.velocity.y *= -1;
            }
            if (box.position.y > halfH) {
                box.position.y = halfH;
                box.velocity.y *= -1;
            }

            // Z collision (front/back)
            if (box.position.z < -halfD) {
                box.position.z = -halfD;
                box.velocity.z *= -1;
            }
            if (box.position.z > halfD) {
                box.position.z = halfD;
                box.velocity.z *= -1;
            }

            box.collisionCooldown--;

            for (let j = i + 1; j < boxes.length; j++) {
                const other = boxes[j];

                const dx = other.position.x - box.position.x;
                const dy = other.position.y - box.position.y;
                const dz = other.position.z - box.position.z;
                const dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

                if (dist < MIN_DISTANCE) {

                    // Normal vektor tabrakan
                    const nx = dx / dist;
                    const ny = dy / dist;
                    const nz = dz / dist;

                    // Pisahkan dulu agar tidak overlap
                    const penetration = MIN_DISTANCE - dist;
                    box.position.x -= nx * (penetration / 2);
                    box.position.y -= ny * (penetration / 2);
                    box.position.z -= nz * (penetration / 2);

                    other.position.x += nx * (penetration / 2);
                    other.position.y += ny * (penetration / 2);
                    other.position.z += nz * (penetration / 2);

                    // Hitung relative velocity
                    const rvx = other.velocity.x - box.velocity.x;
                    const rvy = other.velocity.y - box.velocity.y;
                    const rvz = other.velocity.z - box.velocity.z;

                    // Hitung kecepatan sepanjang arah normal
                    const velAlongNormal = rvx * nx + rvy * ny + rvz * nz;

                    // Jika bergerak menjauh, tidak perlu tabrakan
                    if (velAlongNormal > 0) continue;

                    // Koefisien pantulan
                    const restitution = 0.8;

                    // Hitung impulse
                    const impulseMag = -(1 + restitution) * velAlongNormal / 2;
                    const impulseX = impulseMag * nx;
                    const impulseY = impulseMag * ny;
                    const impulseZ = impulseMag * nz;

                    // Tambahkan impulse ke velocity
                    box.velocity.x -= impulseX;
                    box.velocity.y -= impulseY;
                    box.velocity.z -= impulseZ;

                    other.velocity.x += impulseX;
                    other.velocity.y += impulseY;
                    other.velocity.z += impulseZ;

                    // Clamp biar tidak kelewat cepat
                    clampSpeed(box.velocity);
                    clampSpeed(other.velocity);
                }
            }
        });

        renderer.render(scene, camera);
    }

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

    animate();
</script>