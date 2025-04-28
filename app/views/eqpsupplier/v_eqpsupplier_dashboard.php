<?php require APPROOT . '/views/inc/header6.php'; ?>
<?php require APPROOT . '/views/inc/components/topnavbar_eqpsupplier.php'; ?>


<div class="dashboard-container">
    <!-- Dashboard Stats -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Sales</h3>
                <h2>Rs.52,845/=</h2>
            </div>
            <div class="stat-icon purple">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-info">
                <h3>Active Orders</h3>
                <h2>24</h2>
            </div>
            <div class="stat-icon pink">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-info">
                <h3>Products</h3>
                <h2>156</h2>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-tshirt"></i>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-info">
                <h3>Customers</h3>
                <h2>2.4k</h2>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Recent Orders -->
        <div class="recent-orders">
            <div class="section-header">
                <h2>Recent Orders</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            
            <div class="orders-list">
                <div class="order-item">
                    <div class="order-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <div class="order-details">
                        <h3>Portable stages 2</h3>
                        <p>Order #45623</p>
                    </div>
                    <div class="order-price">
                        Rs.25,000/=
                        <span class="order-status paid">Paid</span>
                    </div>
                </div>
                
                <div class="order-item">
                    <div class="order-icon">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="order-details">
                        <h3>Pro light package</h3>
                        <p>Order #45622</p>
                    </div>
                    <div class="order-price">
                        Rs.15,000/=
                        <span class="order-status pending">Pending</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Notifications -->
        <div class="notifications">
            <h2>Notifications</h2>
            
            <div class="notification-list">
                <div class="notification-item">
                    <div class="notification-icon order">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="notification-content">
                        <h3>New order received</h3>
                        <p>Order #45623 - DJ equipment set</p>
                        <p class="notification-time">2 minutes ago</p>
                    </div>
                </div>
                
                <div class="notification-item">
                    <div class="notification-icon payment">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-content">
                        <h3>Payment dispute</h3>
                        <p>Order #45620 requires attention</p>
                        <p class="notification-time">1 hour ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Management -->
    <div class="product-management">
        <div class="section-header">
            <h2>Product Management</h2>
            <a href="http://localhost/Framework//equipment/add" class="add-btn">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>
        
        <div class="product-list">
            <div class="product-item">
                <div class="product-info">
                    <div class="product-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <div>
                        <h4>Portable stage</h4>
                        <p>#PRD001</p>
                    </div>
                </div>
                <div class="product-price">Rs.12,500/=</div>
                <div class="product-stock">7</div>
                <div class="product-status">
                    <span class="status-badge active">Active</span>
                </div>
                <div class="product-actions">
                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                    <button class="delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            
            <div class="product-item">
                <div class="product-info">
                    <div class="product-icon">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div>
                        <h4>Pro light package</h4>
                        <p>#PRD002</p>
                    </div>
                </div>
                <div class="product-price">Rs.15,000/=</div>
                <div class="product-stock">20</div>
                <div class="product-status">
                    <span class="status-badge active">Active</span>
                </div>
                <div class="product-actions">
                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                    <button class="delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>