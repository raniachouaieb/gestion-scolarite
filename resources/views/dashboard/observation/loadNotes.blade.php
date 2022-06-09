<form id="note-form" method="post" action="javascript:void(0)">
    @csrf
    <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
    <input type="hidden" name="trimestre" value="{{ $trimestre }}">


<table class="table table-hover" id="dynamic-table">
    <thead>
    <tr>
        <th><h2></h2></th>
        <th><h2>{{__("Student")}}</h2></th>
        <th><h2>{{__("Note")}} </h2></th>
    </tr>
    </thead>
    <tbody id="tbody_content_classe_eleve_note">
    @foreach($students as $student)
        <?php $evaluation = \App\Models\Observation::where('lesson_id',$lesson_id)->Where('trimester',$trimestre)->Where('student_id',$student->id)->where('obs',$maxobs)->first(); ?>
    <tr>
        <td>
            <h4> N° {{ $student->id }}</h4>
        </td>
        <td>
            <h5>
                {{ $student->nomEleve }}   {{ $student->prenomEleve	 }}
            </h5>

        </td>

        <td>

            <div class="form-group">
                <div class="input-group">
                  <input type="hidden" name="student[{{$loop->index}}][observation_id]" value="{{ $evaluation->id ?? -1 }}">
                    <input type="hidden" name="student[{{$loop->index}}][student_id]" value="{{ $student->id }}">
                    <input name="student[{{$loop->index}}][observation]"  type="number"  min="0" value="{{isset($evaluation->valeur)?$evaluation->valeur:0}}"
                                                max="20" class="form-control" placeholder=""
                                                style="text-align: center;width:100px;max-width:100px"></div>
            </div>
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
    <div class="d-flex justify-content-between">
        <span></span>
        <button id="send_form" class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
    </div>
</form>
