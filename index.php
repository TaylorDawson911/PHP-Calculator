<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Calculator</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="margin: 64px;">
    <div class="calculator-body" style="background: #a0a0a0;border-radius: 24px;">
        <div class="container calculator-output">
            <div class="row">
                <div class="col d-flex justify-content-center" style="background: #ffffff;margin: 12px;border-radius: 12px; height: 100px">
                <div id="screen">
                    <?php
                        include "calc.php";
                    ?>
        </div>
                </div>
            </div>
        </div>
        <div class="container">
            
        <div class="row gy-1">
        <div id="keys">
        <!-- calc keys-->

        <!-- number key pad -->
        <div id="num-keys calculator-btn">

            <div class="col center calculator-row">
                <btn>1</btn>
                <btn>2</btn>
                <btn>3</btn>
                <btn class="operator">÷</btn>
            </div>

            <div class="col center calculator-row">
                <btn>4</btn>
                <btn>5</btn>
                <btn>6</btn>
                <btn class="operator">x</btn>
            </div>
            
            <div class="col center calculator-row">
                <btn>7</btn>
                <btn>8</btn>
                <btn>9</btn>
                <btn class="operator">+</btn>
            </div>

            <div class="col center calculator-row">
                <btn>.</btn>
                <btn>0</btn>
                <btn id="clr" class="clear">C</btn>
                <btn class="operator">−</btn>
            </div>

            <div class="col center calculator-row">
            <btn>(</btn>
            <btn class="eval">=</btn>
            <btn>)</btn>
        </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="index.js"></script>
</body>




</html>

