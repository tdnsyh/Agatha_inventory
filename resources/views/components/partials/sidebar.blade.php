 <div id="sidebar">
   <div class="sidebar-wrapper active">
     <div class="sidebar-header position-relative">
       <div class="d-flex justify-content-between align-items-center">
         <div class="logo fs-3">
           <a href="#">Agatha Inventory</a>
         </div>
       </div>
     </div>
     <div class="sidebar-menu">
       <ul class="menu">
         <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
           <a class='sidebar-link' href="{{ route('dashboard') }}">
             <i class="bi bi-grid"></i>
             <span>Dashboard</span>
           </a>
         </li>

         <li class="sidebar-item {{ request()->routeIs('priority-analysis') ? 'active' : '' }}">
           <a class='sidebar-link' href="{{ route('priority-analysis') }}">
             <i class="bi bi-graph-up"></i>
             <span>Priority Analysis</span>
           </a>
         </li>

         <li class="sidebar-item  {{ request()->routeIs('product.*', 'barcode-scanner') ? 'active' : '' }} has-sub">
           <a class='sidebar-link' href="#">
             <i class="bi bi-cake2"></i>
             <span>Manage Product</span>
           </a>

           <ul class="submenu">
             <li class="submenu-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('product.index') }}">Product List</a>
             </li>
             <li class="submenu-item {{ request()->routeIs('barcode-scanner') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('barcode-scanner') }}">Barcode Scanner</a>
             </li>
           </ul>
         </li>

         <li class="sidebar-item {{ request()->routeIs('production.*') ? 'active' : '' }} has-sub">
           <a class='sidebar-link' href="#">
             <i class="bi bi-cake"></i>
             <span>Manage Production</span>
           </a>

           <ul class="submenu">
             <li class="submenu-item {{ request()->routeIs('production.index', 'production.show', 'production.create', 'production.update') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('production.index') }}">Production List</a>
             </li>

             <li class="submenu-item {{ request()->routeIs('production.request', 'production.request.create') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('production.request') }}">Production Request</a>
             </li>

             <li class="submenu-item {{ request()->routeIs('production.report') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('production.report') }}">Production Report</a>
             </li>
           </ul>
         </li>

         <li class="sidebar-item {{ request()->routeIs('sales.*') ? 'active' : '' }} has-sub">
           <a class='sidebar-link' href="#">
             <i class="bi bi-basket"></i>
             <span>Manage Sales</span>
           </a>

           <ul class="submenu">
             <li class="submenu-item {{ request()->routeIs('sales.index', 'sales.show', 'sales.create', 'sales.update') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('sales.index') }}">Sales List</a>
             </li>
             <li class="submenu-item {{ request()->routeIs('sales.report') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('sales.report') }}">Sales Report</a>
             </li>
           </ul>
         </li>

         <li class="sidebar-item {{ request()->routeIs('inventory.*') ? 'active' : '' }} has-sub">
           <a class='sidebar-link' href="#">
             <i class="bi bi-box-seam"></i>
             <span>Manage Inventory</span>
           </a>

           <ul class="submenu">
             <li class="submenu-item {{ request()->routeIs('inventory.in.*') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('inventory.in.index') }}">Inventory [IN]</a>
             </li>
             <li class="submenu-item {{ request()->routeIs('inventory.out.*') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('inventory.out.index') }}">Inventory [OUT]</a>
             </li>
             <li class="submenu-item {{ request()->routeIs('inventory.request.index', 'inventory.request.show', 'inventory.request.create', 'inventory.request.update', 'inventory.request.update-status') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('inventory.request.index') }}">Request Production</a>
             </li>
             <li class="submenu-item {{ request()->routeIs('inventory.report') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('inventory.report') }}">Inventory Report</a>
             </li>
           </ul>
         </li>

         <li class="sidebar-item {{ request()->routeIs('manage-access.*') ? 'active' : '' }} has-sub">
           <a class='sidebar-link' href="#">
             <i class="bi bi-people"></i>
             <span>Manage Access</span>
           </a>

           <ul class="submenu">
             <li class="submenu-item {{ request()->routeIs('manage-access.user.*') ? 'active' : '' }}">
               <a class="submenu-link" href="{{ route('manage-access.user.index') }}">User List</a>
             </li>
           </ul>
         </li>

         <li class="sidebar-item">
           <a class="sidebar-link" id="theme-toggle" href="#">
             <i class="bi bi-toggles"></i>
             <span>Theme</span>
           </a>
         </li>
       </ul>
     </div>
   </div>
 </div>
