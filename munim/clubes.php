<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->

<?php
// Подключение к базе данных
$host = 'localhost'; // Адрес сервера БД
$db = 'school_news'; // Имя базы данных
$user = 'root'; // Имя пользователя БД
$pass = ''; // Пароль (если нет пароля, оставьте пустым)

// Создаем подключение к базе данных
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}

// Запрос для получения последних новостей
$query = "SELECT id, title, content, published_date FROM clubes ORDER BY published_date DESC";
$stmt = $pdo->query($query);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости - Школьная Газета</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Стили для страницы новостей */
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

        .container {
            width: 95%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 30px;
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

        .article {
            background: linear-gradient(135deg, #f9f9f9, #fff);
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .article:hover {
            transform: translateY(-10px);
        }

        .article h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }

        .article .date {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
        }

        .article p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .article .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5c6bc0;
            color: #fff;
            font-size: 0.9rem;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .article .btn:hover {
            background-color: #3949ab;
        }

        .footer {
            background: var(--primary-color);
            color: #fff;
            padding: 80px 0 0;
            margin-top: 80px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 60px;
            padding: 0 30px 60px;
            max-width: 1600px;
            margin: 0 auto;
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
            width: 100%;
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
            width: 100%;
        }

        .footer-subscribe button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .footer-bottom {
            background: rgba(0,0,0,0.2);
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        .footer-bottom p {
            color: #bdc3c7;
            font-size: 0.9em;
        }

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
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 0 20px 40px;
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
                    <li class="nav-item"><a href="#" onclick="navigateTo('clubes.php')" class="nav-link active"><i class="fas fa-users"></i> Клубы</a></li>
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

    <main class="main-content">
        <div class="container">
            <h2>Клубы</h2>

            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <h2><?= htmlspecialchars($article['title']) ?></h2>
                    <p class="date"><?= date('d.m.Y H:i', strtotime($article['date_published'])) ?></p>
                    <p><?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
                    <a href="clubesartic.php?id=<?= $article['id'] ?>" class="btn">Читать далее</a>
                </div>
            <?php endforeach; ?>

        </div>
    </main>

    <footer class="footer">
        <div class="container footer-container">
            <div class="footer-about">
                <h2>Школьная Газета</h2>
                <p>Новости, события и интересные истории нашей школы. Присоединяйтесь, чтобы всегда быть в курсе событий и не пропускать самые важные моменты!</p>
            </div>

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

</body>
</html>
