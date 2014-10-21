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
                                <h1>Quiz - <?php echo $quiz -> getTitle(); ?></h1>
                            </div>
                            <form>
                                <div class="small-12 columns">
                                    <?php 
                                        $questions = $quiz -> getQuestions();
                                        shuffle($questions);
                                        foreach($questions AS $question): 
                                    ?>
                                        <div id="<?php echo $question -> getId(); ?>" class="quiz-panel">
                                            <p class="quiz-question">
                                                <?php echo $question -> getText(); ?>
                                            </p>
                                            <ul class="quiz-options small-block-grid-2">
                                                <?php
                                                    $answers = $question -> getAllAnswers();
                                                    shuffle($answers);
                                                    foreach($answers AS $answer): 
                                                ?>
                                                    <li class="quiz-option">
                                                        <label>
                                                            <input type="radio" name="<?php echo $question -> getId(); ?>" value="<?php echo $answer -> getId(); ?>" />
                                                            <?php echo $answer -> getText(); ?> </label>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                                    <input class="left tiny button radius" type="submit" value="Skicka" />
                                    <a class="right tiny button radius" href="<?php echo $_SERVER['PHP_SELF'].'?'.\view\Action::KEY.'='.\view\Action::SHOW_COURSE."&amp;".\view\CoursePage::$keyCourseId."=".$quiz->getCourseId(); ?>">Avbryt</a>
                                </div>
                            </form>
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