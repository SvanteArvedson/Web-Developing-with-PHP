<?php

namespace model;

/**
 * Privileges, matching allowed content in column "user.privileges" in database "quizapp"
 * @author Svante Arvedson
 */
class Privileges {
    const ADMIN = 'Admin';
    const TEACHER = 'Teacher';
    const STUDENT = 'Student';
}
