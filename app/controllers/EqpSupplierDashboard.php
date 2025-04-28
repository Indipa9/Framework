<?php
class EqpSupplierDashboard extends Controller {
    public function __construct() {

    }

    public function index() {
        $this->view('eqpsupplier/v_eqpsupplier_dashboard');
    }
}
