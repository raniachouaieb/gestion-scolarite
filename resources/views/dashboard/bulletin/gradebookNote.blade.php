<div class="row" style="display: -webkit-box;">

    <div class="col-md-4" style="text-align: center">

        <h2>
            المدرسة الإبتدائيةالخاصة <br>أكادمية المعرفة
        </h2>

    </div>

    <div class="col-md-4" style=" text-align: center;">
        <center><img src="{{asset('assets/uploads/logo-acad.png')}}" style="padding-right: 10%;" width="59%" alt="logoAcad">
        </center>
    </div>

    <div class="col-md-4" style="text-align: center">

        <h2>
            المندوبيّة الجهويّة للتّربية<br> بالمنستير
        </h2>
    </div>
</div>
<div class="row" style="display: -webkit-box;">
    <div class="col-md-6" style="text-align: right;padding-right: 22%;margin-top: 22px;text-align: center;">
        <h3> 20 .. / 20 .. : السّنة الدّراسيّة </h3>

        @if($trimester==1)
            <label class="m-0 p-2" style=" text-align: center;   font-size: 18px;display: block;">
                <center><strong> الثّلاثي الأول</strong></center>
            </label>

        @elseif($trimester==2)
            <label class="m-0 p-3" style=" text-align: center;    font-size: 18px;display: block;">
                <center><strong> الثّلاثي الثاني </strong></center>
            </label>

        @elseif($trimester==3)
            <label class="m-0 p-2" style="   text-align: center;  font-size: 18px;display: block;">
                <center><strong> الثّلاثي الثالث </strong></center>
            </label>
        @endif

    </div>

    <div class="col-md-6"
         style="text-align: center;margin-top: 22px; padding-left: 15%;font-family: DejaVu Sans, sans-serif;">
        <h3> {{$eleve->nomEleve}} {{$eleve->prenomEleve}} : التلميذ(ة) </h3>
        <h3>{{$eleve->class->level->level}} {{$eleve->class->name}} : القسم </h3>
    </div>
</div>
<div class="row" style="display: -webkit-box;">
    <div class="col-md-5">
        @foreach($modules->where('basicStudy',1) as $module)
            <?php
            $tabMaxMin = array();

            $studentsoflevel = \App\Models\Student::where('niveau', $eleve->niveau)->where('class_id', $eleve->class_id)->get();

            foreach ($module->matieres as $matiere) {
                $tab = array();
                $notStud = 0;
                foreach ($studentsoflevel as $studNote) {
                    foreach ($studNote->notes->where('matiere_id', $matiere->id)->where('trimestre', $trimester) as $notStd) {
                        $notStud = $notStd->note;
                    }
                    array_push($tab, $notStud);
                }

                $nbrMax = max($tab);
                $nbrMin = min($tab);

                array_push($tabMaxMin, array($nbrMin, $nbrMax));

            }
            ?>
            <div class="">
                <div class="headTable">
                    <table>
                        <thead>
                        <tr style="text-align: center;">
                            <th style=" color: white;text-align: center;">{{$module->nom_module}}</th>
                        </tr>

                        </thead>
                    </table>
                </div>
            </div>

            <div class="" style="margin:5px">
                <div class="row">
                    <div class="col-md-4">
                        {!! \App\Helpers\GradebookTableHelper::tableMaxMin($tabMaxMin) !!}

                    </div>
                    <div class="col-md-8">

                        <table class="table">

                            <thead>
                            <tr style="text-align: center; ">
                                <th scope="col" style="font-family: DejaVu Sans, sans-serif; direction: rtl;">توصيات
                                    المدرّس (ة)
                                </th>
                                <th scope="col" style="font-family: DejaVu Sans, sans-serif;">20/العدد</th>
                                <th scope="col"
                                    style="background: #0cace099;font-family: DejaVu Sans, sans-serif; color: white;border-top-right-radius: 50px 50px;overflow: hidden;-webkit-box-shadow: 0 0 1px 0 rgba(0,0,0,.15);border: 0;">
                                    المادّة
                                </th>
                            </tr>

                            </thead>
                            <tbody style="text-align: center;border:2px">
                            <?php $moyenneModule = \App\Models\moduleMoyenne::where('module_id', $module->id)->Where('trimestre', $trimester)->Where('student_id', $eleve->id)->first(); ?>
                            <?php
                            if (isset($moyenneModule)) {
                                $remarkModule = \App\Models\RemarqueModule::where('id', $moyenneModule->remarque_note_id)->first();
                            } else {
                                $remarkModule = "--";
                            }
                            ?>
                            <?php $nbrMat = \App\Models\Matiere::where('module_id', $module->id)->count(); ?>

                            <tr>


                                <td scope="col" style="font-family: DejaVu Sans, sans-serif;"
                                    rowspan="{{$nbrMat}}">{{$remarkModule['value'] ?? '--' }}</td>


                                @foreach($module->matieres as $matiere)
                                    <?php $note = \App\Models\Note::where('matiere_id', $matiere->id)->Where('trimestre', $trimester)->Where('student_id', $eleve->id)->first();
                                    ?>

                                    <td scope="col">{{$note->note ?? '0' }}</td>
                                    <td scope="col"
                                        style="background: #0cace099 !important;font-family: DejaVu Sans, sans-serif; color: white;">{{$matiere->nom}}</td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr style=" text-align: center;">
                        <th colspan="2">
                            {{$moyenneModule->moyenne ?? '--'}}
                        </th>
                        <th style="color:white;background: #0cace099 !important;">
                            الضارب <br> {{$module->coefficient_module}}
                        </th>
                        <th colspan="2" style=" color: white;background: #0cace099 !important;text-align: center">
                            معدّل المجال
                        </th>

                    </tr>
                    </thead>

                </table>
            </div>


            <?php
            $tabMaxMinMoy = array();

            $tabMaxMinMoyGeneral = array();

            $MoyStud = 0;
            $basicMoyStd = 0;
            $studentsoflevel = \App\Models\Student::where('niveau', $eleve->niveau)->where('class_id', $eleve->class_id)->get();
            $MoyenneBulletin2 = \App\Models\Bulletin::where('trimestre', $trimester)->get();
            $tabMoy = array();$tabBasicMoy = array();
            foreach ($studentsoflevel as $studNote) {
                foreach ($MoyenneBulletin2->where('student_id', $studNote->id) as $MoyenStd) {
                    $MoyStud = $MoyenStd->moyenne;
                    $basicMoyStd = $MoyenStd->basicmoyenne;
                }
                array_push($tabMoy, $MoyStud);
                array_push($tabBasicMoy, $basicMoyStd);
            }
            $nbrMaxMoy = max($tabMoy);
            $nbrMinMoy = min($tabMoy);

            $nbrMaxbMoy = max($tabBasicMoy);
            $nbrMinbMoy = min($tabBasicMoy);

            array_push($tabMaxMinMoy, array($nbrMinMoy, $nbrMaxMoy));
            array_push($tabMaxMinMoyGeneral, array($nbrMinbMoy, $nbrMaxbMoy));

            ?>
                {!! \App\Helpers\GradebookTableMoyenHelper::tableMaxMinMoyenne($tabMaxMinMoy,($MoyenneBulletin->basicmoyenne ?? 0),($MoyenneBulletin->moyenne ?? 0),$tabMaxMinMoyGeneral) !!}
        @endforeach


        <table class="table">
            <thead>
            <tr style="background-color: #0cace099 !important;color:white;text-align: center;">
                <th>
                    مدير(ة) المدرسة
                </th>
            </tr>
            </thead>
            <tbody>
            <tr style="font-weight: bold; text-align: center;">

                <td rowspan="2">

                </td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr style="background-color: #0cace099 !important;color:white;text-align: center;">
                <th>
                    إمضاء الولي
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>

                </td>

            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">

        @foreach($modules->where('basicStudy',0) as $module)
            <?php
            $tabMaxMin = array();

            $studentsoflevel = \App\Models\Student::where('niveau', $eleve->niveau)->where('class_id', $eleve->class_id)->get();

            foreach ($module->matieres as $matiere) {
                $tab = array();
                $notStud = 0;
                foreach ($studentsoflevel as $studNote) {
                    foreach ($studNote->notes->where('matiere_id', $matiere->id)->where('trimestre', $trimester) as $notStd) {
                        $notStud = $notStd->note;
                    }
                    array_push($tab, $notStud);
                }
                $nbrMax = max($tab);
                $nbrMin = min($tab);

                array_push($tabMaxMin, array($nbrMin, $nbrMax));

            }
            ?>
            <div class="">
                <div class="headTable">
                    <table>
                        <thead>
                        <tr style="text-align: center;">
                            <th style=" color: white;text-align: center;">{{$module->nom_module}}</th>
                        </tr>

                        </thead>
                    </table>
                </div>
            </div>

            <div class="" style="margin:5px">
                <div class="row">
                    <div class="col-md-4">
                        {!! \App\Helpers\GradebookTableHelper::tableMaxMin($tabMaxMin) !!}
                    </div>
                    <div class="col-md-8">

                        <table class="table">
                            <thead>
                            <tr style="text-align: center; ">
                                <th scope="col" style="font-family: DejaVu Sans, sans-serif; direction: rtl;">توصيات
                                    المدرّس (ة)
                                </th>
                                <th scope="col" style="font-family: DejaVu Sans, sans-serif;">20/العدد</th>
                                <th scope="col"
                                    style="background: #0cace099;font-family: DejaVu Sans, sans-serif; color: white;border-top-right-radius: 50px 50px;overflow: hidden;-webkit-box-shadow: 0 0 1px 0 rgba(0,0,0,.15);border: 0;">
                                    المادّة
                                </th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center;border:2px">
                            <?php $moyenneModule = \App\Models\moduleMoyenne::where('module_id', $module->id)->Where('trimestre', $trimester)->Where('student_id', $eleve->id)->first(); ?>
                            <?php
                            if (isset($moyenneModule)) {
                                $remarkModule = \App\Models\RemarqueModule::where('id', $moyenneModule->remarque_note_id)->first();
                            } else {
                                $remarkModule = "--";
                            }
                            ?>
                            <?php $nbrMat = \App\Models\Matiere::where('module_id', $module->id)->count(); ?>

                            <tr>


                                <td scope="col" style="font-family: DejaVu Sans, sans-serif;"
                                    rowspan="{{$nbrMat}}">{{$remarkModule['value'] ?? '--' }}</td>


                                @foreach($module->matieres as $matiere)
                                    <?php $note = \App\Models\Note::where('matiere_id', $matiere->id)->Where('trimestre', $trimester)->Where('student_id', $eleve->id)->first();
                                    ?>

                                    <td scope="col">{{$note->note ?? '0' }}</td>
                                    <td scope="col"
                                        style="background: #0cace099 !important;font-family: DejaVu Sans, sans-serif; color: white;">{{$matiere->nom}}</td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr style=" text-align: center;">
                        <th colspan="2">
                            {{$moyenneModule->moyenne ?? '--'}}
                        </th>
                        <th style="color:white;background: #0cace099 !important;">
                            الضارب <br> {{$module->coeff}}
                        </th>
                        <th colspan="2" style=" color: white;background: #0cace099 !important;text-align: center">
                            معدّل المجال
                        </th>

                    </tr>
                    </thead>

                </table>
            </div>

        @endforeach

    </div>
</div>



