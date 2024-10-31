@extends('Gincana.layout.app')

@section('title', 'Gincana Participante')

@section('content')
    <h1>Lista de Equipes</h1>
    <div>
        @foreach ($equipes as $equipe)
            <ul class="list-group">
                <!-- Adicionando data-id para capturar o ID da equipe e usar no evento de clique -->
                <strong> <li id="equipe-{{ $equipe->equPk }}" 
                    class="list-group-item list-group-item-action  cursor-pointer"   
                    data-id="{{ $equipe->equPk }}" 
                    data-nome="{{ $equipe->equNome }}">
                    {{ $equipe->equNome }}
                </li></strong>
            </ul>
        @endforeach
    </div>
    

    <!-- Modal Bootstrap -->
<!-- Modal Participantes -->
<div class="modal fade" id="modal-participantes" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="showmodal">
                <h5>Participantes da equipe <span id="nome-equipe"></span></h5>
                <ol id="lista-participantes">
                   
                </ol>
                <hr>
                <div id="form-editar-participante" style="display: none;">
                    <h5>Editar Participante</h5>
                    <form id="form-participante">
                        <input type="hidden" id="participante-id">
                        <div class="form-group">
                            <label for="nome-participante">Nome</label>
                            <input type="text" class="form-control" id="nome-participante">
                        </div>
                        <div class="form-group">
                            <label for="cpf-participante">CPF</label>
                            <input type="text" class="form-control" id="cpf-participante">
                        </div>
                        <button type="button" class="btn btn-primary" id="save-participant">Salvar</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Botão Adicionar Participante que abre outro modal -->
                <button type="button" id="adcNewPar" class="btn btn-secondary" data-toggle="modal" data-target="#modal-newparticipantes">
                    Adicionar Participante
                </button>
                <!-- Botão Fechar -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Adicionar Participante -->
<div class="modal fade" id="modal-newparticipantes" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-newparticipantes" action="{{ route('adcNewPar') }}" method="post">
                @csrf
                <input type="hidden" name="equiId" id="equiId">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="adcmodalNewPar">
                    <h5>Equipe: <span id="nome-equipePar"></span></h5>
                    <input type="text" name="nomeParticipante" class="form-control" placeholder="Nome do Participante" required>
                    <input type="text" name="CPF" class="form-control" placeholder="CPF do Participante" required>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="adcParti" class="btn btn-secondary">Adicionar Participante</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@push('scripts')
    {{-- <script>
        jQuery(document).ready(function() {
            jQuery(document).on('click', '.cursor-pointer', function() {
                var ckedId = jQuery(this).attr('id');
                var equipeId = ckedId.replace('equipe-', '');
                var equipeNome =   jQuery(this).data('nome');

                $('#lista-participantes').empty();
                $('#nome-equipe').text('');

                $('#nome-equipe').text(equipeNome);

                jQuery.ajax({
                    url: '{{ route('partshowEqu') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        idEqupar: equipeId
                    }
                }).done(function(response) {

                    $.each(response, function(index, participante){
                        var itemPar = ` 
                        <li>
                            <strong> ID: </strong> ${participante.parPk} <br>
                            <strong> Nome: </strong> ${participante.parNome} <br>
                            <strong> Email: </strong> ${participante.parCPF} <br>

                        </li>`;
                     $('#lista-participantes').append(itemPar);
                    });

                    $('#modal-participantes').modal('show');

                    console.log(response);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Erro na requisição AJAX:', textStatus, errorThrown);
                });
            });
        });

    </script> --}}

    <script>
           
           jQuery('body').on('click', '.cursor-pointer', function() {
                const equipeId = $(this).attr('id').replace('equipe-', '');
                const equipNome = $(this).attr('data-nome');

                $('#lista-participantes').empty();
                $('#nome-equipePar').text(equipNome);

                console.log(equipeId);

                jQuery.ajax({ 
                    method: "GET",
                    url: "{{ route('partshowEqu') }}",
                    dataType: "json",
                    data: { idEqupar: equipeId }
                }).done((response) => {
                    $('#lista-participantes').empty();
                    
                    $.each(response, (index, participante) => {
                        const itemPar = `
                        <li>
                            <strong>ID:</strong> ${participante.parPk} <br>
                            <strong>Nome:</strong> ${participante.parNome} <br>
                            <strong>CPF:</strong> ${participante.parCPF} <br>
                            <button class="btn btn-primary btn-sm edit-participant" data-id="${participante.parPk}">Editar</button>
                            <button class="btn btn-danger btn-sm delete-participant" data-id="${participante.parPk}">Excluir</button>
                        </li>`;
                        $('#lista-participantes').append(itemPar);
                    });

                    $('#modal-participantes').modal('show');
                });     

                $('#lista-participantes').on('click', '.edit-participant', function(){
                    const participanteID = $(this).data('id');
                    console.log(participanteID);
                
                    jQuery.ajax({
                        method : "GET", 
                        url : "{{ route('edtPar') }}",
                        dataType : "json",
                        data : { idParticipante: participanteID }
                    }).done((response) => {
                        console.log(response);

                        $('#participante-id').val(participanteID);
                        $('#nome-participante').val(response.participante.parNome);
                        $('#cpf-participante').val(response.participante.parCPF);

                        $('#form-editar-participante').show();
                    }).fail(() => {
                        alert("Erro ao buscar dados do participante.");
                    });
                });

                $('#save-participant').off('click').on('click', function(){
                    salvarEdicao();
                });

                function salvarEdicao(){
                    console.log("Função salvarEdicao chamada");
                    const participanteID = $('#participante-id').val();
                    const participanteNome = $('#nome-participante').val();
                    const participanteCpf = $('#cpf-participante').val();

                    console.log("Nome:", participanteNome);

                    $.ajax({
                        method : "PUT",
                        url  : "{{ route('saveEdit') }}",
                        dataType : "json",
                        data : {
                        idParticipante : participanteID,
                        nomeParticipante : participanteNome,
                        cpfParticipante : participanteCpf
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            console.log("Enviando dados:", {
                                idParticipante: participanteID,
                                nomeParticipante: participanteNome,
                                cpfParticipante: participanteCpf
                            });
                        }
                    }).done((response) => {
                        console.log(response);
                        $('#form-editar-participante').hide();
                        $('#modal-participantes').modal('hide');
                        toastr.success("Participante atualizado com sucesso!");
                    }).fail(() => {
                        toastr.error("Erro ao atualizar o participante.");
                    });
                }

                $('#lista-participantes').on('click', '.delete-participant', function(){
                    const participanteID = $(this).data('id');
                    console.log('deletar usuario ??');

                    
                    jQuery.ajax({
                        method : "DELETE",
                        url : "{{ route('deletePar') }}",
                        dataType : "json",
                        data : {
                            idPar : participanteID
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    }).done((response) => {
                        console.log(response);
                        $('#form-editar-participante').hide();
                        $('#modal-participantes').modal('hide');
                        toastr.success("Participante deletado com sucesso!");
                    }).fail(() => {
                        toastr.error("Erro ao deletar o participante."); 
                    });

                });

                    jQuery('#adcNewPar').off('click').on('click', function () {

                        $('#form-newparticipantes')[0].reset();
                        $('#equiId').val(equipeId);
                    
                        $('#adcParti').prop('disabled', false).text('Adicionar Participante'); 
                        $('#modal-newparticipantes').modal('show');
                    });
                });

            $('#form-newparticipantes').on('submit', function (e) {
                e.preventDefault();
                jQuery.ajax({
                    method: "POST",
                    url: "{{ route('adcNewPar') }}",
                    dataType: "json",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#adcParti').prop('disabled', false).text('Adicionar Participante');
                        toastr.success('Participante adicionado com sucesso!', 'Sucesso');

                          $('#modal-newparticipantes').modal('hide');
                          $('#modal-participantes').modal('hide');                 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro ao adicionar participante:', textStatus, errorThrown);
                    }
                });
            });

    </script>
@endpush
