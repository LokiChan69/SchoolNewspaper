<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->

<?php
$host = 'localhost';
$dbname = 'school_news'; // название базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Получение последних трех статей
$query = "SELECT * FROM articles ORDER BY published_date DESC LIMIT 3";
$statement = $pdo->prepare($query);
$statement->execute();
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Школьная газета</title>
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
        .fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}

        .carousel {
  position: relative;
  width: 100%;
  height: 100vh; /* или конкретную высоту */
}

.carousel-item {
  position: absolute;
  width: 100%;
  height: 100%;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  display: none;
}

.carousel-item.active {
  display: block;
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

        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
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

        /* Отступ для основного контента под фиксированной шапкой */
        .main-content {
            margin-top: 180px;
            padding-top: 40px;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                padding: 10px;
            }
            
            .main-nav {
                margin: 15px 0 0 0;
                width: 100%;
            }

            .nav-menu {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .nav-link {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
            
            .logo-text {
                font-size: 1.5rem;
            }

            /* Адаптация для мобильных при скролле */
            .header.scrolled {
                padding: 5px 0;
            }

            .header.scrolled .logo-text {
                font-size: 1.3rem;
            }

            /* Корректировка отступа для мобильных */
            .main-content {
                margin-top: 220px;
            }
        }


        /* Основной контент */
        .main-content {
            padding: 0px 0;
        }

        /* Блок с последними новостями */
        .highlight {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            margin-bottom: 60px;
            transition: transform 0.3s ease;
        }

        .highlight:hover {
            transform: translateY(-5px);
        }

        .highlight-image {
            width: 50%;
            position: relative;
            overflow: hidden;
        }

        .highlight-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .highlight:hover .highlight-image img {
            transform: scale(1.05);
        }

        .highlight-text {
            width: 50%;
            padding: 40px;
        }

        .highlight-text h3 {
            font-size: 2.2em;
            color: var(--primary-color);
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .highlight-text p {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--secondary-color);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }

        /* Сетка новостей */
        .news-section {
            margin-top: 60px;
        }

        .news-section h2 {
            font-size: 2.5em;
            color: var(--primary-color);
            margin-bottom: 40px;
            text-align: center;
            position: relative;
        }

        .news-section h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            margin: 20px auto 0;
            border-radius: 2px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        .news-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .news-image {
            height: 200px;
            overflow: hidden;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-image img {
            transform: scale(1.1);
        }

        .news-card-content {
            padding: 25px;
        }

        .news-card h3 {
            font-size: 1.4em;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .news-card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .btn-small {
            display: inline-block;
            padding: 8px 20px;
            background: var(--secondary-color);
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-small:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: #fff;
            padding: 80px 0 0;
            margin-top: 80px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            padding-bottom: 60px;
        }

        .footer h2, .footer h3 {
            color: #fff;
            font-size: 1.8em;
            margin-bottom: 25px;
            position: relative;
        }

        .footer h2::after, .footer h3::after {
            content: '';
            display: block;
            width: 40px;
            height: 3px;
            background: var(--secondary-color);
            margin-top: 15px;
        }

        .footer p {
            color: #bdc3c7;
            line-height: 1.8;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            display: block;
            padding: 8px 0;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--secondary-color);
            transform: translateX(10px);
        }

        .footer-subscribe form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .footer-subscribe input {
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.1);
            color: #fff;
            font-size: 1em;
        }

        .footer-subscribe input::placeholder {
            color: #bdc3c7;
        }

        .footer-subscribe button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: var(--secondary-color);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .footer-subscribe button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .footer-bottom {
            background: rgba(0,0,0,0.2);
            padding: 20px 0;
            text-align: center;
        }

        .footer-bottom p {
            color: #bdc3c7;
            font-size: 0.9em;
        }

        /* Адаптивный дизайн */
        @media (max-width: 992px) {
            .highlight {
                flex-direction: column;
            }
            
            .highlight-image,
            .highlight-text {
                width: 100%;
            }
            
            .highlight-text {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .logo {
                font-size: 2.5em;
            }
            
            .highlight-text h3 {
                font-size: 1.8em;
            }

        }


        

        /* Анимации */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .news-card {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header-content">
            <h1 class="logo">
                <span class="logo-icon"><i class="fas fa-newspaper"></i></span>
                <span class="logo-text">MUNIM Union</span>
            </h1>
            <nav class="main-nav">
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#" onclick="navigateTo('index.php')" class="nav-link active"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('news.php')" class="nav-link"><i class="fas fa-newspaper"></i> Новости</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('clubes.php')" class="nav-link"><i class="fas fa-users"></i> Клубы</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('galary.php')" class="nav-link"><i class="fas fa-images"></i> Галерея</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('contacts.php')" class="nav-link"><i class="fas fa-envelope"></i> Контакты</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<script>
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

// Функция для навигации по страницам
function navigateTo(url) {
    // Проверяем, существует ли страница
    fetch(url)
        .then(response => {
            if (response.ok) {
                window.location.href = url;
            } else {
                alert('Извините, страница временно недоступна');
            }
        })
        .catch(error => {
            console.error('Ошибка при переходе на страницу:', error);
            alert('Произошла ошибка при попытке перехода на страницу');
        });
}
</script>
<section class="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" style="background-image: url('https://president.uz/uploads/6ccc9aba-3f0e-e17c-ecbd-2c067e08050a.jpg');"></div>
    <div class="carousel-item" style="background-image: url('https://president.uz/uploads/13bbd5fa-2f64-1e60-f218-3ae7f8475762.jpg');"></div>
    <div class="carousel-item" style="background-image: url('https://avatars.mds.yandex.net/get-altay/5245944/2a0000017c0644b87fdcb4958d167783a0ce/XXL_height');"></div>
  </div>

  <div class="carousel-content">
    <h1 class="carousel-slogan">Добро пожаловать в MUNIM</h1>
    <p>Будь в центре событий твоей школы и двигайся к новым вершинам знаний вместе с нами.</p>
    <a href="news.php" class="carousel-button">Смотреть новости</a>
  </div>

  <button class="carousel-control prev" onclick="moveSlide(-1)">&#10094;</button>
  <button class="carousel-control next" onclick="moveSlide(1)">&#10095;</button>
</section>

<style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
  }

  .carousel {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
  }

  .carousel-inner {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 300%;
  }

  .carousel-item {
    min-width: 100%;
    background-size: cover;
    background-position: center;
    filter: brightness(50%);
  }

  .carousel-content {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    color: #fff;
    max-width: 600px;
  }

  .carousel-slogan {
    font-size: 3rem;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    line-height: 1.6;
  }

  .carousel-content p {
    font-size: 1.2rem;
    margin-bottom: 30px;
  }

  .carousel-button {
    background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
    color: #fff;
    padding: 15px 30px;
    border: none;
    border-radius: 25px;
    font-size: 1.2rem;
    text-decoration: none;
    transition: background 0.3s ease;
  }

  .carousel-button:hover {
    background:linear-gradient(135deg,rgb(30, 41, 53) 0%,rgb(38, 108, 154) 100%);
  }

  .carousel-control {
    background: none;
    border: none;
    font-size: 3rem;
    color: #fff;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
  }

  .prev { left: 20px; }
  .next { right: 20px; }
</style>

<script>
  let slideIndex = 0;
const slides = document.querySelectorAll('.carousel-item');

function moveSlide(direction) {
    // Убираем активный класс с текущего слайда
    slides[slideIndex].classList.remove('active');
    
    // Вычисляем новый индекс
    slideIndex = slideIndex + direction;
    
    // Проверяем границы
    if (slideIndex >= slides.length) {
        slideIndex = 0;
    }
    if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }
    
    // Добавляем активный класс новому слайду
    slides[slideIndex].classList.add('active');
}

// Автоматическое переключение каждые 5 секунд (опционально)
// setInterval(() => moveSlide(1), 5000);

</script>

    <!-- Основной контент -->
    <main class="main-content">
        <div class="container">
            <!-- Основной блок с актуальной новостью -->
            <section class="highlight fade-in">
    <div class="highlight-image">
        <img src="imgs/school.jpg" alt="Школа имени Мирзо Улугбека">
    </div>
    <div class="highlight-text">
        <h3>Немного о школе имени Мирзо Улугбека</h3>
        <p>Специализированная школа имени великого ученого и астронома Мирзо Улугбека была основана по инициативе президента Республики Узбекистан Шавката Миромановича Мирзиёева...</p>
        <a href="mainArtic.php" class="btn">Читать далее <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<section class="news-section fade-in">
    <h2>Последние статьи</h2>
    <div class="news-grid">
        <?php foreach ($articles as $article): ?>
            <div class="news-card fade-in">
                <?php if (!empty($article['image_url']) && file_exists($article['image_url'])): ?>
                    <div class="news-image">
                        <img src="<?= htmlspecialchars($article['image_url']); ?>" alt="<?= htmlspecialchars($article['title']); ?>">
                    </div>
                <?php else: ?>
                    <div class="news-image">
                        <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                            <i class="fas fa-newspaper" style="font-size: 3em; color: #ccc;"></i>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="news-card-content">
                    <h3><?= htmlspecialchars($article['title']); ?></h3>
                    <p><?= htmlspecialchars($article['short_description']); ?></p>
                    <a href="article.php?id=<?= $article['id']; ?>" class="btn-small">Подробнее <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
        </div>
    </main>

    <footer class="footer">
    <div class="container footer-container">
        <!-- Школьная газета с соцсетями под текстом -->
        <div class="footer-about">
            <h2>Школьная Газета</h2>
            <p>Новости, события и интересные истории нашей школы. Присоединяйтесь, чтобы всегда быть в курсе событий и не пропускать самые важные моменты!</p>
            
            <!-- Иконки соцсетей под текстом -->
            <div class="social-icons">
                <a href="#" class="social-link"><i class="fab fa-vk"></i></a>
                <a href="#" class="social-link"><i class="fab fa-telegram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <!-- Быстрая навигация -->
        <div class="footer-links">
            <h3>Быстрая навигация</h3>
            <ul>
                <li><a href="index.php"><i class="fas fa-chevron-right"></i> Главная</a></li>
                <li><a href="news.php"><i class="fas fa-chevron-right"></i> Новости</a></li>
                <li><a href="clubes.php"><i class="fas fa-chevron-right"></i> Клубы</a></li>
                <li><a href="galary.php"><i class="fas fa-chevron-right"></i> Галерея</a></li>
                <li><a href="contacts.php"><i class="fas fa-chevron-right"></i> Контакты</a></li>
            </ul>
        </div>

        <!-- Подписка на рассылку -->
        <div class="footer-subscribe">
            <h3>Подписаться на рассылку</h3>
            <p>Получайте наши новости и обновления прямо на ваш email!</p>
            <form>
                <input type="email" placeholder="Введите ваш email" required>
                <button type="submit">Подписаться <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 Школьная Газета. Все права защищены.</p>
    </div>
</footer>

<style>
    /* Общие стили футера */
    .footer {
        background: var(--primary-color);
        color: #fff;
        padding: 80px 20px 0;
        margin-top: 80px;
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        padding-bottom: 60px;
    }

    /* Блок "Школьная газета" */
    .footer-about h2 {
        font-size: 2.5em;
        margin-bottom: 15px;
    }

    .footer-about p {
        font-size: 1.1em;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    /* Соцсети под текстом */
    .social-icons {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }

    .social-link {
        font-size: 24px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        color: var(--secondary-color);
        transform: translateY(-5px);
    }

    /* Нижняя часть футера */
    .footer-bottom {
        background: rgba(0, 0, 0, 0.2);
        padding: 30px 20px;
        text-align: center;
    }

    .footer-bottom p {
        color: #bdc3c7;
        font-size: 0.9em;
    }

    /* Адаптация под мобильные устройства */
    @media (max-width: 768px) {
        .footer-container {
            text-align: center;
        }

        .social-icons {
            justify-content: center;
        }
    }
</style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('data-href');
                    
                    // Анимация нажатия
                    this.style.transform = 'scale(0.95)';
                    
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                        // Переход по ссылке после анимации
                        if (href !== '#') {
                            window.location.href = href;
                        }
                    }, 150);
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
    const fadeElements = document.querySelectorAll('.fade-in');

    const checkVisibility = () => {
        fadeElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;

            // Если элемент находится в области видимости
            if (elementTop < window.innerHeight && elementBottom > 0) {
                element.classList.add('visible');
            }
        });
    };

    // Проверяем видимость элементов при загрузке страницы
    checkVisibility();

    // Проверяем видимость элементов при скролле
    window.addEventListener('scroll', checkVisibility);
});
    </script>
</body>
</html>


