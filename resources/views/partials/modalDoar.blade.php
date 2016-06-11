<div class="modal fade" id="modalDoar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center><h2 class="modal-title" id="myModalLabel">Qual sua contribuição?</h2></center>
      </div>
      <div class="modal-body">
        <div class="row row-centered">
        <form enctype="multipart/form-data" class="form" role="form" method="POST" action="/pagar">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="cidade" value="{{Auth::user()->cidade->nome}}">
            <input type="hidden" name="estado" value="{{Auth::user()->cidade->estado->uf}}">
            <input type="hidden" name="doador" value="{{Auth::user()->id}}">
            <input type="hidden" name="recebedor" value="{{$historia->autor->id}}">
            <input type="hidden" id="historia" name="historia" value="{{$historia->id}}">
            <input type="hidden" name="cpf" value="{{Auth::user()->cpf}}">
            <input type="hidden" name="email" value="{{Auth::user()->email}}">
            <input type="hidden" name="nascimento" value="{{Auth::user()->aniversario}}">
            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">R$0</div>
            <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9"><input type="range" id="valor" value="0" name="valor" min="0" max="{{$falta}}"></div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">R${{$falta}}</div>
            <h1 class="contribuicao" align="center" id="resultado">R$0</h1>
            <input class="btn btn-default btn-large btn-block doar" type="submit" value="Contribuir com essa história">
        </form>
        </div>
  
      </div>

    </div>
  </div>
</div>
