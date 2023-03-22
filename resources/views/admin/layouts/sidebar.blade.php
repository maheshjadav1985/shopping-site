<div class="sidebar" data-background-color="white" data-active-color="danger">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                WebOsmotic Admin
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/categories') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>Category Manager</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/subcategories') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>Sub Category Manager</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/products') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>Product Manager</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/orders') }}">
                    <i class="ti-calendar"></i>
                    <p>Order Manager</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/users') }}">
                    <i class="fa fa-users"></i>
                    <p>User Manager</p>
                </a>
            </li>
        </ul>
    </div>
</div>
