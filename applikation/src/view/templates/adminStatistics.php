<?php namespace view; ?>

<?php include (dirname(__FILE__) . '/slots/head.php'); ?>

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">
            <a id="toggle" class="hide-for-large right-off-canvas-toggle" href="#"><img src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/img/toggleMenu.png" /></a>
            <nav class="right-off-canvas-menu">
                <?php include (dirname(__FILE__) . '/slots/menuAdmin.php'); ?>
            </nav>
            <div class="container">
                <div class=" hide-for-large">
                    <div class="row">
                        <header class='small-8 medium-5 large-4 small-centered columns'>
                            <?php include (dirname(__FILE__) . '/slots/logo.php'); ?>
                        </header>
                    </div>
                </div>
                <div id="content">
                    <div class="row">
                        <div class="small-12 large-9 columns">
                            <div class="row">
                                <div class="text-centered panel radius small-12 columns">
                                    <h1>Kursresultat</h1>
                                </div>
                                <div>
                                    <h2 id="coursesResultsHeader" class="statistics-header">Resultat alla kurser</h2>
                                    <a id="coursesResults" class="open-close-result" href="#">Stäng</a>
                                    <div id="coursesResultsDiv">
                                        <?php foreach ($courses as $course): ?>
                                            <h3 class="statistics-header"><?php echo $course -> getName(); ?></h3>
                                            <div class="statistics-panel small-12 columns">
                                                <?php if($statistics -> getNbrOfResultsByCourseId($course -> getId()) == 0): ?>
                                                    <div class="row">
                                                        <p class="text-centered small-12 columns">Ingen student har gjort några quiz i den här kursen</p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($statistics -> getNbrOfResultsByCourseId($course -> getId()) != 0): ?>
                                                    <div class="row">
                                                        <label class="statistics-header small-8 large-6 columns">Antal resultat: </label>
                                                        <p class="small-4 large-6 columns"><?php echo $statistics -> getNbrOfResultsByCourseId($course -> getId()); ?></p>
                                                    </div>
                                                    <div class="row">
                                                        <label class="statistics-header small-8 large-6 columns">Genomsnittlig andel rätt: </label>
                                                        <p class="small-4 large-6 columns"><?php echo round($statistics -> getAverageScoreByCourseId($course -> getId())); ?>%</p>
                                                    </div>
                                                    <?php foreach ($course -> getQuiz() as $quiz): ?>
                                                        <h4 class="statistics-header"><?php echo $quiz -> getTitle(); ?></h4>
                                                        <div class="statistics-quiz-panel small-12 columns">
                                                            <?php if($statistics -> getNbrOfResultsByQuizId($quiz -> getId()) == 0): ?>
                                                                <div class="row">
                                                                    <p class="text-centered small-12 columns">Ingen student har gjort det här quizet</p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($statistics -> getNbrOfResultsByQuizId($quiz -> getId()) != 0): ?>
                                                                <div class="row">
                                                                    <label class="statistics-header small-8 large-6 columns">Antal resultat: </label>
                                                                    <p class="small-4 large-6 columns"><?php echo $statistics -> getNbrOfResultsByQuizId($quiz -> getId()); ?></p>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="statistics-header small-8 large-6 columns">Genomsnittlig andel rätt: </label>
                                                                    <p class="small-4 large-6 columns"><?php echo round($statistics -> getAverageScoreByQuizId($quiz -> getId())); ?>%</p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="show-for-large large-3 columns">
                            <div class="row">
                                <header class='large-12 columns'>
                                    <?php include (dirname(__FILE__) . '/slots/logo.php'); ?>
                                </header>
                                <nav class="large-12 columns">
                                    <?php include (dirname(__FILE__) . '/slots/menuAdmin.php'); ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="exit-off-canvas"></a>
        </div>
    </div>
                 
    <?php include (dirname(__FILE__) . '/slots/scripts.php'); ?>
    <script src='<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/site/statisticsTeacherAdmin.js'></script>
    <script>
        $(document).foundation();
    </script>
    </body>
</html>