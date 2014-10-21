<?php namespace view; ?>

<?php include (dirname(__FILE__) . '/slots/head.php'); ?>

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">
            <a id="toggle" class="hide-for-large right-off-canvas-toggle" href="#"><img src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/img/toggleMenu.png" /></a>
            <nav class="right-off-canvas-menu">
                <?php 
                    if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                        include (dirname(__FILE__) . '/slots/menuAdmin.php');
                    } else {
                        include (dirname(__FILE__) . '/slots/menuTeacher.php');
                    }
                ?>
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
                                    <h1><?php echo $course->getName(); ?></h1>
                                </div>
                                <div class="row">
                                    <div class="small-12 columns">
                                        
                                        <?php if($successMessage !== null) { include(dirname(__FILE__) . '/slots/success.php'); } ?>
                                        
                                        <?php if($user->getPrivileges() !== \model\Privileges::STUDENT): ?>
                                            <a class="tiny button radius" href="<?php echo $_SERVER['PHP_SELF'] . "?" . \view\Action::KEY . "=" . \view\Action::EDIT_COURSE . "&amp;" . \view\CoursePage::$keyCourseId . "=" . $course -> getId(); ?>">Redigera kurs</a>
                                        <?php endif; ?>
                                        
                                        <h2>Beskrivning</h2>
                                        <p>
                                            <?php echo $course -> getDescription(); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="small-12 large-6 columns end">
                                        <h2>Quiz</h2>
                                        <ul class="presentation-list">
                                            <?php foreach ($course -> getQuiz() as $quiz): ?>
                                                <li>
                                                    <a class="text-centered" href="<?php echo $_SERVER['PHP_SELF'] . "?" . \view\Action::KEY . "=" . \view\Action::DO_QUIZ . "&amp;" . \view\QuizPage::$keyQuizId . "=" . $quiz -> getId(); ?>"><?php echo $quiz -> getTitle(); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="small-12 large-6 columns">
                                        <h2>Lärare</h2>
                                        <ul class="presentation-list">
                                            <?php foreach ($course -> getTeachers() as $teacher): ?>
                                                <li>
                                                    <a class="text-centered" href="#"><?php echo $teacher -> getUsername(); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="small-12 large-6 columns">
                                        <h2>Studenter</h2>
                                        <ul class="presentation-list">
                                            <?php foreach ($course -> getStudents() as $student): ?>
                                                <li>
                                                    <a class="text-centered" href="#"><?php echo $student -> getUsername(); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
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
                                    <?php
                                        if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                                            include (dirname(__FILE__) . '/slots/menuAdmin.php');
                                        } else {
                                            include (dirname(__FILE__) . '/slots/menuTeacher.php');
                                        }
                                    ?>
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

    <script>
        $(document).foundation();
    </script>
    </body>
</html>