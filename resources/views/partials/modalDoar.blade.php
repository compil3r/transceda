<div class="modal fade" id="modalDoar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Realizar Doacao</h4>
      </div>
      <div class="modal-body">
        <div class="row row-centered">
        <form enctype="multipart/form-data" class="form" role="form" method="POST" action="/pagar">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="cidade" value="{{Auth::user()->cidade->nome}}">
            <input type="hidden" name="estado" value="{{Auth::user()->cidade->estado->uf}}">
            <input type="hidden" name="nome" value="{{Auth::user()->name}}">
            <input type="hidden" name="cpf" value="{{Auth::user()->cpf}}">
            <input type="hidden" name="email" value="{{Auth::user()->email}}">
            <input type="hidden" name="nascimento" value="{{Auth::user()->aniversario}}">
            <input type="submit">
        </form>
        </div>

      </div>

    </div>
  </div>
</div>