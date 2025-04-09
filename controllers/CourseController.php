<?php
require_once __DIR__ . '/../models/Course.php';

class CourseController {
    private $course;

    public function __construct($db) {
        $this->course = new Course($db);
    }

    public function index() {
        return $this->course->getAll();
    }

    public function get($id) {
        return $this->course->getById($id);
    }

    public function store($post) {
        $status = implode(',', $post['status']);
        $data = [
            'code' => $post['course_code'],
            'title' => $post['course_title'],
            'level' => $post['level'],
            'session' => $post['session'],
            'status' => $status
        ];

        if (isset($post['edit_id'])) {
            return $this->course->update($post['edit_id'], $data);
        } else {
            return $this->course->insert($data);
        }
    }

    public function destroy($id) {
        return $this->course->delete($id);
    }
}