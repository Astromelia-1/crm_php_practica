# Mini CRM para Seguimiento de Candidatos

## Descripción
Este proyecto es una API que permite a los reclutadores registrar y hacer seguimiento de candidatos que aplican a diferentes vacantes. Facilita la gestión de candidatos sin depender de hojas de cálculo o correos electrónicos dispersos.

## Tecnologías Utilizadas
- **Backend:** Laravel + Tomato CRM
- **Base de Datos:** PostgreSQL
- **Autenticación:** Laravel Breeze o Laravel Jetstream

## Funcionalidades

1. Registro de candidato
2. Inicio de sesión de candidato
3. Registro de reclutador
4. Inicio de sesión de reclutador
5. Visualización de vacantes disponibles como candidato
6. Aplicación a vacantes como candidato
7. Seguimiento de vacantes aplicadas como candidato
8. Visualización del estado de las aplicaciones como candidato
9. Visualización de las aplicaciones de los candidatos como reclutador
10. Creación de vacantes como reclutador
11. Edición de vacantes como reclutador
12. Eliminación de vacantes como reclutador
13. Modificación del estado de las aplicaciones de candidatos como reclutador

## Casos de Uso

| ID   | Nombre del Caso de Uso                          | Descripción |
|------|--------------------------------|-------------|
| CU-01 | Registrar Candidato | Un candidato puede registrarse en la plataforma proporcionando su información personal y credenciales de acceso. |
| CU-02 | Inicio de sesión de candidato | Un candidato inicia sesión para acceder a la plataforma. |
| CU-03 | Registro de reclutador | Un reclutador puede registrarse proporcionando su información personal y credenciales de acceso. |
| CU-04 | Inicio de sesión de reclutador | Un reclutador inicia sesión para acceder a la plataforma. |
| CU-05 | Crear vacantes | Un reclutador puede crear vacantes para los candidatos. |
| CU-06 | Ver vacantes disponibles como candidato | Un candidato puede ver las vacantes disponibles. |
| CU-07 | Aplicar a vacantes | Un candidato puede postularse a una vacante disponible. |

## Historias de Usuario

- **HU-01:** **Registro de Candidato:** Como candidato, quiero registrarme en la plataforma para poder acceder a las vacantes disponibles.
- **HU-02:** **Inicio de Sesión de Candidato:** Como candidato registrado, quiero iniciar sesión en la plataforma para acceder a mi perfil y postularme a vacantes.
- **HU-03:** **Registro de Reclutador:** Como reclutador, quiero registrarme en la plataforma para poder gestionar vacantes y revisar aplicaciones.
- **HU-04:** **Publicar Vacantes:** Como reclutador, quiero poder publicar nuevas vacantes para que los candidatos puedan postularse.
- **HU-05:** **Aplicar a Vacantes:** Como candidato, quiero postularme a una vacante para poder ser considerado en el proceso de selección.
- **HU-06:** **Ver Estado de Aplicaciones:** Como candidato, quiero ver el estado de mis aplicaciones para saber si fui seleccionado o no.
- **HU-07:** **Editar Aplicaciones de Candidatos:** Como reclutador, quiero revisar y actualizar el estado de las aplicaciones de los candidatos para poder avanzar en el proceso de selección.
- **HU-08:** **Editar Vacantes:** Como reclutador, quiero poder modificar vacantes para mantener actualizada la información de los puestos disponibles.
- **HU-09:** **Eliminar Vacantes:** Como reclutador, quiero poder eliminar vacantes para mantener actualizada la información de los puestos disponibles.
