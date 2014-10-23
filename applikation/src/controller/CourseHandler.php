<?php

namespace controller;

require_once dirname(__FILE__) . '/../controller/Handler.php';
require_once dirname(__FILE__) . '/../view/CoursePage.php';
require_once dirname(__FILE__) . '/../model/User.php';
require_once dirname(__FILE__) . '/../model/CourseRepository.php';

/**
 * Controller for course functions
 */
class CourseHandler extends Handler {

    /**
     * @var $keyCourse String Key for saving course in session
     */
    private static $keyCourse = 'course';

    /**
     * @var $coursePage \view\CoursePage
     */
    private $coursePage;
    
    /**
     * @var $action String Content in action parameter in URL
     */
    private $action;

    /**
     * @param $action String Content in action parameter in URL
     */
    public function __construct($action) {
        $this -> coursePage = new \view\CoursePage();
        $this -> action = $action;
        parent::__construct($this -> coursePage -> getSignature());
    }

    /**
     * Called when URL is index.php?action=editCourse?course=___
     */
    public function editCourse() {
        $user = $this -> session -> getValue(\model\Session::$keyUser);
        $courseRepo = new \model\CourseRepository();
        $userRepo = new \model\UserRepository();
        $param = $this -> coursePage -> getUrlParameters($this -> action);
        $course = $this -> session -> isKeySet(self::$keyCourse) ? $this -> session -> getValueOnce(self::$keyCourse) : $courseRepo -> getCourseById($param[\view\CoursePage::$keyCourseId]);

        if ($this -> session -> isUserAuthenticated() && $user -> getPrivileges() !== \model\Privileges::STUDENT) {

            if ($course) {
                // If POST request
                if ($this -> coursePage -> isPostback()) {
                    $inputs = $this -> coursePage -> getInputs();
                    // If no teachers or students was selected, the variables contains empty arrays
                    $teachers = isset($inputs[\view\CoursePage::$nameArrayTeachers]) ? $userRepo -> getUsersByIds($inputs[\view\CoursePage::$nameArrayTeachers]) : array();
                    $students = isset($inputs[\view\CoursePage::$nameArrayStudents]) ? $userRepo -> getUsersByIds($inputs[\view\CoursePage::$nameArrayStudents]) : array();
                    // Updates the course object
                    $course -> setName($inputs[\view\CoursePage::$nameCourseName]);
                    $course -> setDescription($inputs[\view\CoursePage::$nameDescription]);
                    $course -> setTeachers($teachers);
                    $course -> setStudents($students);

                    // Checks to se what was updated and saves updates in database
                    try {
                        if ($inputs[\view\CoursePage::$nameInfoChange] === "true") {
                            $courseRepo -> updateCourseInfo($course);
                        }

                        if ($inputs[\view\CoursePage::$nameTeachersChange] === "true" && $user -> getPrivileges() === \model\Privileges::ADMIN) {
                            $userRepo -> updateTeachersOnCourse($course -> getId(), $course -> getTeachers());
                        }

                        if ($inputs[\view\CoursePage::$nameStudentsChange] === "true") {
                            $userRepo -> updateStudentsOnCourse($course -> getId(), $course -> getStudents());
                        }
                        $this -> coursePage -> createSuccessMessage();
                        $this -> navigation -> redirectToShowCourse($course -> getId());

                    } catch (\Exception $e) {
                        // form echoed with error messages
                        if ($e -> getCode() != -1) {
                            $this -> session -> save(self::$keyCourse, $course);
                            $this -> coursePage -> createErrorMessage($e -> getCode());
                            $this -> navigation -> redirectToEditCourse($course -> getId());
                        } else {
                            //TODO: show a custom error page here
                            var_dump($e);
                            die();
                        }
                    }
                    // If GET request
                } else {
                    $allTeachers = $userRepo -> getAllTeachers();
                    $allStudents = $userRepo -> getAllStudents();
                    $this -> coursePage -> echoEditCourse($user, $course, $allTeachers, $allStudents);
                }
            } else {
                $this -> navigation -> redirectToShowCourses();
            }
        } else {
            if ($course) {
                $this -> navigation -> redirectToShowCourse($course -> getId());
            } else {
                $this -> navigation -> redirectToShowCourses();
            }
        }
    }

    /**
     * Called when URL is index.php?action=showCourses
     */
    public function showCourses() {
        $user = $this -> session -> getValue(\model\Session::$keyUser);
        $repo = new \model\CourseRepository();

        if ($this -> session -> isUserAuthenticated()) {
            
            // Admin gets all courses, teachers and students gets the courses they are registered on
            if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                $courses = $repo -> getAllCourses();
            } else {
                $courses = $repo -> getCoursesWithParticipationBy($user -> getId());
            }

            $this -> coursePage -> echoListCourses($user, $courses);

        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }

    /**
     * Called when URL is index.php?action=showCourse&course=___
     */
    public function showCourse() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $courseRepo = new \model\CourseRepository();
            $userRepo = new \model\UserRepository();

            $param = $this -> coursePage -> getUrlParameters($this -> action);
            $course = $course = $courseRepo -> getCourseById($param[\view\CoursePage::$keyCourseId]);
            
            // Checks if course exists
            if ($course) {
                if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                    $this -> coursePage -> echoCourse($user, $course);
                } else {
                    $usersCourses = $courseRepo -> getCoursesWithParticipationBy($user -> getId());

                    // Check if user have privileges to see course
                    $allowed = false;
                    foreach ($usersCourses as $userCourse) {
                        if ($userCourse -> getId() == $course -> getId()) {
                            $allowed = true;
                        }
                    }
                    if ($allowed) {
                        $this -> coursePage -> echoCourse($user, $course);
                    } else {
                        $this -> coursePage -> createErrorMessage(\model\ErrorCode::NO_PRIVILEGES);
                        $this -> navigation -> redirectToShowCourses();
                    }
                }
            } else {
                $this -> coursePage -> createErrorMessage(\model\ErrorCode::COURSE_DONT_EXISTS);
                $this -> navigation -> redirectToShowCourses();
            }
        } else {
            $this -> navigation -> redirectFrontPage();
        }
    }
}