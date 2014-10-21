<?php

namespace model;

/**
 * Error codes for applications error handling
 * @author Svante Arvedson
 */
class ErrorCode {
    const USERNAME_EMPTY = 0;
    const PASSWORD_EMPTY = 1;
    const NO_MATCHING_USER = 2;
    const COURSE_NAME_EMPTY = 3;
    const COURSE_DESCRIPTION_EMPTY = 4;
    const NO_PRIVILEGES = 5;
    const QUIZ_DONT_EXISTS = 6;
    const COURSE_DONT_EXISTS = 7;
}
