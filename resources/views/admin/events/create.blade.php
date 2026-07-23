<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Ajouter un événement</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre') }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
        </div>

        <div class="mb-3">
            <label>Heure</label>
            <input type="time" name="heure" class="form-control" value="{{ old('heure') }}">
        </div>

        <div class="mb-3">
            <label>Lieu</label>
            <input type="text" name="lieu" class="form-control" value="{{ old('lieu') }}">
        </div>

        <div class="mb-3">
            <label>Prix (DH)</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix') }}">
        </div>

        <div class="mb-3">
            <label>Nombre de places</label>
            <input type="number" name="places" class="form-control" value="{{ old('places') }}">
        </div>

        <button type="submit" class="btn btn-success">
            Enregistrer
        </button>

        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

</body>
</html>
