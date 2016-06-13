		<div class="modal fade" id="modalRealizarSaque">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title">Solicitar Saque</h4>
					</div>
					<div class="modal-body">
						<p class="politica">Olá, {{explode(' ', Auth::user()->name)[0]}}! Para solicitar o saque é necessário preencher o formulário abaixo:</p>
				{!!Form::open(array('url'=>'/configuracoes/sacar', 'files'=>'true')) !!}
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="idHistoria" value="{{$historia->id}}">
				<input type="hidden" name="valor" value="{{$historia->arrecadado - $saquesAtendidosTotal}}">
				<div class="row control-group">
                        <div class="form-group col-xs-12">
                            <label> Banco: </label>
                            <select class="form-control" name="banco">
                            	<option value="Caixa Economica Federal">Caixa Econômica Federal</option>
                            	<option value="Banco do Brasil">Banco do Brasil</option>
                            	<option value="Banco Itau">Banco Itau</option>
                            	<option value="Banco Santander">Santander</option>
                            </select>                        
                        </div>
                    </div>						

					<div class="caixa">
						<div class="row control-group">
	                        <div class="form-group col-xs-12">
	                            <label> Titular da Conta: </label>
	                            <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">                        
	                        </div>
	                    </div>
	                    <div class="row control-group">
	                        <div class="form-group col-xs-2">
	                            <label> Agencia: </label>
	                            <input type="text" id="agencia" class="form-control" name="agencia" >                        
	                        </div>
	                        <div class="form-group col-xs-3">
	                            <label> Conta: </label>
	                            <input type="text" class="form-control" name="conta" >                        
	                        </div>
	                        <div class="form-group col-xs-7">
	                            <label> Operação: </label>
	                            <select class="form-control" name="operacao" >
	                            	<option value="corrente">Conta Corrente</option>
	                            	<option value="poupanca">Conta Poupança</option>
	                            	<option value="facil">Conta Facil</option>
	                            	<option value="empresarial">Conta Empresarial</option>

	                            </select>
	                        </div>
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