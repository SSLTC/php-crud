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
    <h1>Update card</h1>

    <?= '<p class="text-danger">', !empty($errors)? implode("<br>", $errors) : '', '</p>' ?>

    <form method="post" enctype="multipart/form-data" action="index.php?action=update&id=<?= $card['ID']??$_GET['id'] ?>">
    <fieldset>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="type">Type: </label>
        <input type="text" name="type" id="type" class="form-control" required value="<?= htmlspecialchars($card['type']??$_POST['type']) ?>">
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
        <?php
            $image = glob("./uploads/collectionsCardID" . $_GET['id'] . ".{jpg,jpeg,png,gif}", GLOB_BRACE);
            if (!empty($image)) {
                echo '<img src="' . $image[0] . '" alt="image" />';
            }
        ?>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="description">Description: </label>
        <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($card['description']??$_POST['description']) ?></textarea>
    </div>
    </div>
    </fieldset>
        <input type="submit" class="btn btn-primary" value="Update">
        <input type="submit" name="cancel" class="btn btn-primary" value="Cancel">
    </form>
</div>
</body>
</html>
