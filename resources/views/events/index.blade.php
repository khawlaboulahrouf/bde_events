<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des événements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">
        <h2>Événements disponibles</h2>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">
                Déconnexion
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        @forelse($events as $event)

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow">

                    <div class="card-body">

                        <h4>{{ $event->titre }}</h4>

                        <p>{{ $event->description }}</p>

                        <p>
                            <strong>Date :</strong>
                            {{ $event->date }}
                        </p>

                        <p>
                            <strong>Heure :</strong>
                            {{ $event->heure }}
                        </p>

                        <p>
                            <strong>Lieu :</strong>
                            {{ $event->lieu }}
                        </p>

                        <p>
                            <strong>Prix :</strong>

                            @if($event->prix == 0)
                                Gratuit
                            @else
                                {{ $event->prix }} DH
                            @endif
                        </p>

                        <p>
                            <strong>Places restantes :</strong>
                            {{ $event->placesRestantes() }}
                        </p>

                    </div>

                    <div class="card-footer">

                        <a href="{{ route('events.show',$event->id) }}"
                           class="btn btn-primary">
                            Voir
                        </a>

                        @if($event->placesRestantes() > 0)

                            <form action="{{ route('reservations.store',$event->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                <button class="btn btn-success">
                                    S'inscrire
                                </button>

                            </form>

                        @else

                            <button class="btn btn-secondary" disabled>
                                Complet
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <h4 class="text-center">
                Aucun événement disponible.
            </h4>

        @endforelse

    </div>

</div>

</body>
</html>
