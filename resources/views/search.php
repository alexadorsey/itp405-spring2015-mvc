<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search DVD's</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/search.css')?>" type="text/css"> 
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand">HW4: Two-page DVD search with Laravel</span>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="box">
            <h1>Search for DVDs from our database</h1>
            <form method="get" action="/dvds">
                <span>Title: <input type="text" name="title"></span>
                <span>Genre:
                    <select name="genre">
                        <option value="All" selected>All</option>
                        <?php foreach($genres as $genre) : ?>
                            <option>
                                <?php echo $genre->genre_name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <span>Rating:
                    <select name="rating" style="width: 180px">
                        <option value="All" selected>All</option>
                        <?php foreach($ratings as $rating) : ?>
                            <option>
                                <?php echo $rating->rating_name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <br/>
                <br/>
                <button type="submit">
                    <a href="#" class="btn btn-lg btn-danger">Search</a>    
                </button>
                
                <br/>
            </form>
            <hr/>
        </div>
    </div><!-- /.container -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>