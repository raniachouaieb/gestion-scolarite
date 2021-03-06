@extends('layouts.app-admin')

@section('content')
<style>

    .cards{
        width: 100%;
        padding: 35px 20px;
        display: grid;
        grid-gap: 20px;
    }
    .cardDetail{
        padding: 21px;
        margin-top: 98px;
        width: 268px;
        display:flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 7px 25px 0 rgba(0, 0, 0, 0.08);

    }
    .cardpie{
        padding: 12rem -9rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border-radius: 10px;
        height: 420px;
    }
    .pie{
        width: 50%;
        padding: 1rem 4rem;
    }


    .cardDetail:hover{
        background: #0f6674;
    }
    .cardDetail:hover .number{
        color: #fff;
    }
    .cardDetail:hover .card-name{
        color: #fff;
    }
    .cardDetail:hover .icon-box i{
        color: #fff;
    }

    .number{
        font-size: 35px;
        font-weight: 500;
        color: #0f6674;
        margin-left: 100px;
    }
    .card-name{
        color: #888;
        font-weight: 600;
    }
    .icon-box i{
        font-size: 45px;
        color: #0f6674;
        margin-left: 10px;
    }



</style>


<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Parents pr??inscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$parentPr??inscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Eleve pr??inscrit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$elevePr??inscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                El??ve inscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$eleveInscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Parent inscrits  Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Parent inscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$parentInscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">titre</th>
                                            <th scope="col">information</th>
                                            <th scope="col">classe</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($informations as $info)
                                        <tr>
                                            <th scope="row">#{{$loop->index+1}} </th>
                                            <td>{{$info->titre}}</td>
                                            <td>{!! $info->info !!}</td>
                                            <td>@foreach($classes as $clas) @if($info->class_id == $clas->id){{$clas->name}}@endif @endforeach</td>
                                        </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
{{--                                    <div class="number">{{$informations->count()}}</div>--}}
{{--                                    <div class="card-name"> Information envoy??es</div>--}}
                                </div>
{{--                                <div class="icon-box">--}}
{{--                                    <i class="fa fa-paper-plane"></i>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">titre</th>
                                            <th scope="col">travail</th>
                                            <th scope="col">mati??re</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <th scope="row">#{{$loop->index+1}} </th>
                                                <td>{{$task->titre_travail}}</td>
                                                <td>{!! $task->detail_travail !!}</td>
                                                <td>@foreach($matieres as $mat) @if($task->matiere_id == $mat->id){{$mat->nom}}@endif @endforeach</td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                    {{--                                    <div class="number">{{$informations->count()}}</div>--}}
                                    {{--                                    <div class="card-name"> Information envoy??es</div>--}}
                                </div>
                                {{--                                <div class="icon-box">--}}
                                {{--                                    <i class="fa fa-paper-plane"></i>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>


{{--                        <div class="col-md-6">--}}

{{--                                <div class="cardDetail">--}}
{{--                                    <div class="card-content">--}}
{{--                                            <div class="number">{{$convocations->count()}}</div>--}}
{{--                                        <div class="card-name">Convocations envoy??es</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="icon-box">--}}
{{--                                        <i class="fa fa-paper-plane"></i>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                        </div>--}}





       <div class="col-md-4">
           <div class="cardpie shadow mb-4">
               <div class="card-body pie">
                   <div class="chart">
                       <canvas id="piechart" ></canvas>

                   </div>
               </div>
           </div>
       </div>
   </div>

    <div class="">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar chart</h6>
                </div>
                <div class="card-body chart">
                    <div class="chart">
                        <canvas id="barchart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Line chart</h6>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="linechart"></canvas>
                </div>


            </div>
        </div>
    </div>
    </div>



</div>

<!-- Page level plugins -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script>

    //setup bar chart
    function generateData() {
        return Utils.numbers({
            count: DATA_COUNT,
            min: 0,
            max: 100
        });
    }
    const data ={
            labels: ['Septembre', 'Octobre', 'Novembre', 'Decembre', 'Janvier', 'F??vrier', 'Mars', 'Avril', 'Mai', 'Juin'],
            datasets: [{
                label: '',
                data: [0.2, 0.1, 0.3, 0.8, 1.5, 1],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
    };
    //config bar chart
    const config = {
        type: 'bar',
        data,
        options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            format: {
                                style: 'percent'
                            }
                        }

                    }
                }
            }
    }
    //render init block
    const barchart = new Chart(
        document.getElementById('barchart'),
        config
    );

    //setup piechart
    const datapie = {
        labels: [
            'Fille',
            'Gar??on'

        ],
        datasets: [{
            label: 'My First Dataset',
            data: [JSON.parse('{!! json_encode($fille_records) !!}'), JSON.parse('{!! json_encode($garcon_records) !!}')],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',

            ],
            hoverOffset: 4
        }]
    };

    //config pie chart
    const configPie = {
        type: 'pie',
        data : datapie,
    };
    //render piechart
    const piechart = new Chart(
        document.getElementById('piechart'),
        configPie
    );

    //setup linechart
    const dataLine ={
        labels: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: '',
            data: [10, 20, 30, 40, 20, 60, 45],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    //configline
    const configLine = {
        type: 'line',
        data: dataLine,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,

                }
            }
        }
    };
    //render linechart

    const linechart = new Chart(
        document.getElementById('linechart'),
        configLine
    );

</script>




@endsection
