<form action="{{ route('levels.destroy', $niveau->id) }}" method="post">
@csrf
@method('DELETE')
    <div class="modal fade" id="ModalDelete{{$niveau->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Supprimer niveau')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body"> Vous etes sur pur supprimer <b>{{$niveau->id}}</b>?</div>
<div class="modal-footer">
    <button type="button" class="btn gray btn-outline-secondary" data-dismiss="modal">{{ __('Annuler')}}</button>
    <button type="button" class="btn  btn-outline-danger" >Supprimer</button>

</div>
</div>
</div>
</div>
</form>