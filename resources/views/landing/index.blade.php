<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Definir variables de color para un uso fácil */
        :root {
            --sonkei-black: #111111;
            --sonkei-yellow: #FFD700;
            --sonkei-gray: #BBBBBB;
            --sonkei-dark-gray: #444444;
        }

        /* Aplicar el fondo y el color de texto a todo el cuerpo de la página */
        body {
            background-color: var(--sonkei-black);
            color: var(--sonkei-gray);
        }

        body {
            background-color: var(--sonkei-black);
            color: var(--sonkei-gray);
            margin: 0;
            padding: 0;
        }

        /* Sobrescribir el estilo de los encabezados para que tengan el color gris */
        h1,
        h3 {
            color: var(--sonkei-gray);
        }

        h1 {
            font-size: 4.5rem;
            /* El valor `rem` es una unidad relativa al tamaño de fuente base */
            margin-bottom: 4rem;
        }

        /* Cambiar el color del texto que usa la clase de Bootstrap "text-primary" */
        .text-primary {
            color: var(--sonkei-yellow) !important;
        }


        .card-title {
            font-size: 1.75rem;
            /* O el valor que prefieras */
        }

        .card-text {
            font-size: 1.2rem;
            /* O el valor que prefieras */
        }

        /* Ajustar el botón principal de Bootstrap para que use el color amarillo */
        .btn-primary {
            background-color: var(--sonkei-yellow);
            border-color: var(--sonkei-yellow);
            color: var(--sonkei-black);
            /* Cambiar el color del texto del botón a negro para que resalte */
        }

        /* Estilo para los botones principales al pasar el mouse por encima (hover) */
        .btn-primary:hover {
            background-color: #e6c200;
            /* Un amarillo ligeramente más oscuro */
            border-color: #e6c200;
        }



        /* Estilo para botones más grandes y personalizados */
        .btn-sonkei-large {
            padding: 10px 15px;
            /* Aumenta el relleno */
            font-size: 1rem;
            /* Hace la fuente más grande */
            font-weight: bold;
            /* Le da más grosor a la fuente */
            border-radius: 50px;
            /* Le da bordes más redondeados */
            transition: transform 0.2s ease-in-out;
            /* Animación al pasar el mouse */
        }

        .btn-sonkei-large:hover {
            transform: scale(1.05);
            /* Escala el botón para un efecto de "zoom" */
        }

        /* Ajustar el botón de peligro de Bootstrap (cerrar sesión) para que encaje con la paleta de colores */
        .btn-danger {
            background-color: #dc3545;
            /* Rojo de Bootstrap */
            border-color: #dc3545;
            color: #ffffff;
            /* Texto blanco para que contraste */
        }

        .btn-danger:hover {
            background-color: #c82333;
            /* Un rojo un poco más oscuro al pasar el mouse */
            border-color: #bd2130;
        }


        /* Nuevo estilo para la barra de navegación */
        .navbar-brand {
            font-size: 1.5rem;
            /* Tamaño más grande para el logo */
            font-weight: bold;
        }

        .nav-link {
            color: var(--sonkei-gray);
            /* Color de texto predeterminado para los enlaces */
            text-transform: uppercase;
            font-weight: bold;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--sonkei-yellow);
            /* Cambia a amarillo al pasar el mouse */
        }

        /* Estilo para el logo en la navbar */
        .logo-navbar {
            height: 70px;
            width: auto;
            /* Mantiene la proporción de la imagen */
        }


        /* Ajuste para que la navbar no cubra el contenido al hacer clic en los enlaces */
        .anchor-offset {
            scroll-margin-top: 200px;
        }


        /* Estilo para el párrafo de la landing page */
        .landing-paragraph {
            font-size: 1.5rem;
            line-height: 1.6;
            font-weight: 300;
            letter-spacing: 0.5px;
            color: var(--sonkei-gray);
            margin-bottom: 4rem;
        }


        .landing-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            display: block;
        }


        /* Estilo para el logo en el footer */
        .logo-footer {
            height: 80px;
            width: auto;
        }


        /* Estilo para el contenedor de la imagen del balón */
        .footer .row {
            align-items: stretch;
        }

        /* Estilo para la imagen del balón */
        .footer-ball-image {
            height: 100%;
            width: 100%;
            object-fit: cover;
            opacity: 0.7;
        }



        /* Ajustes para pantallas pequeñas (móviles) */
        @media (max-width: 767.98px) {
            .logo-navbar {
                height: 60px;
                /* Reducir el tamaño del logo en móviles */
            }

            h1 {
                font-size: 2.5rem;
                /* Reducir el tamaño del h1 en móviles */
            }

            .landing-paragraph {
                font-size: 1rem;
                /* Reducir el tamaño de la fuente en móviles */
            }
        }


        /* Estilo para los captions (títulos y texto) del carrusel */
        .carousel-caption {
            background-color: rgba(17, 17, 17, 0.7);
            border-radius: 10px;
            padding: 1rem;
            bottom: 20%;
            color: var(--sonkei-yellow);
        }

        .carousel-caption h5 {
            color: var(--sonkei-yellow);
        }

        /* Ajuste para los iconos de navegación (flechas) */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
            /* Invertir los colores para que se vean blancos */
        }


        #carouselExampleCaptions {
            max-width: 900px;
            max-height: 500px;
            margin-top: 5rem;
            margin-bottom: 5rem;
            margin-left: auto;
            margin-right: auto;
        }

        .carousel-inner img {
            height: 500px;
            object-fit: contain;
        }



        /* Define un margen grande para las secciones principales */
        .seccion-espaciada {
            margin-top: 4rem;
            margin-bottom: 4rem;
        }

        /* Puedes definir un margen más pequeño para las líneas divisoras */
        hr.seccion-divisora {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        /* O un estilo específico para el carrusel */
        #carouselExampleCaptions {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid d-flex justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <img src="{{ $datos['textos']['logo'] }}" alt="Logo de Sonkei"
                                class="logo-navbar">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jugador-del-mes">Jugador del Mes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proximos-entrenamientos">Entrenamientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#plantel">Plantel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proximos-partidos">Próximos Partidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#historico-partidos">Histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#desarrolladores">Desarrolladores</a>
                    </li>
                </ul>

                {{-- Botones de sesión --}}
                @guest
                    <div class="d-flex align-items-center">
                        <a href="{{ route('user.form.show.login') }}" class="btn btn-primary me-2">
                            Iniciar Sesión
                        </a>

                    </div>
                @endguest
                @auth
                    <div class="d-flex align-items-center">
                        <a href="{{ route('backoffice.dashboard') }}" class="btn btn-primary me-2">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container my-5 text-center">
        <h1 class="text-primary">Sonkei FC⚽</h1>
        <p class="landing-paragraph">En Sonkei FC, cada partido y cada entrenamiento es una oportunidad para crecer.
            Fundado sobre los valores del respeto y el trabajo en equipo, nuestro club es el hogar de jugadores que
            buscan superarse y disfrutar del deporte rey en su máxima expresión. ¡Descubre nuestra historia y sé parte
            de ella!</p>
        @include('backoffice/_partials/messages')

        @auth
            <div class="card bg-dark text-white p-4 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">¡Hola, {{ Auth::user()->name }}!</h5>
                    <p class="card-text">Bienvenido de vuelta a tu espacio.</p>


                </div>
            </div>
        @endauth
    </div>

    <img src="{{ asset('assets/imgs/Jugadores_Sonkei.webp') }}" class="landing-image" alt="Dos jugadores en el campo">
    <hr class="my-5 mb-5">

    {{-- Carrusel --}}
    <div id="carouselExampleCaptions" class="carousel slide seccion-espaciada" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/imgs/Carrusel1.webp') }}" class="d-block w-100" alt="Imagen de Carrusel 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Entrenamientos intensos</h5>
                    <p>Nuestros jugadores se preparan para el éxito en cada sesión.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/imgs/Carrusel2.webp') }}" class="d-block w-100" alt="Imagen de Carrusel 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Momentos de gloria</h5>
                    <p>Cada partido es una oportunidad para demostrar nuestro talento.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/imgs/Carrusel3.webp') }}" class="d-block w-100" alt="Imagen de Carrusel 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Comunidad unida</h5>
                    <p>Somos más que un equipo, somos una familia.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <hr class="seccion-divisora">


    <div id="jugador-del-mes" class="container seccion-espaciada anchor-offset">
        <h2 class="text-primary text-center mb-4">Jugador del Mes</h2>
        <div class="card bg-dark text-white p-3">
            <div class="card-body text-center">
                <p class="card-text">Aquí irá el contenido del jugador del mes.</p>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div id="proximos-entrenamientos" class="container my-5 anchor-offset">
        <h2 class="text-primary text-center mb-4">Próximos Entrenamientos</h2>
        <div class="card bg-dark text-white p-3">
            <div class="card-body">
                <p class="card-text">Aquí irá el contenido de los próximos entrenamientos.</p>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div id="plantel" class="container my-5 anchor-offset">
        <h2 class="text-primary text-center mb-4">Plantel</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card bg-dark text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Jugador Ejemplo</h5>
                        <p class="card-text">Aquí irá la información del jugador, categoría, posición, etc.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Otro Jugador</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div id="proximos-partidos" class="container my-5 anchor-offset">
        <h2 class="text-primary text-center mb-4">Próximos Partidos</h2>
        <div class="card bg-dark text-white p-3">
            <div class="card-body">
                <p class="card-text">Aquí irá la lista de partidos con fecha, hora, lugar y rival.</p>
                <div class="mt-3">
                    <p class="text-primary">Ubicación:</p>
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3328.7188701053743!2d-70.6471858!3d-33.4569429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c505d9c2a39b%3A0x6b8c8d8c8b4b8b4b!2sEstadio%20Nacional%20Julio%20Mart%C3%ADnez%20Pr%C3%A1danos!5e0!3m2!1ses-419!2scl!4v1628182828282!5m2!1ses-419!2scl"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div id="historico-partidos" class="container my-5 anchor-offset">
        <h2 class="text-primary text-center mb-4">Histórico de Partidos</h2>
        <div class="card bg-dark text-white p-3">
            <div class="card-body">
                <p class="card-text">Aquí irá la tabla o lista de partidos anteriores, con resultados y participantes.
                </p>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div id="desarrolladores" class="container my-5 anchor-offset">
        <h2 class="text-primary text-center mb-4">Desarrolladores</h2>
        <div class="row g-4">
            @if (isset($desarrolladores) && $desarrolladores->count() > 0)
                @foreach ($desarrolladores as $desarrollador)
                    <div class="col-3">
                        <div class="card bg-dark text-white h-100">
                            <img src="{{ $desarrollador->foto }}" class="card-img-top" alt="Foto de desarrollador"
                                width="100">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="font-size: 18px">{{ $desarrollador->nombre }}</h5>
                                <p class="card-text" style="font-size: 8px!important">
                                    <span class="text-primary" style="font-size: 16px">{{ $desarrollador->rol }}</span><br>
                                    <hr>
                                    Versión del Software: <span class="text-primary">V
                                        {{ $desarrollador->version_software }}</span><br>
                                    <strong>Funciones desarrolladas</strong>
                                    <br>
                                    <span
                                        class="text-primary">{{ $desarrollador->descripcion_funcionalidades }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <footer class="footer bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-4 mb-4">
                    <h5 class="text-primary mb-3">NUESTRAS REDES SOCIALES</h5>
                    <p>Síguenos en redes sociales y podrás estar al tanto de cada entrenamiento en día, horario,
                        recinto, además podrás ver videos, fotografías y mucho más.</p>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white"><i class="fab fa-facebook me-2"></i>Facebook</a>
                        </li>
                        <li><a href="#" class="text-white"><i class="fab fa-instagram me-2"></i>Instagram</a>
                        </li>
                        <li><a href="#" class="text-white"><i class="fab fa-youtube me-2"></i>Canal de
                                YouTube</a></li>
                    </ul>
                    <h5 class="text-primary mt-4 mb-3">PALABRAS CLAVE</h5>
                    <div class="d-flex flex-wrap">
                        <span class="badge bg-secondary me-2 mb-2">ENTRENAMIENTO</span>
                        <span class="badge bg-secondary me-2 mb-2">ADULTOS</span>
                        <span class="badge bg-secondary me-2 mb-2">-30</span>
                        <span class="badge bg-secondary me-2 mb-2">FÚTBOL</span>
                        <span class="badge bg-secondary me-2 mb-2">FUTBOLITO</span>
                        <span class="badge bg-secondary me-2 mb-2">SONKEI</span>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <p class="text-white fw-bold mb-2">
                        <img src="{{ asset('assets/imgs/logo_sonkei_v2.webp') }}" alt="Logo" class="logo-footer">
                        <span class="ms-2">El respeto en el sentido de tratar a todos por igual sin importar su
                            procedencia, religión, sexo, color de piel o estatus social...</span>
                    </p>
                    <ul class="list-unstyled mt-4">
                        <li>
                            <a href="https://maps.app.goo.gl/9G2vX3zB8Z1X7V3A8"
                                class="text-white d-flex align-items-center" target="_blank">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                Av. América #670, San Bernardo, Santiago de Chile.
                            </a>
                        </li>
                        <li>
                            <a href="mailto:info@sonkei.cl" class="text-white d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                info@sonkei.cl
                            </a>
                        </li>
                        <li>
                            <a href="tel:+56997584316" class="text-white d-flex align-items-center">
                                <i class="fas fa-phone-alt text-primary me-2"></i>
                                +56 9 9758 4316
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <img src="{{ asset('assets/imgs/Balon.webp') }}" alt="Balón de fútbol"
                        class="img-fluid footer-ball-image">
                </div>

            </div>

            <hr class="mt-4 mb-3 text-secondary">

            <div class="text-center text-muted">
                <p>&copy; 2023–2024 | Todos los derechos reservados | Desarrollado por <a href="https://contingeni.cl/"
                        target="_blank" class="text-decoration-none text-primary">contingeni.cl</a></p>
            </div>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
