    <div class="row">
        <div class="container-fluid mt-5">
            <div class="card">
                <div class="card-header">
                    <h6>Cadastro de cliente</h6>
                </div>
            </div>
            <div class="card-body">
                <cliente-form :erros="{{ $errors ?? '' }}" edit="{{ $edit ?? '' }}"></cliente-form>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <input type="submit" class="btn btn-success" value="Salvar">
                    @if(isset($edit))
                    <a class="ml-2 btn btn-danger" href="{{ route('cliente.index') }}">
                        Voltar
                    </a>
                    @endif
                </div>
            </div>
        </div>
        </form>
    </div>