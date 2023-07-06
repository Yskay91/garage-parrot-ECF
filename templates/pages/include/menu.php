<nav class="navbar navbar-expand-sm">
  <div class="container d-flex justify-content-between">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('/images/logo.png') }}" alt="garage-parrot" class="d-inline-block align-text-top logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ path('home.index') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ path('car.index') }}">Occasions</a>
        </li>
        {% if app.user %}
          <li class="nav-item">
            <a class="nav-link" href="{{ path('user.index') }}">Liste des employés</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ path('services.index') }}">Liste des services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Horaires</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ path('messages.index') }}">Liste des messages</a>
          </li>
        {% endif %}
        <li class="nav-item">
          <a class="nav-link" href="{{ path('messages.new') }}">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>