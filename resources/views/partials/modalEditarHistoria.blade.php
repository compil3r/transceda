<div class="modal fade" id="modalEditarHistoria">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Editar História</h4>
			</div>
			<div class="modal-body">
	{!!Form::open(array('url'=>'/configuracoes/atualizar-historia', 'files'=>'true')) !!}
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="row control-group">
					<div class="form-group col-xs-6">
						<label>Meta: (R$)</label>
						<input onKeyUp="maskIt(this,event,'### ### ###.##',true)" type="text" id="meta" class="form-control" name="meta" placeholder="R$ 0,00" required data-validation-required-message="Por favor, entre com sua meta" value="{{$historia->meta}}">
						<p class="help-block text-danger"></p>
					</div>

					<div class="form-group col-xs-6">
						<label>Finalidade:</label>
						<input type="text" id="objetivo" class="form-control" name="objetivo" placeholder="Objetivo" required data-validation-required-message="Por favor, entre com seu objetivo" value="{{$historia->finalidade}}">
						<p class="help-block text-danger"></p>							
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12">
						<label>Sua história</label>
						<textarea placeholder="Conte sua história com mais detalhes!" class="form-control" name="historia" id="historia">{{$historia->descricao}}</textarea>
						<span id="msg"></span>
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