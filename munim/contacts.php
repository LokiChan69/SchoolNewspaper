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
        .contact-section {
            margin-top: 180px;
            padding: 60px 0;
        }

        .contact-section h1 {
            font-size: 2.8em;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .contact-section h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            margin: 20px auto 0;
            border-radius: 2px;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .contact-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .contact-card i {
            font-size: 2.5em;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .contact-card h3 {
            font-size: 1.5em;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .contact-card p {
            color: #666;
            margin-bottom: 0;
        }

        .contact-form {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .contact-form h2 {
            font-size: 2em;
            color: var(--primary-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 150px;
        }

        .contact-form button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: var(--secondary-color);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contact-form button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Адаптивный дизайн */
        @media (max-width: 768px) {
            .contact-section h1 {
                font-size: 2em;
            }

            .contact-card {
                padding: 20px;
            }

            .contact-form {
                padding: 20px;
            }
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
                    <li class="nav-item"><a href="#" onclick="navigateTo('index.php')" class="nav-link"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('news.php')" class="nav-link"><i class="fas fa-newspaper"></i> Новости</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('clubes.php')" class="nav-link"><i class="fas fa-users"></i> Клубы</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('galary.php')" class="nav-link"><i class="fas fa-images"></i> Галерея</a></li>
                    <li class="nav-item"><a href="#" onclick="navigateTo('contacts.php')" class="nav-link active"><i class="fas fa-envelope"></i> Контакты</a></li>
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
<main>
    <section class="contact-section">
        <div class="container">
            <h1>Свяжитесь с нами</h1>
            <div class="contact-info">
                <div class="contact-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Адрес</h3>
                    <p>г. Ташкент, 1-й проезд Чингиза Айтматова, дом 9</p>
                </div>
                <div class="contact-card">
                    <i class="fas fa-phone-alt"></i>
                    <h3>Телефон</h3>
                    <p>+998 (71) 268 84 82</p>
                </div>
                <div class="contact-card">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>info@munim.ru</p>
                </div>
            </div>
            <div class="contact-form">
                <h2>Форма обратной связи</h2>
                <form>
                    <input type="text" placeholder="Ваше имя" required>
                    <input type="email" placeholder="Ваш email" required>
                    <textarea placeholder="Ваше сообщение" required></textarea>
                    <button type="submit">Отправить <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </section>

    <div style="display:flex">
<div style="background:#eef2ff; color:#2d2d2d; padding:30px; width:50%">
<div class="location-info">
    <h2>Наш адрес:</h2>
    <p>г. Ташкент, 1-й проезд Чингиза Айтматова, дом 9</p>
    
    <h2>Общественный транспорт:</h2>
    <p>Как добраться от станции метро нас:<br>
    <a href="https://yandex.uz/map-widget/v1/org/51752939611/?ll=69.294352%2C41.329084&amp;z=16" target="_blank" class="map-link" style="margin-top:30px;">Посмотреть на карте</a></p>
    
    <h2>Контакты:</h2>
    <p>Телефон: <a href="tel:+998712072017" class="contact-link">+998 (71) 207-20-17</a></p>
    <p>Электронная почта: <a href="mailto:info@piima.uz" class="contact-link">info@munim.uz</a></p>
    <p>Электронная почта для обращений: <a href="mailto:piima@exat.uz" class="contact-link">munim@exat.uz</a></p>
    
</div>
</div>
<a href="https://yandex.uz/navi/org/51752939611/?utm_medium=mapframe&amp;utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Mirzo Ulug'bek Nomidagi Ixtisoslashtirilgan Maktab</a><a href="https://yandex.uz/navi/10335/tashkent/category/boarding_school/184106254/?utm_medium=mapframe&amp;utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Школа-интернат в Ташкенте</a><iframe src="https://yandex.uz/map-widget/v1/org/51752939611/?ll=69.294352%2C41.329084&amp;z=16" width="100%" height="600" frameborder="1" allowfullscreen="true" style="position:relative; border-top-left-radius: 10px; border-bottom-left-radius: 10px;"></iframe></div>
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
    .location-container {
        display: flex;
        gap: 30px;
        background: var(--background-color);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 60px 0;
    }

    .location-info {
        flex: 1;
        background: #eef2ff;
        padding: 30px;
        border-radius: 15px;
        color: var(--text-color);
    }

    .location-info h2 {
        font-size: 1.5em;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .location-info p {
        font-size: 1.1em;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .map-link {
        display: inline-block;
        padding: 10px 20px;
        background: var(--secondary-color);
        color: #fff;
        text-decoration: none;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .map-link:hover {
        background: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    }

    .contact-link {
        color: var(--secondary-color);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .contact-link:hover {
        color: #2980b9;
        text-decoration: underline;
    }

    .location-map {
        flex: 1;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .note {
        font-size: 0.9em;
        color: #666;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .location-container {
            flex-direction: column;
            padding: 20px;
        }

        .location-info, .location-map {
            width: 100%;
        }

        .location-map {
            height: 300px;
        }
    }
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
    // Скрипт для анимации хэдера при скролле
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
