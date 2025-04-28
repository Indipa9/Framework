<?php
class m_equipment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllEquipment() {
        $this->db->query("SELECT * FROM h_equipment ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getEquipmentById($id) {
        $this->db->query("SELECT * FROM h_equipment WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addEquipment($data) {
        $this->db->query("INSERT INTO h_equipment (name, description, price, category, image_url, status)
                          VALUES (:name, :description, :price, :category, :image_url, :status)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':image_url', $data['image_url']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function updateEquipment($data) {
        $this->db->query("UPDATE h_equipment 
                          SET name = :name, description = :description, price = :price, 
                              category = :category, image_url = :image_url, status = :status 
                          WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':image_url', $data['image_url']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    public function deleteEquipment($id) {
        $this->db->query("DELETE FROM h_equipment WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getEquipmentByCategory($category) {
        $this->db->query("SELECT * FROM h_equipment WHERE category = :category ORDER BY id DESC");
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getAvailableEquipment() {
        $this->db->query("SELECT * FROM h_equipment WHERE status = 'available' ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getBookedEquipment() {
        $this->db->query("SELECT * FROM h_equipment WHERE status = 'booked' ORDER BY id DESC");
        return $this->db->resultSet();
    }
}
