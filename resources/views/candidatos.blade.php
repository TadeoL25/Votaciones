<x-app-layout>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Lista de candidatos</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Votos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidatos as $candidato)
                                    <tr>
                                        <td>{{ $candidato->nombre }}</td>
                                        <td>{{ $candidato->direccion }}</td>
                                        <td>{{ $candidato->telefono }}</td>
                                        <td>{{ $candidato->votos }}</td>
                                        <td>
                                            <button class="btn btn-warning" onclick="editar({{ $candidato->id }}, '{{ $candidato->nombre }}', '{{ $candidato->direccion }}', '{{ $candidato->telefono }}')">Editar</button>
                                            <button class="btn btn-danger" onclick="eliminar({{ $candidato->id }})">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCandidato">Agregar candidato</button>
                </div>
            </div>
        </div>


        <!-- Modal Agregar Candidato -->
        <div class="modal fade" id="modalAgregarCandidato" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">Agregar nuevo candidato</div>
                    <form action="{{ Route('candidato.nuevo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <label for="" class="mx-3 mt-2">Nombre</label>
                            <input type="text" name="nombre" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Dirección</label>
                            <input type="text" name="direccion" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Teléfono</label>
                            <input type="text" name="telefono" id="" class="form-control my-2 rounded">
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Editar Candidato -->
        <div class="modal fade" id="editarCandidato" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Editar Candidato
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editarCandidatoForm" action="{{ route('candidato.editar', $candidato->id) }}"
                        method="POST">
                        @csrf
                        <div class="container">
                            <label for="" class="mx-3 mt-2">Nombre</label>
                            <input type="text" name="nombre" id="editarNombre" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Dirección</label>
                            <input type="text" name="direccion" id="editarDireccion"
                                class="form-control my-2 rounded">
                            <label for="" class="mx-3">Teléfono</label>
                            <input type="text" name="telefono" id="editarTelefono"
                                class="form-control my-2 rounded">
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black">Enviar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editar(id, nombre, direccion, telefono) {
            $('#editarNombre').val(nombre);
            $('#editarDireccion').val(direccion);
            $('#editarTelefono').val(telefono);

            var url = "{{ route('candidato.editar', ':id') }}";
            url = url.replace(':id', id);

            //alert(url);

            $('#editarCandidatoForm').attr('action', url);
            $('#editarCandidato').modal('show');
        }
    </script>

    <script>
        function eliminar(id) {
            url = "{{ route('candidato.eliminar', ':id') }}";
            url = url.replace(':id', id);

            window.location.href = url;
        }
    </script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</x-app-layout>