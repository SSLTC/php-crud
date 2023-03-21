<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <title>Goodcard - track your collection of quartet cards</title>
</head>
<body>
<div class="container">
    <h1>Goodcard - track your collection of quartet cards</h1>

    <form method="post" action="index.php?action=create">
        <label for="type">Type: </label>
        <input type="text" name="type" id="type"><br>
        <label for="description">Description: </label><br>
        <textarea id="description" name="description"></textarea><br>
        <input type="submit" class="btn btn-primary" value="Add">
    </form>

    <ul>
        <?php foreach ($cards as $card) : ?>
            <li><?= $card['type'] ?> - <?= $card['description'] ?> <a href="index.php?action=update&id=<?= $card['ID'] ?>"><button>Update</button></a></li>
        <?php endforeach; ?>
    </ul>
    </div>
</body>
</html>
