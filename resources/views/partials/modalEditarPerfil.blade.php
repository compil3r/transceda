<div class="modal fade" id="modalEditarPerfil">
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
	{!!Form::open(array('url'=>'/configuracoes/perfil', 'files'=>'true')) !!}
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="row control-group">
                        <div class="form-group col-xs-12">
                            <label> Nome: </label>
                            <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">                        
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-6">
                            <label> CPF: </label>
                            <input type="text" id="cpf" class="form-control" name="cpf" value="{{Auth::user()->cpf}}">                        
                        </div>
                        <div class="form-group col-xs-6">
                            <label> Nascimento: </label>
                            <input type="date" class="form-control" name="aniversario" value="{{date('Y-m-d', strtotime(Auth::user()->aniversario))}}">                        
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-6 col-md-6 ">
                            <label> Estado: </label>
                            <select name="estado" class="form-control" size="1" placeholder="Teste">
                                <option value="">  </option>
                                @foreach ($estados as $estados)
                                @if ((Auth::user()->cidade->estado->id) == $estados->id) 
                                	<option value="{{$estados->id}}" selected>{{$estados->uf}}</option>
                                @else
                                	<option value="{{$estados->id}}">{{$estados->uf}}</option>
                                @endif
                                @endforeach
                            </select>                        
                        </div>
                        <div class="form-group col-xs-6 left">
                            <label> Cidade: </label>
                            <select name="cidade" class="form-control" size="1" placeholder="Teste">
                                <option value=""> </option>
                            </select>                     
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12">
                            <label> Email: </label>
                            <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">                        
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