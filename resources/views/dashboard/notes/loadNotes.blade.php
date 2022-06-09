<form id="note-form" method="post" action="javascript:void(0)">
    @csrf
    <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
    <input type="hidden" name="trimestre" value="{{ $trimestre }}">


<table class="table table-hover" id="dynamic-table">
    <thead>
    <tr>
        <th><h2></h2></th>
        <th><h5>{{__("Eléve")}}</h5></th>
        <th><h5>{{__("Note")}} </h5></th>
    </tr>
    </thead>
    <tbody id="tbody_content_classe_eleve_note">
    @foreach($students as $student)
        <?php $note = \App\Models\Note::where('matiere_id',$lesson_id)->Where('trimestre',$trimestre)->Where('student_id',$student->id)->first(); ?>
    <tr>
        <td>
            <h5> N° {{ $student->id }}</h5>
        </td>
        <td>
            <h6>
                {{ $student->nomEleve }}   {{ $student->prenomEleve	 }}
            </h6>

        </td>

        <td>
            <div class="form-group">
                <div class="input-group">
                  <input type="hidden" name="student[{{$loop->index}}][note_id]" value="{{ $note->id ?? -1 }}">
                    <input type="hidden" name="student[{{$loop->index}}][student_id]" value="{{ $student->id }}">
                    <input name="student[{{$loop->index}}][note]"  type="number" step="0.01" min="0" value="{{ $note->note ?? '0' }}"
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
        <button id="send_form" class="btn btn-primary" type="submit">{{ __('Enregistrer')}}</button>
    </div>
</form>
