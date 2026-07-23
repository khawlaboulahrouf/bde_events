<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des événements</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestion des événements</h2>

        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            + Ajouter un événement
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Lieu</th>
            <th>Prix</th>
            <th>Places</th>
            <th>Réservations</th>
            <th>Places restantes</th>
            <th>Actions</th>
        </tr>

        </thead>

        <tbody>

        @forelse($events as $event)

            <tr>

                <td>{{ $event->id }}</td>

                <td>{{ $event->titre }}</td>

                <td>{{ $event->date }}</td>

                <td>{{ $event->heure }}</td>

                <td>{{ $event->lieu }}</td>

                <td>{{ $event->prix }} DH</td>

                <td>{{ $event->places }}</td>

                <td>{{ $event->reservations->count() }}</td>

                <td>{{ $event->placesRestantes() }}</td>

                <td>

                    <a href="{{ route('admin.events.edit',$event->id) }}"
                       class="btn btn-warning btn-sm">
                        Modifier
                    </a>

                    <form action="{{ route('admin.events.destroy',$event->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer cet événement ?')">

                            Supprimer

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="10" class="text-center">
                    Aucun événement trouvé.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>

</html>
