<!doctype html>
<html>
 
<head>
    <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="semantic/semantic.js"></script>
    <style>
 .pusher{
    margin-left: 200px;
 }
 
    </style>
</head>
 
<body>
    <div class="ui sidebar visible inverted vertical menu">
        <a class="item">
      1
    </a>
        <a class="item">
      2
    </a>
        <a class="item">
      3
    </a>
    </div>
    <div class="pusher">
       <button id="menu" class="ui button">Menu</button>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt nulla, unde, corrupti dolores repudiandae facere a, saepe fugit iusto expedita dicta dignissimos? Ducimus, delectus, ad? Deserunt, repellendus, ad? Praesentium, eaque.
    </div>
    <script>
        $('#menu').click(function(){
            $('.ui.sidebar').sidebar('toggle');
        })
    </script>
</body>
 
</html>