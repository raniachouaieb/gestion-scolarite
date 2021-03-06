<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Academia <sup></sup></div>
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
                @can('convocation-list') <a class="collapse-item" href="{{ route('convocations.index')}}">Convocations<span class="countList">{{\App\Models\Convocation::count()}}</span></a>@endcan
                    @can('travail-list') <a class="collapse-item" href="{{ route('travails.index')}}">Travaux à faire<span class="countList">{{\App\Models\Travail::count()}}</span></a>@endcan
                    @can('emploi-list')  <a class="collapse-item" href="{{ route('schedule.admin.index')}}">Emplois<span class="countList">{{\App\Models\Emploi::count()}}</span></a>@endcan
               @can('senace_list') <a class="collapse-item" href="{{ route('seance.index')}}">Séance<span class="countList">{{\App\Models\Seance::count()}}</span></a>@endcan
               @can('information-list') <a class="collapse-item" href="{{ route('info.index')}}">Note d'info<span class="countList">{{\App\Models\Info::count()}}</span></a>@endcan
                <a class="collapse-item" href="{{ route('attendance')}}">Absence</a>


            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBulletin"
           aria-expanded="true" aria-controls="collapseBulletin">
            <i class="fa fa-book"></i>
            <span>Bulletin</span>
        </a>
        <div id="collapseBulletin" class="collapse" aria-labelledby="headingBulletin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

               @can('note') <a class="collapse-item" href="{{route('note.admin.index')}}">Notes</a>@endcan
@can('list-remarque')<a class="collapse-item" href="{{route('remarqueModule.admin.index')}}">Remarques</a>@endcan
@can('remarque-ens')<a class="collapse-item" href="{{route('teacherRemarks.admin.index')}}">Remarques Enseignant</a>@endcan

@can('calcul-moy')<a class="collapse-item" href="{{route('calculMoyenne.admin.index')}}">Calcul Moyenne</a>@endcan
 @can('bulletin')<a class="collapse-item" href="{{route('bulletin.admin.index')}}">Bulletin</a>@endcan
<a class="collapse-item" href="{{route('observation.admin.index')}}">Evaluation</a>



</div>
</div>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="{{route('notification')}}" >
<i class="fa fa-bell"></i>
<span>Push notification</span>
</a>
</li>







<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-users"></i>
<span>Parents</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">Liste parents:</h6>
<a class="collapse-item" href="{{route('inscri.add')}}">Ajouter Parent</a>
@can('parent-preinscrit-list')<a class="collapse-item" href="{{route('inscri.index')}}">En attente<span class="countList">{{\App\Models\Parente::where('is_active' , 0)->count()}}</span></a>@endcan
@can('parent-inscrit-list')<a class="collapse-item" href="{{route('inscri.list_accepted')}}">Inscrits<span class="countList">{{\App\Models\Parente::where('is_active' , 1)->count()}}</span></a>@endcan
<a class="collapse-item" href="{{route('inscri.list_reject')}}">Rejetés<span class="countList">{{\App\Models\Parente::where('is_active' , 2)->count()}}</span></a>

<a class="collapse-item" href="{{route('listSuggestion')}}">Boite suggestions<span style="float: right; border: 1px ridge; box-shadow: 1px 1px 7px 0px indianred; border-radius: 1px 15px 14px;padding: 1px 7px;">{{\App\Models\Suggestion::count()}}</span></a>

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
<i class="fas fa-user-graduate"></i>
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
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEns"
aria-expanded="true" aria-controls="collapseEns">
<i class="fas fa-users"></i>
<span>Enseignants</span>
</a>
<div id="collapseEns" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<a class="collapse-item" href="{{route('enseignants')}}">Liste Enseignants</a>

</div>
</div>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
aria-expanded="true" aria-controls="collapseUser">
<i class="fas fa-users"></i>
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
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
