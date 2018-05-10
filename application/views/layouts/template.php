<!DOCTYPE html>
<html>

    <head>
        <title>Igor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        
        <?php // CSS CONTENT ?>
        
        <?php if( isset($_CSS) ) : ?>
            <?php foreach($_CSS as $file) : ?>
                <link rel="stylesheet" href="<?php echo $file ?>">
            <?php endforeach ?>
        <?php endif ?>
    </head>

    <body>

        <?php echo $_HEADER ?>

        <?php echo $_MAIN ?>

        <?php echo $_FOOTER ?>
        
        <?php // JSCONTENT ?>
        <?php if( isset($_JS) ) : ?>
            <?php foreach($_JS as $file) : ?>
                <script src="<?php echo $file ?>"></script>
            <?php endforeach; ?>
        <?php endif ; ?>

        <?php // PROFILER ?>
        <?php if( $_DEBUG ) : ?>
            <?php $this->output->enable_profiler(TRUE) ?>
        <?php endif ; ?>

    </body>
</html>