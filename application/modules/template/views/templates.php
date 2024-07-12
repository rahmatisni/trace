<!DOCTYPE html>
<html lang="en">

    <head>
        <?php echo($include); ?>
        <?php echo($head); ?>
    </head>

    <body>
        <div id="app">
            <?php echo($sidebar); ?>
            <div id="main" class="layout-navbar">
                <?php echo($header); ?>
                <?php echo($content); ?>
                <!-- <?php echo($footer); ?> -->
            </div>
        </div>    
    </body>
    <script src="assets/js/main.js"></script>

</html>