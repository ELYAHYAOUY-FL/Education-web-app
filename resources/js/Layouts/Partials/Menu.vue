<template>
    <div>
    
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <a href="index3.html" class="brand-link">
    <img src="~admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> Peonote </span>
    </a>
    
    <div class="sidebar">
    
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
    <img src="~admin-lte/dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
    <a href="#" class="d-block">Administration</a>
    </div>
    </div>
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <li class="nav-item">
    <router-link to="/NiveauPageadmin" class="nav-link"  :class="{ active: $route.path === '/NiveauPageadmin' }">
    <i class="nav-icon fas fa-th"></i>
    <p>
    Niveau Scolaire
    </p>
    </router-link>
    </li>
    
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Etudiant') }">
    <i class="nav-icon fas fa-users"></i>
    <p>
    Etudiant
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/StudentPageadmin" class="nav-link " exact active-class="active">
    <i class="far fa-circle nav-icon"></i>
    <p> Tous </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/StudentCreatadmin" class="nav-link" exact active-class="active">
    <i class="far fa-circle nav-icon"></i>
    <p> Nouveau</p>
    </router-link>
    </li>
    </ul> 
    </li>
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Etudiant') }">
    <i class="nav-icon fas fa-users"></i>
    <p>
     Professeur 
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/ProfesseurPageadmin" class="nav-link " :class="{ 'active': $route.path === '/ProfesseurPageadmin' }">
    <i class="far fa-circle nav-icon"></i>
    <p> Liste  </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="ProfesseurCreatePageadmin" class="nav-link" :class="{ 'active': $route.path === '/StudentCreatadmin' }">
    <i class="far fa-circle nav-icon"></i>
    <p> Inscription </p>
    </router-link>
    </li>
    </ul> 
    </li>
    <li class="nav-item menu-close "> 
    <a href="#" class="nav-link " :class="{ 'active': $route.path.startsWith('/Etudiant') }">
    <i class="nav-icon fas fa-users"></i>
    <p>
    Parent
    <i class="right fas fa-angle-left"></i>
    </p>
    </a>
     <ul class="nav nav-treeview">
    <li class="nav-item">
    <router-link to="/StudentPageadmin" class="nav-link " :class="{ 'active': $route.path === '/StudentPageadmin' }">
    <i class="far fa-circle nav-icon"></i>
    <p> tous les parent </p>
    </router-link>
    </li>
    <li class="nav-item">
    <router-link to="/StudentCreatadmin" class="nav-link" :class="{ 'active': $route.path === '/StudentCreatadmin' }">
    <i class="far fa-circle nav-icon"></i>
    <p> ajouter parent </p>
    </router-link>
    </li>
    </ul> 
    </li>
    </ul>
    </nav>
    
    </div>
    
    </aside>
</div>
    </template>
    <script>
    
    </script>
