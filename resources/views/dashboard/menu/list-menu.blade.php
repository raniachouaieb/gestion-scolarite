@extends('layouts.app-admin')

@section('title', $title)
@section('content')
<style>
    .position{
        float:  right;
        margin-right: 10px;
    }
    .container{

        display: flex;
        justify-content: center;
        margin: 40px 0;

    }

    .grid{
        margin: 25px;
        display: grid;
        grid-gap: 30px;
        grid-template-colums: repeat(3,  1fr);
        align-items: center;

    }

    .article{
        background: #eee5e9;
        border: none;
        box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
        border-radius: 20px;
        transition: transform .3s;
        width: 337px;
        text-align: center;
        height: 490px;
        padding: 9px;

    }

    .pos{
        margin: 0;
        width: 400px;
        text-align: center;

    }

    .article:hover{
        transform: translateY(5px);
        box-shadow: 2px 2px 26px 0px rgba(0,0,0,0.3);
    }
    .art{
        width: 100%;
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;

    }
    .article img {

        width:  300px;
        height: 200px;
    }

    .text{
       padding: 0 20px 20px ;
    }

    .text h3{
        text-transform: uppercase;
    }
    .btn-rania{
        background: #ef6f6c;
        border-radius: 20px;
        border:none;
        color:#fff;
        padding: 10px;
        width: 100px;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>




<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Menu</li>

    </ol>
</nav>
<a  class="btn btn-outline-primary position" href="{{ route('menu.addMenu')}}"><i class="fas fa-plus"></i> Ajouter </a>

        <div class="container">



            <div class="grid">
                <div class="row">
                    @foreach($menu as $menu)

                        <div class="col-4 mb-5">
                            <div class="article">
                                <img class="art" src="{{asset('assets/'.$menu->image)}}"  alt="image">
                                    <div class="text">
                                        <h3>{{$menu->jour}} {{$menu->date}} </h3>
                                        <p>{!! $menu->menu !!}</p>

                                         <a class=" btn btn-danger btn-rania" href="{{ route('menu.editMenu', $menu->id)}}">Modifier</a>
                                    </div>

                            </div>
                        </div>

                    @endforeach
                </div>
            </div>



         </div>




@endsection
