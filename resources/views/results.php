<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DVD Search</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo asset('css/results.css')?>" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand">HW2: DVD search using PDO</span>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                </div><!--/.nav-collapse -->
          </div>
        </nav>

        <div class="container">
            <?php if ($genre || $rating) : ?>
                <br/>
                <h3>Search results for
                <?php if ($title) : ?>
                    Title: '<?php echo $title?>, '
                <?php endif ?>
                Genre: '<?php echo $genre ?>', Rating: '<?php echo $rating ?>'</h3>
            <?php endif ?>
            <table border="1">
                <col width="400">
                <col width="200">
                <col width="200">
                <col width="200">
                <col width="200">
                <col width="200">
                <col width="200">
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Genre</th>
                    <th>Label</th>
                    <th>Sound</th>
                    <th>Format</th>
                    <th>Release Date</th>
                    
                </tr>
            <?php foreach($dvds as $dvd) : ?>
                <tr>
                    <td><?php echo $dvd->title ?></td>
                    <td><?php echo $dvd->rating_name ?></td>
                    <td><?php echo $dvd->genre_name ?></td>
                    <td><?php echo $dvd->label_name ?></td>
                    <td><?php echo $dvd->sound_name ?></td>
                    <td><?php echo $dvd->format_name ?></td>
                    <td><?php echo DATE_FORMAT(new DateTime($dvd->release_date), 'M j, Y') ?></td> 
                </tr>
            <?php endforeach; ?>
            </table>
         </div><!-- /.container -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </body>
</html>