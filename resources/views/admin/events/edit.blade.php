<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Modifier un événement</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Titre</label>
            <input type="text"
                   name="titre"
                   class="form-control"
                   value="{{ old('titre', $event->titre) }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date"
                   name="date"
                   class="form-control"
                   value="{{ old('date', $event->date) }}">
        </div>

        <div class="mb-3">
            <label>Heure</label>
            <input type="time"
                   name="heure"
                   class="form-control"
                   value="{{ old('heure', $event->heure) }}">
        </div>

        <div class="mb-3">
            <label>Lieu</label>
            <input type="text"
                   name="lieu"
                   class="form-control"
                   value="{{ old('lieu', $event->lieu) }}">
        </div>

        <div class="mb-3">
            <label>Prix (DH)</label>
            <input type="number"
                   step="0.01"
                   name="prix"
                   class="form-control"
                   value="{{ old('prix', $event->prix) }}">
        </div>

        <div class="mb-3">
            <label>Nombre de places</label>
            <input type="number"
                   name="places"
                   class="form-control"
                   value="{{ old('places', $event->places) }}">
        </div>

        <button type="submit" class="btn btn-warning">
            Modifier
        </button>

        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

</body>
</html>
