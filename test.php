<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap tutorial for begineers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="text-center mt-5">

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquid
    atque blanditiis commodi corporis, dolorem <a href="#" data-toggle="tooltip" data-placement="bottom" title="Area">eligendi</a> esse harum in minima
    quasi sed vitae voluptatibus! Doloremque eos non repellendus sed vitae?
</div>
<a href="#" data-toggle="tooltip" data-placement="top" title="Hooray!">Hover</a>
<a href="#" data-toggle="tooltip" data-placement="bottom" title="Hooray!">Hover</a>
<a href="#" data-toggle="tooltip" data-placement="left" title="Hooray!">Hover</a>
<a href="#" data-toggle="tooltip" data-placement="right" title="Hooray!">Hover</a>
<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
</body>
</html>
