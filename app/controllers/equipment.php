<?php
class Equipment extends Controller {
    public function __construct() {
        $this->equipmentModel = $this->model('m_equipment');
    }

    public function index() {
        $data = [
            'equipment' => $this->equipmentModel->getAllEquipment()
        ];
        $this->view('equipment/v_equipment_index', $data);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'category' => trim($_POST['category']),
                'image_url' => '',
                'status' => trim($_POST['status']),
                'name_err' => '',
                'description_err' => '',
                'price_err' => '',
                'category_err' => '',
                'image_url_err' => '',
                'status_err' => ''
            ];

            // Validate fields
            if (empty($data['name'])) $data['name_err'] = 'Please enter equipment name';
            if (empty($data['description'])) $data['description_err'] = 'Please enter equipment description';
            if (empty($data['price'])) $data['price_err'] = 'Please enter equipment price';
            elseif (!is_numeric($data['price']) || $data['price'] <= 0) $data['price_err'] = 'Please enter a valid price';
            if (empty($data['category'])) $data['category_err'] = 'Please select a category';

            // Handle image: either file upload or external URL
            if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $file_name = $_FILES['image_file']['name'];
                $file_tmp = $_FILES['image_file']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                if (!in_array($file_ext, $allowed)) {
                    $data['image_url_err'] = 'Invalid image file type.';
                } else {
                    $new_filename = uniqid('eqp_', true) . '.' . $file_ext;
                    $upload_dir = 'uploads/equipment/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
                    $upload_path = $upload_dir . $new_filename;
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        $data['image_url'] = $new_filename;
                    } else {
                        $data['image_url_err'] = 'Failed to upload image.';
                    }
                }
            } elseif (!empty(trim($_POST['image_url']))) {
                $data['image_url'] = trim($_POST['image_url']);
            } else {
                $data['image_url_err'] = 'Please provide an image (upload or URL).';
            }

            if (
                empty($data['name_err']) &&
                empty($data['description_err']) &&
                empty($data['price_err']) &&
                empty($data['category_err']) &&
                empty($data['image_url_err'])
            ) {
                if ($this->equipmentModel->addEquipment($data)) {
                    $_SESSION['equipment_message'] = 'Equipment added successfully';
                    redirect('/equipment');
                } else {
                    $data['submit_err'] = 'Something went wrong';
                    $this->view('equipment/v_equipment_add', $data);
                }
            } else {
                $this->view('equipment/v_equipment_add', $data);
            }
        } else {
            $data = [
                'name' => '', 'description' => '', 'price' => '', 'category' => '', 'image_url' => '', 'status' => 'available',
                'name_err' => '', 'description_err' => '', 'price_err' => '', 'category_err' => '', 'image_url_err' => '', 'status_err' => ''
            ];
            $this->view('equipment/v_equipment_add', $data);
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $equipment = $this->equipmentModel->getEquipmentById($id);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'category' => trim($_POST['category']),
                'image_url' => $equipment->image_url,
                'status' => trim($_POST['status']),
                'name_err' => '',
                'description_err' => '',
                'price_err' => '',
                'category_err' => '',
                'image_url_err' => '',
                'status_err' => ''
            ];

            // Validate as above
            if (empty($data['name'])) $data['name_err'] = 'Please enter equipment name';
            if (empty($data['description'])) $data['description_err'] = 'Please enter equipment description';
            if (empty($data['price'])) $data['price_err'] = 'Please enter equipment price';
            elseif (!is_numeric($data['price']) || $data['price'] <= 0) $data['price_err'] = 'Please enter a valid price';
            if (empty($data['category'])) $data['category_err'] = 'Please select a category';

            // Handle image: either file upload or external URL
            if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $file_name = $_FILES['image_file']['name'];
                $file_tmp = $_FILES['image_file']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                if (!in_array($file_ext, $allowed)) {
                    $data['image_url_err'] = 'Invalid image file type.';
                } else {
                    $new_filename = uniqid('eqp_', true) . '.' . $file_ext;
                    $upload_dir = 'uploads/equipment/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
                    $upload_path = $upload_dir . $new_filename;
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        $data['image_url'] = $new_filename;
                    } else {
                        $data['image_url_err'] = 'Failed to upload image.';
                    }
                }
            } elseif (!empty(trim($_POST['image_url']))) {
                $data['image_url'] = trim($_POST['image_url']);
            }
            // else keep the old image

            if (
                empty($data['name_err']) &&
                empty($data['description_err']) &&
                empty($data['price_err']) &&
                empty($data['category_err']) &&
                empty($data['image_url_err'])
            ) {
                if ($this->equipmentModel->updateEquipment($data)) {
                    $_SESSION['equipment_message'] = 'Equipment updated successfully';
                    redirect('/equipment');
                } else {
                    $data['submit_err'] = 'Something went wrong';
                    $this->view('equipment/v_equipment_edit', $data);
                }
            } else {
                $this->view('equipment/v_equipment_edit', $data);
            }
        } else {
            $equipment = $this->equipmentModel->getEquipmentById($id);
            if (!$equipment) redirect('/equipment');
            $data = [
                'id' => $equipment->id,
                'name' => $equipment->name,
                'description' => $equipment->description,
                'price' => $equipment->price,
                'category' => $equipment->category,
                'image_url' => $equipment->image_url,
                'status' => $equipment->status,
                'name_err' => '',
                'description_err' => '',
                'price_err' => '',
                'category_err' => '',
                'image_url_err' => '',
                'status_err' => ''
            ];
            $this->view('equipment/v_equipment_edit', $data);
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->equipmentModel->deleteEquipment($id)) {
                $_SESSION['equipment_message'] = 'Equipment deleted successfully';
                redirect('/equipment');
            } else {
                $_SESSION['equipment_message'] = 'Something went wrong';
                redirect('/equipment');
            }
        } else {
            redirect('/equipment');
        }
    }
}
