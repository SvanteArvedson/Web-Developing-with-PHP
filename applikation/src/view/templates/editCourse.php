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
						    <div class="small-12 columns">
    							<div class="text-centered panel radius">
    								<h1>Redigera kurs</h1>
    							</div>
							</div>
							<form id="editCourseForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::EDIT_COURSE . "&" . CoursePage::$keyCourseId . "=" . $course -> getId(); ?>">
								<div class="small-12 columns">
								    <input class="editCourseButton tiny button radius" type="submit" value="Spara ändringar" />
								    <input class="editCourseButton tiny button radius right" type="reset" value="Återställ" />
								    <fieldset class="radius">
										<legend>
											Kursinformation
										</legend>
										<input id="<?php echo CoursePage::$nameInfoChange; ?>" name="<?php echo CoursePage::$nameInfoChange; ?>" type="hidden" value="false" />
										<label>Kursnamn
											<input id="<?php echo CoursePage::$nameCourseName; ?>" name="<?php echo CoursePage::$nameCourseName; ?>" class="radius" type="text" value="<?php echo $course -> getName(); ?>" />
										</label>
										<label>Beskrivning 												
										<textarea id="<?php echo CoursePage::$nameDescription; ?>" name="<?php echo CoursePage::$nameDescription; ?>" class="radius"><?php echo $course -> getDescription(); ?></textarea></label>
									</fieldset>
								</div>
								<div class="small-12 large-6 columns">
									<fieldset class="radius">
										<legend>
											Kurslärare
										</legend>
										<input id="<?php echo CoursePage::$nameTeachersChange; ?>" name="<?php echo CoursePage::$nameTeachersChange; ?>" type="hidden" value="false" />
										<select id="courseTeachers" name="<?php echo CoursePage::$nameTeachers; ?>" multiple="multiple">
											<?php
                                            foreach ($allTeachers as $teacher) {
                                                if (in_array($teacher, $teachersOnCourse)) {
                                                    echo "<option value='" . $teacher -> getId() . "' selected>" . $teacher -> getUsername() . "</option>";
                                                } else {
                                                    echo "<option value='" . $teacher -> getId() . "'>" . $teacher -> getUsername() . "</option>";
                                                }
                                            }
											?>
										</select>
									</fieldset>
								</div>
								<div class="small-12 large-6 columns">
									<fieldset class="radius">
										<legend>
											Kursdeltagare
										</legend>
										<input id="<?php echo CoursePage::$nameStudentsChange; ?>" name="<?php echo CoursePage::$nameStudentsChange; ?>" type="hidden" value="false" />
										<select id="courseStudents" name="<?php echo CoursePage::$nameStudents; ?>" multiple="multiple">
											<?php
                                            foreach ($allStudents as $student) {
                                                if (in_array($student, $studentsOnCourse)) {
                                                    echo "<option value='" . $student -> getId() . "' selected>" . $student -> getUsername() . "</option>";
                                                } else {
                                                    echo "<option value='" . $student -> getId() . "'>" . $student -> getUsername() . "</option>";
                                                }
                                            }
											?>
										</select>
									</fieldset>
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