<x-app-layout>
    <div class="container my-2">
        <div class="row">
            @if(session('error'))
                        <div class="alert alert-danger" id="error-alert">{{ session('error') }}</div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('error-alert').remove();
                            }, 3000);
                        </script>
                    @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Lista de votaciones</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Candidato</th>
                                    <th>Fecha de inicio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($votaciones as $votacion)
                                    <tr>
                                        <td>{{ $votacion->candidato }}</td>
                                        <td>{{ $votacion->created_at }}</td>
                                        <td>
                                            @if(Auth::user()->role == 'admin')
                                            <button class="btn btn-danger" onclick="eliminar({{ $votacion->id }})">Eliminar</button>
                                            @endif

                                            @if (Auth::user()->voto == 'no' && Auth::user()->role != 'admin')
                                                <button class="btn btn-success" onclick="votar({{ $votacion->id }})">Votar</button>
                                            @endif

                                            @if(Auth::user()->voto == 'si' && Auth::user()->role != 'admin')
                                                Ya votaste :D
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        @if(Auth::user()->role == 'admin')
                        <a href="{{ route('votaciones.nuevo') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarVotacion">Crear votación</a>
                        @endif

                        @if(Auth::user()->voto == 'si')
                        <a href="{{ route('estadisticas.inicio') }}" class="btn btn-primary">Ver estadísticas</a>
                        @endif
                    </div>
                </div>
            </div>  
    </div>

    <div class="modal fade" id="modalAgregarVotacion" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">Agregar nueva votación</div>
                    <form action="{{ Route('votaciones.nuevo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <!-- select para seleccionar le nombre de los candidatos ya registrados-->
                            <label for="" class="mx-3 mt-2">Candidato</label>
                            <select name="candidato" id="candidato" class="form-control my-2 rounded">
                                @foreach ($candidatos as $candidato)
                                    <option value="{{ $candidato->nombre }}">{{ $candidato->nombre }}</option>
                                @endforeach
                            </select>
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function eliminar(id) {
                window.location.href = '/votaciones/' + id;
            }
        </script>

        <script>
            function votar(id) {
                $.ajax({
                    type: "POST",
                    url: "/votaciones/votar/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        // Si necesitas alguna acción después de votar, agrégala aquí
                        // Por ejemplo, mostrar un mensaje de éxito, actualizar la tabla de votaciones, etc.
                        alert('Votación exitosa');
                        location.reload();
                    }
                });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</x-app-layout>