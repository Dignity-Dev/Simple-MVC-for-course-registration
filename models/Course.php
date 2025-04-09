<?php
class Course {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM courses ORDER BY id DESC");
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO courses (course_code, course_title, level, session, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['code'], $data['title'], $data['level'], $data['session'], $data['status']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE courses SET course_code=?, course_title=?, level=?, session=?, status=? WHERE id=?");
        $stmt->bind_param("sssssi", $data['code'], $data['title'], $data['level'], $data['session'], $data['status'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        return $this->conn->query("DELETE FROM courses WHERE id = $id");
    }
}