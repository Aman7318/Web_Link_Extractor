<?php
function extractLinks($url) {
    $links = array();

    $doc = new DOMDocument();
    @$doc->loadHTMLFile($url);

    $anchorTags = $doc->getElementsByTagName('a');

    foreach ($anchorTags as $tag) {
        $href = $tag->getAttribute('href');
        if (strpos($href, 'http://') === 0 || strpos($href, 'https://') === 0) {
            $links[] = $href;
        }
    }

    return $links;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userURL = $_POST["url"];
    $allLinks = extractLinks($userURL);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Extract Links | Useful Links</title>
    <link rel="icon" type="image/x-icon" href="icon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
          margin-left: 42%;
        }
        form{
          margin-left: 35%;
        }

        input[type="text"] {
            width: 400px;
            padding: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
        }

        ul {
            margin-top: 20px;
            padding: 0;
            list-style-type: none;
        }

        li {
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 24px;
                margin-left: 48%;
            }

            form {
                margin-left: 35%;

            }

            input[type="text"] {
                max-width: 100%;
            }
        }

        /* For tablet and larger screens */
        @media (min-width: 601px) {
            h1 {
                font-size: 36px;
            }

            form {
                margin-left: 35%;
            }

            input[type="text"] {
                width: 400px;
            }
        }

    </style>
</head>
<body>
    <h1>Link Extractor</h1>
    <form method="POST" action="index.php">
        <input type="text" name="url" placeholder="Enter a URL">
        <button type="submit">Extract Links</button>
    </form>
    <br>
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($allLinks)) {
            ?>
            <table>
                <tr>
                    <th>Links</th>
                </tr>
                <?php
                foreach ($allLinks as $link) {
                    ?>
                    <tr>
                        <td><a href="<?php echo $link; ?>"><?php echo $link; ?></a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            echo "<p>No links found on the provided URL.</p>";
        }
    }
    ?>

</body>
</html>
