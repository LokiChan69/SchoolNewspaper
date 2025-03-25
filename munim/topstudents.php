<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->
<?php
session_start();
// Подключение к базе данных
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

// Получение данных о лучших учениках
$query = "SELECT * FROM top_students ORDER BY score DESC";
$statement = $pdo->prepare($query);
$statement->execute();
$students = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лучшие ученики - Школьная Газета</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Общие стили */
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
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --accent-color: #E74C3C;
            --background-color: #F5F6FA;
            --text-color: #2C3E50;
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
        }

        .logo {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            font-size: 2em;
            font-weight: 700;
        }

        .logo-icon {
            margin-right: 10px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            margin-top: 180px;
            padding: 40px 0;
        }

        /* Стили для таблицы */
        .students-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .students-table th,
        .students-table td {
            padding: 15px;
            text-align: left;
        }

        .students-table th {
            background: var(--secondary-color);
            color: #fff;
            font-weight: 600;
        }

        .students-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .students-table tr:hover {
            background: #f1f1f1;
        }

        .students-table td {
            border-bottom: 1px solid #ddd;
        }

        .students-table .rank {
            width: 50px;
            text-align: center;
        }

        .students-table .score {
            width: 100px;
            text-align: center;
        }

        .students-table .updated {
            width: 150px;
            text-align: center;
        }

        /* Стили для топ-3 учеников */
        .students-table tr.top-3 {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #fff;
            font-weight: 600;
        }

        .students-table tr.top-3 td {
            border-bottom: 2px solid #fff;
        }

        .students-table tr.top-3 .rank {
            font-size: 1.2em;
            color: #fff;
        }

        .students-table tr.top-3 .score {
            font-size: 1.2em;
            color: #fff;
        }

        .students-table tr.top-3 .updated {
            font-size: 1.1em;
            color: #fff;
        }

        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .nav-menu {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .logo {
                font-size: 2.5em;
            }

            .students-table th,
            .students-table td {
                padding: 10px;
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
                    <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="nav-item"><a href="news.php" class="nav-link"><i class="fas fa-newspaper"></i> Новости</a></li>
                    <li class="nav-item"><a href="clubes.php" class="nav-link"><i class="fas fa-users"></i> Клубы</a></li>
                    <li class="nav-item"><a href="galary.php" class="nav-link"><i class="fas fa-images"></i> Галерея</a></li>
                    <li class="nav-item"><a href="contacts.php" class="nav-link"><i class="fas fa-envelope"></i> Контакты</a></li>
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
</script>

<main class="main-content">
    <div class="container">
        <h2>Лучшие ученики</h2>
        <table class="students-table">
            <thead>
                <tr>
                    <th class="rank">#</th>
                    <th>Имя ученика</th>
                    <th class="score">Баллы</th>
                    <th class="updated">Последнее обновление</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $index => $student): ?>
                    <tr class="<?= $index < 3 ? 'top-3' : '' ?>">
                        <td class="rank"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td class="score"><?= htmlspecialchars($student['score']) ?></td>
                        <td class="updated"><?= date('d.m.Y H:i', strtotime($student['updated_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>