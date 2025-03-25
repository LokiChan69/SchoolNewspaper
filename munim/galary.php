<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея Фотографий</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --accent-color: #E74C3C;
            --background-color: #F5F6FA;
            --text-color: #2C3E50;
            --header-gradient: linear-gradient(135deg, #1a5f7a, #2C3E50);
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg,rgb(44, 44, 44),rgb(44, 44, 44));
            border-radius: 30px;
            margin-right: 10px;
        }
        ::selection {
            background-color: #3498DB;
            color: #000;
            text-shadow: 1px 1px 2px #000;
        }

        input {
            caret-color: lightblue;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            line-height: 1.8;
        }

        /* Стили для шапки */
        .header {
            background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
            padding: 25px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        /* Класс для уменьшенной шапки при скролле */
        .header.scrolled {
            padding: 8px 0;
            background: linear-gradient(135deg, #1a2733 0%, #2980b9 100%);
            transform: translateY(-100%);
        }

        .header.show {
            transform: translateY(0);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            transition: all 0.3s ease;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logo-icon {
            font-size: 2rem;
            color: #fff;
            transition: transform 0.3s ease;
        }

        .logo:hover .logo-icon {
            transform: scale(1.1);
        }

        .logo-text {
            font-size: 1.8rem;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Уменьшение размера логотипа при скролле */
        .header.scrolled .logo-text {
            font-size: 1.5rem;
        }

        .header.scrolled .logo-icon {
            font-size: 1.7rem;
        }

        .main-nav {
            margin-left: 40px;
            transition: all 0.3s ease;
        }

        .nav-menu {
            display: flex;
            gap: 15px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.95rem;
        }

        .nav-link i {
            font-size: 1rem;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.15);
        }

        .nav-link.active {
            background: rgba(255,255,255,0.2);
            font-weight: 500;
        }

        /* Основной контент */
        .main-content {
            padding-top: 120px; /* Отступ для фиксированной шапки */
        }

        /* Галерея */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Модальное окно */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 10px;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #fff;
            font-size: 2em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            transform: rotate(90deg);
            color: var(--accent-color);
        }

        /* Адаптивный дизайн */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .nav-menu {
                flex-direction: column;
                align-items: center;
                margin-top: 20px;
            }

            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header-content">
            <h1 class="logo" style="margin-left:96px;">
                <span class="logo-icon"><i class="fas fa-newspaper"></i></span>
                <span class="logo-text">MUNIM Union</span>
            </h1>
            <nav class="main-nav">
                <ul class="nav-menu" style="margin-right: 112px;">
                    <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="nav-item"><a href="news.php" class="nav-link"><i class="fas fa-newspaper"></i> Новости</a></li>
                    <li class="nav-item"><a href="clubes.php" class="nav-link"><i class="fas fa-users"></i> Клубы</a></li>
                    <li class="nav-item"><a href="galary.php" class="nav-link active"><i class="fas fa-images"></i> Галерея</a></li>
                    <li class="nav-item"><a href="contacts.php" class="nav-link"><i class="fas fa-envelope"></i> Контакты</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main class="main-content">
    <div class="gallery">
        <div class="gallery-item"><img src="galary/IMG_1233.JPG" alt="Фото 1"></div>
        <div class="gallery-item"><img src="galary/IMG_1234.JPG" alt="Фото 2"></div>
        <div class="gallery-item"><img src="galary/IMG_1235.JPG" alt="Фото 3"></div>
        <div class="gallery-item"><img src="galary/IMG_1236.JPG" alt="Фото 4"></div>
        <div class="gallery-item"><img src="galary/IMG_1237.JPG" alt="Фото 5"></div>
        <div class="gallery-item"><img src="galary/IMG_1238.JPG" alt="Фото 6"></div>
        <div class="gallery-item"><img src="galary/IMG_1239.JPG" alt="Фото 7"></div>
        <div class="gallery-item"><img src="galary/IMG_1240.JPG" alt="Фото 8"></div>
        <div class="gallery-item"><img src="galary/IMG_1241.JPG" alt="Фото 9"></div>
        <div class="gallery-item"><img src="galary/IMG_1242.JPG" alt="Фото 10"></div>
        <div class="gallery-item"><img src="galary/IMG_1243.JPG" alt="Фото 11"></div>
        <div class="gallery-item"><img src="galary/IMG_1244.JPG" alt="Фото 12"></div>
        <div class="gallery-item"><img src="galary/IMG_1245.JPG" alt="Фото 13"></div>
        <div class="gallery-item"><img src="galary/IMG_1246.JPG" alt="Фото 14"></div>
        <div class="gallery-item"><img src="galary/IMG_1247.JPG" alt="Фото 15"></div>
        <div class="gallery-item"><img src="galary/IMG_1248.JPG" alt="Фото 16"></div>
        <div class="gallery-item"><img src="galary/IMG_1249.JPG" alt="Фото 17"></div>
        <div class="gallery-item"><img src="galary/IMG_1250.JPG" alt="Фото 18"></div>
        <div class="gallery-item"><img src="galary/IMG_1251.JPG" alt="Фото 19"></div>
        <div class="gallery-item"><img src="galary/IMG_1252.JPG" alt="Фото 1"></div>
        <div class="gallery-item"><img src="galary/IMG_1253.JPG" alt="Фото 2"></div>
        <div class="gallery-item"><img src="galary/IMG_1254.JPG" alt="Фото 3"></div>
        <div class="gallery-item"><img src="galary/IMG_1255.JPG" alt="Фото 4"></div>
        <div class="gallery-item"><img src="galary/IMG_1256.JPG" alt="Фото 5"></div>
        <div class="gallery-item"><img src="galary/IMG_1257.JPG" alt="Фото 6"></div>
        <div class="gallery-item"><img src="galary/IMG_1258.JPG" alt="Фото 7"></div>
        <div class="gallery-item"><img src="galary/IMG_1259.JPG" alt="Фото 8"></div>
        <div class="gallery-item"><img src="galary/IMG_1260.JPG" alt="Фото 9"></div>
        <div class="gallery-item"><img src="galary/IMG_1261.JPG" alt="Фото 10"></div>
    </div>
</main>

<!-- Модальное окно -->
<div class="modal" id="modal">
    <button class="modal-close" onclick="closeModal()">✖</button>
    <div class="modal-content">
        <img id="modal-img" src="" alt="Полноразмерное фото">
    </div>
</div>

<script>
    // Открытие модального окна
    const galleryItems = document.querySelectorAll('.gallery-item img');
    const modal = document.getElementById('modal');
    const modalImg = document.getElementById('modal-img');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            modal.style.display = 'flex';
            modalImg.src = item.src;
        });
    });

    // Закрытие модального окна
    function closeModal() {
        modal.style.display = 'none';
    }

    // Закрытие при клике вне изображения
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Анимация шапки при скролле
    let lastScrollTop = 0;
    const header = document.querySelector('.header');
    const scrollThreshold = 60;

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (Math.abs(scrollTop - lastScrollTop) > scrollThreshold) {
            if (scrollTop > lastScrollTop) {
                header.classList.add('scrolled');
                header.classList.remove('show');
            } else {
                header.classList.remove('scrolled');
                header.classList.add('show');
            }
            lastScrollTop = scrollTop;
        }
    });
</script>
</body>
</html>