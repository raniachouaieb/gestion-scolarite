<style>

    #lgDemo {
        display: grid;
        grid-template-columns: 100%;
        grid-gap: 5px;
    }
    #lgDemo .item {
        padding: 30px;
        border: 1px solid #ddd;
    }
    #lgDemo .item:nth-child(odd) { background: #f7f7f7; }

    </style>
<div class="container">
    <h5 style="font-family: 'Cairo', sans-serif;color: red;margin-top: 50px;margin-left: 16px;">Date d'absence: {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{route('absence.store')}}">
         @csrf
        <div class="table-responsive " style="margin-top: 24px;">

            <table class="table table-striped">
                <thead class="bg-primary">
                    <tr>
                        <td>Nom</td>
                        <td>Prenom</td>
                        <td colspan="2">Etat</td>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($eleveByClass as $getstudent)
                            <tr>
                                <td>{{$getstudent->nomEleve}}</td>
                                <td>{{$getstudent->prenomEleve}}</td>
                                <td>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1"  checked   id="switch{{$getstudent->id}}" name="status[{{$getstudent->id}}]" >
                                            <label class="custom-control-label" for="switch{{$getstudent->id}}">Status</label>
                                        </div>


                                   <input  name="eleve_id[]" value="{{$getstudent->id}}">
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-outline-info  px-4">Enregistrer</button>

    </form>

</div>

