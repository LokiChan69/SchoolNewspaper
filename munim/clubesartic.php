<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->

<?php
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
        $stmt = $conn->prepare("SELECT * FROM clubes WHERE id = :id");
        $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
        $stmt->execute();

        // Проверка, существует ли статья
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($article) {
            // Статья найдена, отображаем её
        } else {
            // Если статья не найдена
            echo "<p>Статья не найдена.</p>";
            exit;
        }
    } else {
        echo "<p>Некорректный запрос.</p>";
        exit;
    }
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
        </div>
    </body>
    </html>
