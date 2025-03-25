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
$db = 'school_news';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Обработка выхода
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Обработка отправки формы входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && hash('sha256', $password) === $user['password_hash']) {
        $_SESSION['logged_in'] = true;
    } else {
        $login_error = "Неверный логин или пароль";
    }
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true):
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора | Вход</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
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
            background: linear-gradient(135deg, #1a5f7a 0%, #2C3E50 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #2C3E50;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus {
            border-color: #3498DB;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        button {
            background: #3498DB;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            width: 100%;
        }

        button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .error {
            color: #E74C3C;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Вход в панель администратора</h2>
        <?php if (isset($login_error)): ?>
            <div class="error"><?php echo $login_error; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <input type="text" name="username" placeholder="Имя пользователя" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>
            <button type="submit" name="login">Войти в систему</button>
        </form>
    </div>
</body>
</html>

<?php
exit;
endif;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f6fa;
            min-height: 100vh;
            padding: 20px;
        }

        .admin-header {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background: #E74C3C;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2C3E50;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 500;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-family: inherit;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #3498DB;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: #3498DB;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 500;
        }

        .submit-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .success-message {
            background: #2ecc71;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }

        .error-message {
            background: #e74c3c;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h2>Панель администратора</h2>
        <a href="?logout=true" class="logout-btn">Выйти</a>
    </div>
    
    <div class="container">
        <h2>Добавление новой статьи</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Заголовок статьи</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content">Содержание статьи</label>
                <textarea id="content" name="content" required></textarea>
            </div>

            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label for="img">Изображение</label>
                <input type="file" id="img" name="img" accept="image/*" required>
            </div>

            <button type="submit" name="submit_article" class="submit-btn">Опубликовать статью</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_article'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author = $_POST['author'];
            $uploadDir = 'imgs/';

            $shortDescription = mb_substr($content, 0, 100) . '...';

            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $imgName = basename($_FILES['img']['name']);
                $imgPath = $uploadDir . time() . '_' . $imgName;

                if (move_uploaded_file($_FILES['img']['tmp_name'], $imgPath)) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO school_news.articles (title, content, short_description, image_url, author, published_date) VALUES (:title, :content, :short_description, :image_url, :author, NOW())");
                        $stmt->bindParam(':title', $title);
                        $stmt->bindParam(':content', $content);
                        $stmt->bindParam(':short_description', $shortDescription);
                        $stmt->bindParam(':image_url', $imgPath);
                        $stmt->bindParam(':author', $author);

                        if ($stmt->execute()) {
                            echo "<div class='success-message'>Статья успешно опубликована!</div>";
                        } else {
                            echo "<div class='error-message'>Ошибка при публикации статьи.</div>";
                        }
                    } catch (PDOException $e) {
                        echo "<div class='error-message'>Ошибка базы данных: " . $e->getMessage() . "</div>";
                    }
                } else {
                    echo "<div class='error-message'>Ошибка при загрузке изображения.</div>";
                }
            } else {
                echo "<div class='error-message'>Пожалуйста, выберите изображение.</div>";
            }
        }
        ?>
    </div>
    <div class="container">
    <h2>Добавление новой статьи о клубе</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Заголовок статьи -->
        <div class="form-group">
            <label for="title">Заголовок статьи</label>
            <input type="text" id="title" name="title" required>
        </div>

        <!-- Содержание статьи -->
        <div class="form-group">
            <label for="content">Содержание статьи</label>
            <textarea id="content" name="content" required></textarea>
        </div>

        <!-- Автор статьи -->
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" id="author" name="author" required>
        </div>

        <!-- Изображение -->
        <div class="form-group">
            <label for="img">Изображение</label>
            <input type="file" id="img" name="img" accept="image/*" required>
        </div>

        <!-- Кнопка отправки -->
        <button type="submit" name="submit_club_article" class="submit-btn">Опубликовать статью</button>
    </form>

    <?php
    // Обработка отправки формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_club_article'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $uploadDir = 'imgs/';

        // Короткое описание (первые 100 символов)
        $shortDescription = mb_substr($content, 0, 100) . '...';

        // Проверка загрузки изображения
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $imgName = basename($_FILES['img']['name']);
            $imgPath = $uploadDir . time() . '_' . $imgName;

            // Перемещение изображения в папку
            if (move_uploaded_file($_FILES['img']['tmp_name'], $imgPath)) {
                try {
                    // SQL-запрос для вставки данных в таблицу 'clubes'
                    $stmt = $pdo->prepare("INSERT INTO school_news.clubes (title, content, short_description, image_url, author, published_date) VALUES (:title, :content, :short_description, :image_url, :author, NOW())");
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':content', $content);
                    $stmt->bindParam(':short_description', $shortDescription);
                    $stmt->bindParam(':image_url', $imgPath);
                    $stmt->bindParam(':author', $author);

                    // Выполнение запроса
                    if ($stmt->execute()) {
                        echo "<div class='success-message'>Статья о клубе успешно опубликована!</div>";
                    } else {
                        echo "<div class='error-message'>Ошибка при публикации статьи.</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class='error-message'>Ошибка базы данных: " . $e->getMessage() . "</div>";
                }
            } else {
                echo "<div class='error-message'>Ошибка при загрузке изображения.</div>";
            }
        } else {
            echo "<div class='error-message'>Пожалуйста, выберите изображение.</div>";
        }
    }
    ?>
</div>

<!-- Контейнер для добавления ученика -->
<div class="container">
        <h2>Добавление нового ученика</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="student_name">Имя ученика</label>
                <input type="text" id="student_name" name="student_name" required>
            </div>
            <button type="submit" name="add_student" class="submit-btn">Добавить ученика</button>
        </form>

        <?php
        // Обработка добавления ученика
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
            $studentName = $_POST['student_name'];

            try {
                $stmt = $pdo->prepare("INSERT INTO top_students (name) VALUES (:name)");
                $stmt->bindParam(':name', $studentName);

                if ($stmt->execute()) {
                    echo "<div class='success-message'>Ученик успешно добавлен!</div>";
                } else {
                    echo "<div class='error-message'>Ошибка при добавлении ученика.</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='error-message'>Ошибка базы данных: " . $e->getMessage() . "</div>";
            }
        }
        ?>
    </div>

    <!-- Контейнер для начисления баллов ученику -->
    <div class="container">
        <h2>Начисление баллов ученику</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="student_id">Выберите ученика</label>
                <select id="student_id" name="student_id" required>
                    <?php
                    // Получаем список учеников из базы данных
                    $stmt = $pdo->query("SELECT id, name FROM top_students");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="points">Количество баллов</label>
                <input type="number" id="points" name="points" required>
            </div>

            <button type="submit" name="add_points" class="submit-btn">Начислить баллы</button>
        </form>

        <?php
        // Обработка начисления баллов
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_points'])) {
            $studentId = $_POST['student_id'];
            $points = $_POST['points'];

            try {
                $stmt = $pdo->prepare("UPDATE top_students SET score = score + :points WHERE id = :id");
                $stmt->bindParam(':points', $points);
                $stmt->bindParam(':id', $studentId);

                if ($stmt->execute()) {
                    echo "<div class='success-message'>Баллы успешно начислены!</div>";
                } else {
                    echo "<div class='error-message'>Ошибка при начислении баллов.</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='error-message'>Ошибка базы данных: " . $e->getMessage() . "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
