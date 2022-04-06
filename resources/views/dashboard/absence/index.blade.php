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


    @foreach($eleveByClass as $getstudent)

        <div id="lgDemo">
            <div class="item ">{{$getstudent->nomEleve}} {{$getstudent->prenomEleve}}
                <label class="">Date</label>

            </div>



        </div>



    @endforeach






</div>

