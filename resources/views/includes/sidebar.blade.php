<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('accueil')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGeneral"
           aria-expanded="true" aria-controls="collapseGeneral">
            <i class="fas fa-fw fa-cog"></i>
            <span>Génèral</span>
        </a>
        <div id="collapseGeneral" class="collapse" aria-labelledby="headingGeneral" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

               @can('menu-list') <a class="collapse-item" href="{{route('menu.index')}}">Cantine</a>@endcan
               @can('convocation-list') <a class="collapse-item" href="{{ route('convocations.index')}}">Convocations<span class="countList">{{\App\Models\Convocation::count()}}</span>@endcan
                    @can('travail-list') <a class="collapse-item" href="{{ route('travails.index')}}">Travaux à faire<span class="countList">{{\App\Models\Travail::count()}}</span></a>@endcan
                    @can('emploi-list')  <a class="collapse-item" href="{{ route('emploi.index')}}">Emplois<span class="countList">{{\App\Models\Emploi::count()}}</span></a>@endcan
               @can('senace_list') <a class="collapse-item" href="{{ route('seance.index')}}">Séance<span class="countList">{{\App\Models\Seance::count()}}</span></a>@endcan
               @can('information-list') <a class="collapse-item" href="{{ route('info.index')}}">Note d'info<span class="countList">{{\App\Models\Info::count()}}</span></a>@endcan

            </div>
        </div>
    </li>






<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Parents</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Liste parents:</h6>
            @can('parent-preinscrit-list')<a class="collapse-item" href="{{route('inscri.index')}}">En attente<span class="countList">{{\App\Models\Parente::where('is_active' , 0)->count()}}</span></a>@endcan
            @can('parent-inscrit-list')<a class="collapse-item" href="{{route('inscri.list_accepted')}}">Inscrits<span class="countList">{{\App\Models\Parente::where('is_active' , 1)->count()}}</span></a>@endcan
            <a class="collapse-item" href="">Rejetés</a>
        </div>
    </div>
</li>
<style>
    .countList{
        float: right;
        border: 1px ridge;
        box-shadow: 1px 1px 2px indianred;
        border-radius: 4px 4px 4px;
        padding: 1px 4px;
    }
</style>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleve"
           aria-expanded="true" aria-controls="collapseEleve">
            <i class="fas fa-fw fa-cog"></i>
            <span>Elèves</span>
        </a>
        <div id="collapseEleve" class="collapse" aria-labelledby="headingEleve" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('leve-inscrit-list')<a class="collapse-item" href="{{ route('student.index')}}">Elève Inscrits <span class="countList">{{\App\Models\Student::whereNotNull('class_id')->count()}}</span></a>@endcan
                @can('eleve-preinscrit-list')<a class="collapse-item" href="{{ route('student.elevePreInscrit')}}">Elève Pré-Inscrits <span class="countList">{{\App\Models\Student::whereNull('class_id')->count()}}</span></a>@endcan


            </div>
        </div>
    </li>





<!-- Nav Item - students -->
<!--<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Liste Elèves</span></a>
</li>-->

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Gestion Scolarite</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can('level-list')<a class="collapse-item" href="{{ route('levels.index')}}">Niveaux<span class="countList">{{\App\Models\Level::count()}}</span></a>@endcan
            @can('class_list')<a class="collapse-item" href="{{ route('classes.index')}}">Groupes</a>@endcan
            @can('module_list')<a class="collapse-item" href="{{ route('modules.index')}}">Modules</a>@endcan
           @can('matiere-list') <a class="collapse-item" href="{{ route('matieres.index')}}">Matieres<span class="countList">{{\App\Models\Matiere::count()}}</span></a>@endcan
        </div>
    </div>
</li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
           aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-fw fa-cog"></i>
            <span>Utilisateurs</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

               @can('user-list')<a class="collapse-item" href="{{route('admins') }}">liste utilisateur<span class="countList">{{App\Models\Admin::count()}}</span></a>@endcan
              @can('role-list')<a class="collapse-item" href="{{route('list') }}">rôles <span class="countList">{{Spatie\Permission\Models\Role::count()}}</span></a>@endcan
              @can('permission-list') <a class="collapse-item" href="{{route('permissions') }}">permissions<span class="countList">{{Spatie\Permission\Models\Permission::count()}}</span> </a>@endcan
                    <a class="collapse-item" href="{{route('all') }}">Permission matrix </a>



            </div>
        </div>
    </li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="">Login</a>
            <a class="collapse-item" href="">Register</a>
            <a class="collapse-item" href="">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="">404 Page</a>
            <a class="collapse-item" href="">Blank Page</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('inscri.index')}}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Liste inscriptions</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
