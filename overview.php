<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs"></script>
    <title>Goodcard - track your collection of quartet cards</title>
</head>
<body>
<div class="container">
    <h1>Goodcard - track your collection of quartet cards</h1>

    <?php if ($showFormAddCard): ?>

    <form method="post" action="index.php?action=create">
    <fieldset>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="type">Type: </label>
        <input type="text" name="type" id="type" class="form-control" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="description">Description: </label>
        <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
    </div>
    </fieldset>
        <input type="submit" class="btn btn-primary" value="Add"> 
        <input type="submit" name="cancel" class="btn btn-primary" value="Cancel">
    </form>

    <?php endif;?>

    <?php if (isset($cards)):?>

    <form method="get" action="index.php">
        <div class="form-row mb-2 ml-1">
            <input type="hidden" name="action" value="filter">
            <input type="text" name="filter" placeholder="Filter">&nbsp;
            <input type="submit" class="btn btn-primary" value="Filter">
        </div>
    </form>

    <ol class="list-group list-group-numbered">
        <?php foreach ($cards as $card) : ?>  
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold"><?= htmlspecialchars($card['type']) ?> </div>
            <?= htmlspecialchars($card['description']) ?>
            </div>
            <div class="ms-2 me-auto">
            <a href="?action=showForm"><button class="btn btn-primary">Add</button></a>
            <a href="?action=update&id=<?= $card['ID'] ?>"><button class="btn btn-primary">Update</button></a>
            <a href="?action=delete&id=<?= $card['ID'] ?>"><button class="btn btn-primary">Delete</button></a>
            </div>
        </li>
        <?php endforeach; ?>
    </ol>
    <?php endif;?>
    </div>
</body>
</html>
