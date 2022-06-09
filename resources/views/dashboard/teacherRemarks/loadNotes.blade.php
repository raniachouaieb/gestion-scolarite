<form id="note-form" method="post" action="{{route('teacherRemarks.admin.store', ['id'=>'-1']) }}">
    @csrf
    <input type="hidden" name="module_id" value="{{ $module_id }}">
    <input type="hidden" name="trimestre" value="{{ $trimestre }}">

    <table class="table table-hover" id="dynamic-table">
        <thead>
        <tr>
            <th><h2></h2></th>
            <th><h2>{{ __('Student')}}</h2></th>
            <th><h2>{{ __('Moyenne')}}</h2></th>
            <th><h2>{{ __('Remark')}}</h2></th>
        </tr>
        </thead>
        <tbody id="tbody_content_classe_eleve_note">
        @foreach($students as $student)
            <?php $module = \App\Models\moduleMoyenne::where('module_id',$module_id)->Where('trimestre',$trimestre)->Where('student_id',$student->id)->first(); ?>
            <tr>
                <td>
                    <h5> N° {{ $student->id }}</h5>
                </td>
                <td>
                    <h5>
                        {{ $student->nomEleve }}   {{ $student->prenomEleve	 }}
                    </h5>

                </td>

                <td> {{ isset($module->moyenne)? $module->moyenne:'--'  }}</td>
                <td>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" name="student[{{$loop->index}}][module_id]" value="{{ $module->id ?? -1 }}">
                            <input type="hidden" name="student[{{$loop->index}}][student_id]" value="{{ $student->id }}">
                            <select name="student[{{$loop->index}}][remarque_note_id]" class="form-control"  required>
                                <option value="">{{ __(' Please Select ')}}</option>
                                @foreach ($remarques as $remarque)
                                    <option value="{{$remarque->id}}" {{isset( $module) && $module->remarque_note_id == $remarque->id  ? 'selected' : ''}}>{{ $remarque->value}} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </td>
                <td></td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <span></span>
        <button id="send_form" class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
    </div>
</form>
