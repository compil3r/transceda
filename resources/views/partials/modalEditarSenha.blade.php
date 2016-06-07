<div class="modal fade" id="modalEditarSenha">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Editar Perfil</h4>
			</div>
			<div class="modal-body">
               {!!Form::open(array('url'=>'/configuracoes/atualizar-senha', 'files'=>'true')) !!}

               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="row control-group">
                <div class="form-group col-xs-12">
                <label> Senha Atual: </label>
                    <input type="password" class="form-control" name="atual" >                        
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12">
                    <label> Nova Senha: </label>
                    <input type="password" class="form-control" name="senha" >                        
                </div>
            </div>

            <div class="row control-group">
                <div class="form-group col-xs-12">
                    <label> Confirme Nova Senha: </label>
                    <input type="password" class="form-control" name="confirma">                        
                </div>
            </div>

            <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Atualizar">
        </form>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->