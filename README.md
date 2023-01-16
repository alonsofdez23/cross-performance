# CrossPerformance

## Descripción general del proyecto

Plataforma para gestión de reserva de clases y gestión interna de centros deportivos.

## Funcionalidad principal de la aplicación

La aplicación permitirá a los usuarios registrase y loguearse. Estos usuarios podrán reservar clase en tramos horarios establecidos previamente por el propietario del centro deportivo. Los usuarios tendrán sus perfiles donde pondrán tener sus datos personales, marcas personales y objetivos.

## Objetivos generales

Como administrador establecer franjas horarias para reservar clases, control total de los usuarios, gestión interna de los pagos, etc.

Como usuario poder rellenar y actualizar sus datos personales, reservar horas de clase, etc.

* Objetivo: "gestionar las reservas de clase de los usuarios".
* Casos de uso: 
	- Invitados: "registrarse".
	- Alumnos: "iniciar sesión", "cerrar sesión", "reservar clase", "eliminar reserva de clase", "editar perfil personal", "borrar perfil personal", "ver a otro usuario".
	- Administrador: "iniciar sesión", "cerrar sesión", "editar un perfil", "borrar una cuenta", "buscar usuarios", "ver a otro usuario", "ver pagos facturados".

# Elemento de innovación

* Pasarela de pago con Laravel Cashier a través de API de Stripe
* Mensajería instantanea a través de Laravel echo y soportado en la API de Pusher para el sistema de notificaciones.
* Administración de clases a traves de FullCalendarJS en comunicación con Livewire.
