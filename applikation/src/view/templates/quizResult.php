<?php
namespace view;
 ?>

<?php
include (dirname(__FILE__) . '/slots/head.php');
 ?>

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
                        <?php
                        include (dirname(__FILE__) . '/slots/logo.php');
                        ?>
                    </header>
                </div>
            </div>
            <div id="content">
                <div class="row">
                    <div class="small-12 large-9 columns">
                        <div class="row">
                            <div class="text-centered panel radius small-12 columns">
                                <h1>Resultat - <?php echo $quiz -> getTitle(); ?></h1>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    <p class="result-summary"><?php echo "Din poäng var " . $score . ". Maxpoängen var " . $quiz -> getMaxScore(); ?>.</p>
                                    <ul class="presentation-list quiz-results">
                                        <?php
                                            $questions = $quiz -> getQuestions(); 
                                            for ($i = 0; $i < count($questions); $i += 1): ?>
                                                <li <?php if($questions[$i] -> getCorrectAnswer() -> getId() == $answers[$questions[$i] -> getId()]) echo 'class="correct-answer"'; else echo 'class="wrong-answer"'; ?>>
                                                    <p>
                                                        <em>Fråga <?php echo ($i + 1) . ") " . $questions[$i] -> getText(); ?>:</em> Det rätta svaret var <em><?php echo $questions[$i] -> getCorrectAnswer() -> getText(); ?></em>, ditt svar var <em><?php echo $questions[$i] -> getAnswerText($answers[$questions[$i] -> getId()]); ?></em>.
                                                    </p>
                                                </li>
                                        <?php endfor; ?>
                                    </ul>
                                    <a class="tiny button radius right" href="<?php echo $_SERVER['PHP_SELF'] . '?' . \view\Action::KEY . '=' . \view\Action::SHOW_COURSE . "&amp;" . \view\CoursePage::$keyCourseId . "=" . $quiz -> getCourseId(); ?>">Tillbaks till kurssidan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="show-for-large large-3 columns">
                        <div class="row">
                            <header class='large-12 columns'>
                                <?php
                                include (dirname(__FILE__) . '/slots/logo.php');
                                ?>
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

<?php
include (dirname(__FILE__) . '/slots/scripts.php');
 ?>

<script src='<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/jquery.multi-select.js'></script>
<script src='<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/site/editCourse.js'></script>
<script>$(document).foundation();</script>
</body>
</html>