<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->

<?php
require "header.php";
// Подключение к базе данных
$host = 'localhost';
$db = 'school_news';
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

// Проверка наличия параметра id
if (isset($_GET['id'])) {
    $articleId = intval($_GET['id']);

    // SQL-запрос для получения статьи по id
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->execute();

    // Проверка, существует ли статья
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$article) {
        echo "<p>Статья не найдена.</p>";
        exit;
    }
} else {
    echo "<p>Некорректный запрос.</p>";
    exit;
}

// Обработка отправки комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $authorName = htmlspecialchars(trim($_POST['author_name']));
    $commentText = htmlspecialchars(trim($_POST['comment_text']));

    if (!empty($authorName) && !empty($commentText)) {
        $stmt = $conn->prepare("INSERT INTO comments (article_id, author_name, comment_text) VALUES (:article_id, :author_name, :comment_text)");
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        $stmt->bindParam(':author_name', $authorName, PDO::PARAM_STR);
        $stmt->bindParam(':comment_text', $commentText, PDO::PARAM_STR);
        $stmt->execute();
    }
}

// Получение комментариев для статьи
$stmt = $conn->prepare("SELECT * FROM comments WHERE article_id = :article_id ORDER BY created_at DESC");
$stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --accent-color: #E74C3C;
            --background-color: #F5F6FA;
            --text-color: #2C3E50;
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
            width: 90%;
            max-width: 1000px;
            margin: 180px auto 60px;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .article-title {
            font-size: 2.5em;
            color: var(--primary-color);
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .article-date {
            font-size: 1em;
            color: #666;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .article-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .article-content {
            font-size: 1.1em;
            color: var(--text-color);
            line-height: 1.8;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .article-content p {
            margin-bottom: 20px;
        }

        /* Стили для комментариев */
        .comments-section {
            margin-top: 60px;
        }

        .comments-section h2 {
            font-size: 2em;
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .comment-form {
            margin-bottom: 40px;
        }

        .comment-form input,
        .comment-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            font-family: 'Montserrat', sans-serif;
        }

        .comment-form textarea {
            resize: vertical;
            min-height: 150px;
        }

        .comment-form button {
            padding: 15px 30px;
            background: var(--secondary-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .comment-form button:hover {
            background: #2980b9;
        }

        .comment-list {
            margin-top: 40px;
        }

        .comment {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .comment-author {
            font-size: 1.1em;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .comment-date {
            font-size: 0.9em;
            color: #777;
            margin-bottom: 15px;
        }

        .comment-text {
            font-size: 1em;
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
                margin-top: 220px;
            }

            .article-title {
                font-size: 2em;
            }

            .article-content {
                font-size: 1em;
            }

            .comments-section h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
        <p class="article-date">
            <i class="far fa-calendar-alt"></i>
            <?php echo date("d.m.Y", strtotime($article['published_date'])); ?>
        </p>

        <?php if ($article['image_url']): ?>
            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Изображение статьи" class="article-image">
        <?php endif; ?>

        <div class="article-content">
            <?php echo nl2br(htmlspecialchars($article['content'])); ?>
        </div>

        <!-- Секция комментариев -->
        <div class="comments-section">
            <h2>Комментарии</h2>

            <!-- Форма для добавления комментария -->
            <form class="comment-form" method="POST" action="">
                <input type="text" name="author_name" placeholder="Ваше имя" required>
                <textarea name="comment_text" placeholder="Ваш комментарий" required></textarea>
                <button type="submit" name="submit_comment">Отправить</button>
            </form>

            <!-- Список комментариев -->
            <div class="comment-list">
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <div class="comment-author"><?php echo htmlspecialchars($comment['author_name']); ?></div>
                            <div class="comment-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo date("d.m.Y H:i", strtotime($comment['created_at'])); ?>
                            </div>
                            <div class="comment-text"><?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Пока нет комментариев. Будьте первым!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>