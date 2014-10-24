<?php

namespace model;

/**
 * "Enum", matching allowed content in column "user.privileges"
 */
class Privileges {
    const ADMIN = 'Admin';
    const TEACHER = 'Teacher';
    const STUDENT = 'Student';
}
