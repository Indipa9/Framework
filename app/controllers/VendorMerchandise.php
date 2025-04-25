<?php
class VendorMerchandise extends Controller {
    private $vendorMerchandiseModel;
    
    public function __construct() {
        // Check if user is authenticated and is a supplier
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!$this->isAuthenticated() && !$this->isSupplier()) {
            redirect('users/login');
            return;
        }
        
        $this->vendorMerchandiseModel = $this->model('m_VendorMerchandise');
    }
    
    private function isAuthenticated() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    private function isSupplier() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'supplier';
    }
    
    // Vendor dashboard to manage products
    public function index() {
        $supplierId = $_SESSION['user_id'];
        $merchandise = $this->vendorMerchandiseModel->getMerchandiseBySupplier($supplierId);
        
        $data = [
            'merchandise' => $merchandise,
            'isLoggedIn' => true
        ];
        
        $this->view('vendors/v_dashboard', $data);
    }
    
    // Show form to add new merchandise
    public function add() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Process form
            $data = [
                'name' => trim($_POST['name']),
                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'supplier_id' => $_SESSION['user_id'],
                'name_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => ''
            ];
            
            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter product name';
            }
            
            // Validate price
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter product price';
            } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
                $data['price_err'] = 'Please enter a valid price';
            }
            
            // Validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter product description';
            }
            
            // Handle file upload
            $uploadDir = APPROOT . '/public/images/';
            $imageName = '';
            
            if (!empty($_FILES['image']['name'])) {
                $imageName = time() . '_' . $_FILES['image']['name'];
                $uploadFile = $uploadDir . $imageName;
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    $data['image_err'] = 'File is not an image';
                }
                
                // Check file size (limit to 5MB)
                if ($_FILES['image']['size'] > 5000000) {
                    $data['image_err'] = 'Image file is too large (max 5MB)';
                }
                
                // Allow certain file formats
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $data['image_err'] = 'Only JPG, JPEG, PNG & GIF files are allowed';
                }
            } else {
                $data['image_err'] = 'Please select an image for the product';
            }
            
            // Make sure no errors
            if (empty($data['name_err']) && empty($data['price_err']) && 
                empty($data['description_err']) && empty($data['image_err'])) {
                
                // Upload image
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    // Add product with image
                    $productData = [
                        'name' => $data['name'],
                        'price' => $data['price'],
                        'description' => $data['description'],
                        'image' => $imageName,
                        'supplier_id' => $data['supplier_id']
                    ];
                    
                    if ($this->vendorMerchandiseModel->addMerchandise($productData)) {
                        flash('merchandise_message', 'Product added successfully');
                        redirect('vendorMerchandise');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $data['image_err'] = 'Error uploading image';
                    $this->view('vendors/v_add_merchandise', $data);
                }
            } else {
                // Load view with errors
                $this->view('vendors/v_add_merchandise', $data);
            }
        } else {
            $data = [
                'name' => '',
                'price' => '',
                'description' => '',
                'name_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => '',
                'isLoggedIn' => true
            ];
            
            $this->view('vendors/v_add_merchandise', $data);
        }
    }
    
    // Show form to edit merchandise
    public function edit($id) {
        // Get merchandise by ID
        $merchandise = $this->vendorMerchandiseModel->getMerchandiseById($id);
        
        // Check if merchandise exists
        if (!$merchandise) {
            redirect('vendorMerchandise');
            return;
        }
        
        // Check if the supplier owns this product
        if ($merchandise->supplier_id != $_SESSION['user_id']) {
            redirect('vendorMerchandise');
            return;
        }
        
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Process form
            $data = [
                'merch_id' => $id,
                'name' => trim($_POST['name']),
                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'current_image' => $merchandise->image,
                'image' => '',
                'name_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => '',
            ];
            
            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter product name';
            }
            
            // Validate price
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter product price';
            } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
                $data['price_err'] = 'Please enter a valid price';
            }
            
            // Validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter product description';
            }
            
            // Handle file upload if a new image is provided
            $uploadDir = APPROOT . '/public/images/';
            $newImage = false;
            
            if (!empty($_FILES['image']['name'])) {
                $newImage = true;
                $imageName = time() . '_' . $_FILES['image']['name'];
                $uploadFile = $uploadDir . $imageName;
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    $data['image_err'] = 'File is not an image';
                }
                
                // Check file size (limit to 5MB)
                if ($_FILES['image']['size'] > 5000000) {
                    $data['image_err'] = 'Image file is too large (max 5MB)';
                }
                
                // Allow certain file formats
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $data['image_err'] = 'Only JPG, JPEG, PNG & GIF files are allowed';
                }
                
                $data['image'] = $imageName;
            }
            
            // Make sure no errors
            if (empty($data['name_err']) && empty($data['price_err']) && 
                empty($data['description_err']) && empty($data['image_err'])) {
                
                // If new image is provided, upload it
                if ($newImage) {
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                        $data['image_err'] = 'Error uploading image';
                        $this->view('vendors/v_edit_merchandise', $data);
                        return;
                    }
                }
                
                // Prepare data for update
                $updateData = [
                    'id' => $data['merch_id'],
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'description' => $data['description'],
                    'image' => $newImage ? $data['image'] : ''
                ];
                
                // Update merchandise
                if ($this->vendorMerchandiseModel->updateMerchandise($updateData)) {
                    flash('merchandise_message', 'Product updated successfully');
                    redirect('vendorMerchandise');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('vendors/v_edit_merchandise', $data);
            }
        } else {
            $data = [
                'merch_id' => $merchandise->merch_id,
                'name' => $merchandise->Name,
                'price' => $merchandise->Price,
                'description' => $merchandise->Description,
                'image' => $merchandise->image,
                'name_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => '',
                'isLoggedIn' => true
            ];
            
            $this->view('vendors/v_edit_merchandise', $data);
        }
    }
    
    // Delete merchandise
    public function delete($id) {
        // Check for POST request (to prevent direct URL access)
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('vendorMerchandise');
            return;
        }
        
        // Get merchandise by ID
        $merchandise = $this->vendorMerchandiseModel->getMerchandiseById($id);
        
        // Check if merchandise exists and belongs to the logged-in supplier
        if (!$merchandise || $merchandise->supplier_id != $_SESSION['user_id']) {
            redirect('vendorMerchandise');
            return;
        }
        
        // Delete the merchandise
        if ($this->vendorMerchandiseModel->deleteMerchandise($id)) {
            // Delete the image file
            $imagePath = APPROOT . '/public/images/' . $merchandise->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            flash('merchandise_message', 'Product deleted successfully');
        } else {
            flash('merchandise_message', 'Failed to delete product', 'alert alert-danger');
        }
        
        redirect('vendorMerchandise');
    }
}