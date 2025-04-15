<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aichtal 2025 PDF Generator</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="bg-dark text-light">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container d-flex h-100 p-3 mx-auto flex-column">
            <h2>Aichtal 2025 PDF generator</h2>
            <div class="container mt-3 border border-secondary p-3">
                <h3>Website QR-Code Signs</h3>
                <form action="website.php" method="get">
                <div class="form-group">
                <label for="url">Website link:</label>
                <input type="text" name="url" class="form-control">
                </div>
                <div class="form-group">
                <label for="url">Titel:</label>
                <input type="text" name="title" class="form-control">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="bg_visibility" value="hidden" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Hide Backgroundgraphic
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="design_color" value="black" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Use Black as Textcolor instead of Design Color
                  </label>
                </div>
                <div class="form-group mt-3">
                  <input type="submit" name="generate!" value="generate Website QR-Code" class="btn btn-primary">
                </div>
                </form>
            </div>
            <div class="container mt-3 border border-secondary p-3">
                <h3>Wifi QR-Code</h3>
                <form action="wifi.php" method="get">
                <div class="form-group">
                <label for="ssid">SSID: (Wifi Name)</label>
                <input type="text" name="ssid" class="form-control">
                </div>
                <div class="form-group">
                <label for="pass">password:</label>
                <input type="text" name="pass" class="form-control">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="bg_visibility" value="hidden" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Hide Backgroundgraphic
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="design_color" value="black" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Use Black as Textcolor instead of Design Color
                  </label>
                </div>
                <div class="form-group mt-3">
                  <input type="submit" name="generate" value="generate Wifi QR-Code" class="btn btn-primary">
                </div>
                </form>
            </div>
            <div class="container mt-3 border border-secondary p-3">
                <h3>General Signs</h3>
                <form action="direction.php" method="get">
                <div class="form-group">
                <label for="text">Text:</label>
                <input type="text" name="text" class="form-control">
                </div>
                <div class="form-group">
                <label for="direction">direction:</label>
                <select name="direction" id="dir" class="form-control">
                  <option value="0">None</option>
                  <option value="1">Front</option>
                  <option value="2">Front Right</option>
                  <option value="3">Right</option>
                  <option value="4">Back Right</option>
                  <option value="5">Back</option>
                  <option value="6">Back Left</option>
                  <option value="7">Left</option>
                  <option value="8">Front Left</option>
                </select>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="orientation" id="inlineRadio1" value="P" checked>
                  <label class="form-check-label" for="inlineRadio1">Portrait</label>
                </div>
                <div class="form-check form-check">
                  <input class="form-check-input" type="radio" name="orientation" id="inlineRadio2" value="L">
                  <label class="form-check-label" for="inlineRadio2">Landscape (no Aichtal Design available)</label>
                </div>
                <!--<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="logo_visibility" value="hidden" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Hide Logo (in Landscape Mode)
                  </label>
                </div>-->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="bg_visibility" value="hidden" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Hide Backgroundgraphic
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="design_color" value="black" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Use Black as Textcolor instead of Design Color
                  </label>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" name="generate" value="generate generic sign" class="btn btn-primary">
                </div>
                </form>
            </div>
            <!--<div class="container mt-3 border border-secondary p-3">
                <h3>Bingo Cards for Badgecontrol</h3>
                <h5>add more words <a href="https://docs.google.com/forms/d/e/1FAIpQLSebjsWBtnxcs1FbAsXC1Ftr0E5tWHJZr-aEuaoXS_Rgj_5rYg/viewform">here</a></h5>
                <form action="bingo.php" method="get">
                <div class="form-group">
                <label for="number">Number of cards:</label>
                <input type="text" name="number" value="1" class="form-control">
                </div>
                <div class="form-group mt-3">
                <input type="submit" name="generate" value="generate Bingo card(s)" class="btn btn-primary">
                </div>
                </form>
            </div>-->
        </div>
    

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>